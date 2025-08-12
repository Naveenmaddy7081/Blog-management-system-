<?= view('auth/navbar') ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="p-4 shadow rounded bg-white">
                <h4 class="mb-4 text-center">Sign Up</h4>
                <form action="<?= base_url('auth/register'); ?>" method="post">
                    <?= csrf_field(); ?>

                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>

                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>

                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="" aria-describedby=""
                            placeholder="Enter Full Name" value="<?= set_value('name'); ?>">
                        <span
                            class="text-danger"><?= isset($validation) ? display_error($validation, 'name'): '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter your Email"
                            value="<?= set_value('email'); ?>">
                        <span
                            class="text-danger"><?= isset($validation) ? display_error($validation, 'email'): '' ?></span>

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                            placeholder="Enter Password" value="<?= set_value('password'); ?>">
                        <span
                            class="text-danger"><?= isset($validation) ? display_error($validation, 'password'): '' ?></span>

                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1"
                            placeholder="Enter Confirm Password" value="<?= set_value('cpassword'); ?>">
                        <span
                            class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword'): '' ?></span>

                    </div>
                    <!--  -->
                    <button type="submit" class="btn  w-100" style="background-color:#EE5A24;">Sign Up</button>
                    <div class="text-center mt-3">
                        <a href="<?= site_url('/'); ?>" style="text-decoration: none;">I already have Account, Login
                            now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('auth/footer') ?>