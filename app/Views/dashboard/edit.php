<?= view('auth/navbar') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Edit Post</h3>
    <div class="d-flex gap-2">
      <button type="button" id="ajaxUpdateBtn" class="btn btn-primary">Update</button>
      <a href="<?= base_url('blog/view') ?>" class="btn btn-secondary">Cancel</a>
    </div>
  </div>

  <div id="message"></div>

  <form id="editForm">
    <?= csrf_field() ?>

    <input type="hidden" name="id" value="<?= esc($post['id']) ?>">

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" id="title" class="form-control" value="<?= esc($post['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      <textarea name="content" id="content" class="form-control" rows="8"><?= esc($post['content']) ?></textarea>
    </div>
  </form>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/js/jquery.js') ?>"></script>
<script src="<?= base_url('assets/editor/tinymce/tinymce.min.js') ?>"></script>

<script>
  tinymce.init({
    selector: '#content',
    height: 400,
    plugins: 'preview importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media table charmap pagebreak nonbreaking anchor lists wordcount',
    toolbar: 'undo redo | styles | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link | preview code fullscreen',
    menubar: 'file edit view insert format tools table help',
    branding: false
  });

  $('#ajaxUpdateBtn').on('click', function (e) {
    e.preventDefault();

    const postId = $('input[name="id"]').val();

    const formData = {
      'title': $('#title').val(),
      'content': tinymce.get("content").getContent(),
      '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
    };

    $.ajax({
      url: "<?= base_url('blog/update-ajax/') ?>" + postId,
      type: "POST",
      data: formData,
      success: function (response) {
        $('#message').html('<div class="alert alert-success">Post updated successfully!</div>');
      },
      error: function (xhr) {
        console.log(xhr.responseText);
        $('#message').html('<div class="alert alert-danger">Error updating post.</div>');
      }
    });
  });
</script>

<?= view('auth/footer') ?>
