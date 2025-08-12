<?= view('auth/navbar') ?>

<style>
  body {
    background-color: #fff9f7;
  }


  .card {
    border: 1px solid #f8d6cf !important;
    background-color: #fefefe;
    transition: all 0.3s ease;
  }

  .card:hover {
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
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
  <h2 class="text-primary">Blogster 😇</h2>
  <div class="d-flex gap-2">
    <a href="<?= base_url('/dashboard') ?>" class="btn btn-warning">+ New Post</a>
    <a href="<?= base_url('/blog/my-posts') ?>" class="btn btn-warning">My Post</a>
  </div>
</div>

  <!-- Search Form -->
  <form method="get" action="" class="row g-2 mb-4">
    <div class="col-md-10">
      <input type="text" name="author" id="search-btn" class="form-control" placeholder="Search by author name..." value="<?= esc($search ?? '') ?>">
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100" type="submit">Search</button>
    </div>
  </form>

  <!-- Blog List -->
  <?php if (!empty($blogs)): ?>
    <?php foreach ($blogs as $blog): ?>
    <a href="<?= base_url('blog/show/' . $blog['id']) ?>" class="text-decoration-none text-dark">
  <div class="card mb-3 shadow-sm hover-shadow" style="cursor: pointer;">
    <div class="card-body">
      <h4 class="card-title"><?= esc($blog['title']) ?></h4>
      <p class="card-text"><?= esc(strip_tags(substr($blog['content'], 0, 120))) ?>...</p>
      <p class="card-text"><small class="text-muted">
        <?= date('d M Y h:i A', strtotime($blog['created_at'])) ?> •

        <a href="<?= base_url('blog/author/' . urlencode($blog['author_name'])) ?>" class="text-decoration-none text-muted">
  <?= esc($blog['author_name']) ?>
</a>
      </small></p>
    </div>
  </div>
</a>


<?php endforeach; ?>

  <?php else: ?>
    <p class="text-muted">No blog posts available.</p>
  <?php endif; ?>
</div>

<?= view('auth/footer') ?>
