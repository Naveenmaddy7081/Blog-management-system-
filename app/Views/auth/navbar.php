<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogster</title>
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <style>
    body {
        padding-top: 70px;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:	#2c003e;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-white" href="#">
                <img src="<?= base_url('assets/images/blog.webp') ?>" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top">
                Blogster
            </a>

            <div class="d-flex align-items-center">
                <?php if (session()->get('name')): ?>
                <span class="text-white fw-semibold me-3">Hello, <?= esc(session()->get('name')) ?></span>
                <a href="<?= base_url('logout') ?>" class="btn btn-primary btn-sm">Logout</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div>
        <?=view('message/message')?>
    </div>