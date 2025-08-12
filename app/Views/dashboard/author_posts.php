<?= view('auth/navbar') ?>

<style>
  .author-header {
    background-color: #fef4f2;
    padding: 40px 20px;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 30px;
  }

  .author-header .brand {
    color: #EE5A24;
    font-weight: 700;
    font-size: 22px;
    margin-bottom: 10px;
  }

  .author-header .name {
    font-size: 20px;
    font-weight: bold;
  }

  .author-header .count {
    color: #555;
    margin-top: 5px;
  }


  .post-card {
    border: 1px solid #f5d1c7;
    background-color: #fcfcfc;
    padding: 25px;
    border-radius: 10px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
  }

  .post-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transform: translateY(-2px);
  }

  .post-title {
    font-weight: 700;
    font-size: 22px;
    color: #222;
    margin-bottom: 10px;
  }

  .post-excerpt {
    font-size: 15px;
    color: #555;
    margin-bottom: 12px;
  }

  .post-date {
    font-size: 14px;
    color: #999;
  }

  a .post-card {
  transition: all 0.3s ease;
}

a:hover .post-card {
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  transform: translateY(-2px);
}

</style>

<div class="container my-5">
  <div class="author-header">
    <div class="brand">😊 Blogster</div>
    <div class="name"><?= esc($authorName) ?></div>
    <div class="count"><?= $postCount ?> Post<?= $postCount !== 1 ? 's' : '' ?></div>
  </div>

  <div class="text-center mb-4">
  <a href="<?= base_url('blog/view') ?>" class="btn btn-outline-secondary">
    ← Back to All Posts
  </a>
</div>




  <?php if (!empty($blogs)): ?>
  <?php foreach ($blogs as $blog): ?>
  <a href="<?= base_url('blog/show/' . $blog['id']) ?>" class="text-decoration-none">
    <div class="post-card">
      <div class="post-title"><?= esc($blog['title']) ?></div>
      <div class="post-excerpt"><?= esc(strip_tags(substr($blog['content'], 0, 120))) ?>...</div>
      <div class="post-date"><?= date('F d, Y', strtotime($blog['created_at'])) ?></div>
    </div>
  </a>
<?php endforeach; ?>


  <?php else: ?>
    <p class="text-muted text-center">No posts by this author.</p>
  <?php endif; ?>
</div>



<script>
  document.querySelectorAll('.post-card').forEach(card => {
    card.addEventListener('click', () => {
      const id = card.getAttribute('data-id');
      window.location.href = '<?= base_url("blog/show") ?>/' + id;
    });
  });
</script>

<?= view('auth/footer') ?>
