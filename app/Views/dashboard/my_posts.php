<?= view('auth/navbar') ?>

<style>
body {
    background-color: #fff9f7;
}

.postify-header {
    background-color: #fff3f0;
    border: 1px solid #f8d6cf;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    margin-bottom: 30px;
}

.card {
    border: 1px solid #f8d6cf !important;
    background-color: #fefefe;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    transform: translateY(-3px);
}

.card-title {
    font-weight: 700;
    font-size: 20px;
}

.card-text {
    font-size: 14px;
    color: #444;
}

.card small {
    color: #888 !important;
}

.text-muted a {
    text-decoration: none;
    color: #999 !important;
}
</style>


<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">My Blog Posts</h2>

        <!-- Right-side buttons -->
        <div class="d-flex gap-2">
            <a href="<?= base_url('/dashboard') ?>" class="btn btn-success">+ New Post</a>
            <a href="<?= base_url('blog/view') ?>" class="btn btn-outline-secondary">← Back to All Posts</a>
        </div>
    </div>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (!empty($blogs)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content Preview</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= esc($blog['title']) ?></td>
                    <td><?= esc(strip_tags(substr($blog['content'], 0, 80))) ?>...</td>
                    <td><?= date('F d, Y', strtotime($blog['created_at'])) ?></td>
                    <td class="d-flex gap-2">
                        <a href="<?= base_url('blog/show/' . $blog['id']) ?>" class="btn btn-sm btn-info">View</a>
                        <a href="<?= base_url('blog/edit/' . $blog['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <!-- <form action="<?= base_url('blog/delete/' . $blog['id']) ?>" method="post"
                            onsubmit="return confirm('Are you sure to delete this post?');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
                        </form> -->
                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                            data-id="<?= $blog['id'] ?>">Delete</button>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>




    </div>
    <?php else: ?>
    <p class="text-muted">You haven't written any blog posts yet.</p>
    <?php endif; ?>
</div>


<script src="<?=base_url('assets/js/jquery.js')?>"></script>
<script src="<?=base_url('assets/js/main.js')?>"></script>


<?= view('auth/footer') ?>