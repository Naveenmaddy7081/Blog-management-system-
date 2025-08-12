<?php

namespace App\Controllers;
use CodeIgniter\Controller;
class Dashboard extends Controller
{
    public function index()
    {
        if (!session()->get('loggedUser')) {
            return redirect()->to('/')->with('fail', 'Please login first!');
        }
        
        $userModel = new \App\Models\UserModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $userModel->find($loggedUserID);
        $data = [
            'title'=> 'Dashboard',
            'userInfo'=> $userInfo
        ];
        return view('dashboard/index', $data);
    }
}
 