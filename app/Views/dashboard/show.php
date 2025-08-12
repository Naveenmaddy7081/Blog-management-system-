<?= view('auth/navbar') ?>

<style>

   body {
    background-color: #fff9f7;
  }
  
  .blog-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 40px;
    background-color: #fff;
    border: 1px solid #f1d7d7;
    border-radius: 12px;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.03);
    font-family: 'Segoe UI', sans-serif;
    overflow-wrap: break-word;
  }

  .blog-title {
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .blog-meta {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 25px;
  }

  .blog-meta span {
    color: #d72f2f;
    font-weight: 600;
  }

  .blog-content {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #333;
  }

  .blog-content h1,
  .blog-content h2,
  .blog-content h3 {
    margin-top: 20px;
    font-weight: 600;
  }

  .blog-content p {
    margin-bottom: 1.2rem;
  }

  .blog-content ul,
  .blog-content ol {
    margin-left: 1.2rem;
  }

  .blog-content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 20px auto;
    border-radius: 8px;
  }

  .back-btn {
    margin-top: 40px;
  }
</style>

<div class="blog-container">
  <!-- Header -->
  <div class="text-center mb-3">
    <img src="<?= base_url('assets/images/blog.webp') ?>" width="36" class="mb-2" />
    <h3 class="text-danger fw-bold" style="margin: 0;">Blogster</h3>
  </div>

  <!-- Featured Image -->
  <?php if (!empty($post['featured_image'])): ?>
    <div class="text-center">
      <img src="<?= base_url('uploads/' . $post['featured_image']) ?>" alt="Blog Image" class="img-fluid blog-image">
    </div>
  <?php endif; ?>

  <!-- Blog Title and Meta -->
  <div class="blog-title"><?= esc($post['title']) ?></div>
  <div class="blog-meta">
    Published on : <?= date('F d, Y', strtotime($post['created_at'])) ?> &nbsp;
    <span>Written by : <?= esc($post['author_name']) ?></span>
  </div>

  <!-- Blog Content -->
  <div class="blog-content">
    <?= $post['content'] ?>
  </div>

  <!-- Back Button -->
  <div class="text-end back-btn">
    <a href="<?= base_url('blog/view') ?>" class="btn btn-outline-secondary">← Back to All Posts</a>

  </div>
</div>

<?= view('auth/footer') ?>
