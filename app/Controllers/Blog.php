<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\blogModel;

class Blog extends BaseController
{
    // Reusable login check
    private function checkLogin()
    {
        if (!session()->get('loggedUser')) {
            return redirect()->to('/')->with('fail', 'Please login to access this page.');
        }
    }

    // Default page: redirect to login
    public function index()
    {
        return view('user/login');
    }

    // Show create blog form
    public function create()
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        return view('blog/create');
    }

    //  Store blog post in DB
    public function store()
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $postModel = new blogModel();

        $validation = $this->validate([
            'title'   => 'required|min_length[3]',
            'content' => 'required|min_length[10]',
        ]);

        if (!$validation) {
            return view('blog/create', ['validation' => $this->validator]);
        }

        $data = [
            'user_id' => session()->get('loggedUser'),
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        if (!$postModel->insert($data)) {
            dd($postModel->errors());
        }

        return redirect()->to('blog/view')->with('success', 'Post saved successfully!',);
    }

    // Show all posts with author name
    public function viewBlog()
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $search = $this->request->getGet('author');

        $db = \Config\Database::connect();
        $builder = $db->table('blogs');
        $builder->select('blogs.*, users.name as author_name');
        $builder->join('users', 'users.id = blogs.user_id');
        if ($search) {
            $builder->like('users.name', $search);
        }
        $builder->orderBy('blogs.created_at', 'DESC');
        $query = $builder->get();

        $data = [
            'blogs' => $query->getResultArray(),
            'search' => $search
        ];

        return view('dashboard/view', $data);
    }

    //  Show single blog post
    public function show($id)
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $db = \Config\Database::connect();
        $builder = $db->table('blogs');
        $builder->select('blogs.*, users.name as author_name');
        $builder->join('users', 'users.id = blogs.user_id');
        $builder->where('blogs.id', $id);
        $query = $builder->get();

        $post = $query->getRowArray();

        if (!$post) {
            return redirect()->back()->with('fail', 'Post not found');
        }

        return view('dashboard/show', ['post' => $post]);
    }

    //  Show edit form
    public function edit($id)
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $postModel = new blogModel();
        $data['post'] = $postModel->find($id);

        if (!$data['post']) {
            return redirect()->back()->with('fail', 'Post not found');
        }

        return view('dashboard/edit', $data);
    }

    
    public function update($id)
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $postModel = new blogModel();

        $validation = $this->validate([
            'title'   => 'required|min_length[3]',
            'content' => 'required|min_length[10]',
        ]);

        if (!$validation) {
            return view('blog/edit', [
                'post' => $postModel->find($id),
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];

        $postModel->update($id, $data);

        return redirect()->to('blog/view')->with('success', 'Post updated!');
    }
    

    public function delete($id){
        $blogModel=new blogModel();
        $blog=$blogModel->find($id);
        if(!$blog){
            return $this->response->setJSON(['status'=>'not_found']);
        }
        if($blogModel->delete($id)){
            return $this->response->setJSON(['status'=> 'deleted']);
        }else{
            return $this->response->setJSON(['status'=>'error']);
        }
    }


    
    public function myPosts()
    {
        $redirect = $this->checkLogin();
        if ($redirect) return $redirect;

        $userId = session()->get('loggedUser');

        $db = \Config\Database::connect();
        $builder = $db->table('blogs');
        $builder->select('blogs.*, users.name as author_name');
        $builder->join('users', 'users.id = blogs.user_id');
        $builder->where('blogs.user_id', $userId);
        $builder->orderBy('blogs.created_at', 'DESC');
        $query = $builder->get();

        $data['blogs'] = $query->getResultArray();

        return view('dashboard/my_posts', $data);
    }

    public function postsByAuthor($authorName)
{
    $db = \Config\Database::connect();
    $builder = $db->table('blogs');
    $builder->select('blogs.*, users.name as author_name');
    $builder->join('users', 'users.id = blogs.user_id');
    $builder->where('users.name', urldecode($authorName));
    $builder->orderBy('blogs.created_at', 'DESC');
    $query = $builder->get();
    $blogs = $query->getResultArray();

    $postCount = count($blogs);

    $data = [
        'blogs' => $blogs,
        'authorName' => urldecode($authorName),
        'postCount' => $postCount,
    ];

    return view('dashboard/author_posts', $data);
}


public function createAjax(){
        // $redirect = $this->checkLogin();
        // if ($redirect) return $redirect;

        $blogModel = new blogModel();
        
        $data = [
            'user_id' => session()->get('loggedUser'),
            'title'   => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
        ];
        
        $validation = $this->validate([
            'title'   => 'required|min_length[3]',
            'content' => 'required|min_length[10]',
        ]);

        if (!$validation) {
            return view('blog/create-ajax', ['validation' => $this->validator]);
        }


        if ($blogModel->save($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'status' => 'error',
                'message' => 'Failed to save the blog post.'
            ]);
        }
    }

    public function updateAjax($id)
{
    if ($this->request->isAJAX()) {
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');

        $blogModel = new \App\Models\BlogModel();

        $data = [
            'id'      => $id,
            'title'   => $title,
            'content' => $content,
        ];

        if ($blogModel->save($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Failed to update post'
            ]);
        }
    }

    return $this->response->setStatusCode(400)->setJSON(['error' => 'Bad Request']);
}



}






