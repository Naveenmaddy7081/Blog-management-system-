<?= view('auth/navbar') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-4 shadow rounded bg-white">
                <div class="text-center my-4">
                    <img src="<?= base_url('assets/images/blog.webp') ?>" alt="Logo" width="30" height="30"
                        class="mb-3">
                    <h4 class="mb-2">Welcome Back</h4>
                    <p class="mb-0">Please enter your credentials to log in.</p>
                </div>

                <form action="<?= base_url('/dashboard') ?>" method="post">

                    <?= csrf_field(); ?>

                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"
                            value="<?= set_value('email') ?>">
                        <span class="text-danger"><?= isset($validation) ? $validation->getError('email') : "" ?></span>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Enter password">
                        <span
                            class="text-danger"><?= isset($validation) ? $validation->getError('password') : "" ?></span>
                    </div>

                    <button type="submit" class="btn w-100" style="background-color:#EE5A24;">Login</button>
                    <div class="text-center mt-3">
                        <a href="<?= site_url('auth/register'); ?>" style="text-decoration: none;">Have no Account?
                            Create new account!</a>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<?= view('auth/footer') ?>