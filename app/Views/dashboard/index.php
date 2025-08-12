<?= view('auth/navbar') ?>

<link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">

<style>
body {
    background-color: #fff;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.editor-container {
    border: 1px solid #f1e8e5;
    padding: 30px;
    border-radius: 6px;
    margin: 40px auto;
    max-width: 900px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.logo {
    font-weight: bold;
    color: #EE5A24;
    font-size: 22px;
    display: flex;
    align-items: center;
}

.logo::before {
    content: '😊';
    font-size: 22px;
    margin-right: 6px;
}

.actions a {
    color: #EE5A24;
    margin-left: 20px;
    font-weight: 500;
    text-decoration: none;
}

.actions .save-btn {
    background-color: #EE5A24;
    color: #fff;
    border: none;
    padding: 6px 18px;
    border-radius: 8px;
    margin-left: 20px;
}

.form-control {
    background-color: #f2f2f2;
    border: none;
    border-radius: 6px;
    height: 40px;
}

label {
    font-weight: 600;
    margin-bottom: 6px;
}

.tox-statusbar__branding {
    display: none !important;
}

.alert {
    max-width: 900px;
    margin: 20px auto;
}
</style>

<body>
    <div class="editor-container">
        <div class="header">
            <div class="logo">Blogster</div>
            <div class="actions">
                <a href="<?= base_url('blog/view') ?>">View Post</a>
                <button id="ajaxSaveBtn" class="save-btn">Save Post</button>
            </div>
        </div>

        <!-- Alert -->
        <div id="message">
        </div>

        <form id="createPostForm">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text"  class="form-control" name="title" id="title" placeholder="Latest Insights in Tech"
                    required>
                    <span id="nameerr"  class="error"></span>
                    
            </div>

            <div class="mb-3">
                <textarea name="content" id="editor" rows="12"
                    placeholder="Type or paste your content here!" required></textarea>
            </div>
        </form>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/js/jquery.js') ?>"></script>


    <script src="<?= base_url('assets/editor/tinymce/tinymce.min.js') ?>"></script>

    <script>
    tinymce.init({
        selector: '#editor',
        height: 400,
        plugins: 'preview importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media table charmap pagebreak nonbreaking anchor lists wordcount',
        toolbar: 'undo redo | styles | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | image media link | preview code fullscreen',
        menubar: 'file edit view insert format tools table help',
        branding: false
    });


    

            $('#ajaxSaveBtn').on('click', function(e) {
        e.preventDefault();

        const formData = {
            title: $('#title').val(),
            content: tinymce.get("editor").getContent(),
            '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
        };

        $.ajax({
            url: '<?= base_url("blog/create-ajax") ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#message').html(
                    '<div class="alert alert-success">Post created successfully!</div>');
                $('#createPostForm')[0].reset();
                tinymce.get("editor").setContent('');
            },
            error: function(xhr) {
                $('#message').html(
                    '<div class="alert alert-danger">Failed to create post. Please try again.</div>'
                    );
            }
        });
    });

        

    
    </script>

    <?= view('auth/footer') ?>