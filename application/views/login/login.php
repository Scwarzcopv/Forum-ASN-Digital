<section class="text-center text-lg-start">
    <main class="d-flex w-100 h-100 justify-content-center">
        <div class="row vh-100">
            <div class=" h-custom ">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <!-- KIRI -->
                    <div class="col-md-9 col-lg-6 col-xl-5 d-none d-lg-block">
                        <!-- https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp -->
                        <img src="<?= base_url('assets'); ?>/img/icons/kiri.png" class="img-fluid" alt="Image Kiri">
                        <div class="d-flex align-items-center mt-2 justify-content-center">
                            <p class="text-center fw-bold mx-3 mb-0 h1 comicsans text-dark">FORUM ASN DIGITAL</p>
                        </div>
                        <div class="d-flex align-items-center mb-4 mt-0 justify-content-center">
                            <p class="text-center mx-3 mb-0 h4 comicsans text-dark">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam velit necessitatibus, cumque quo commodi dolorum. Minima, voluptatibus. Facere nemo, mollitia sint id, iusto, vero reprehenderit illum illo odit accusamus voluptatum?</p>
                        </div>
                    </div>
                    <!-- KANAN -->
                    <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                        <form action="<?= base_url('login'); ?>" method="POST">
                            <div class="text-center">
                                <img src="<?= base_url('assets'); ?>/img/icons/logo.png" alt="Logo Kediri Kota" class="img-fluid" width="132" height="132" />
                            </div>
                            <div class="divider d-flex align-items-center mb-4 mt-2">
                                <p class="text-center fw-bold mx-3 mb-0">KOTA KEDIRI</p>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" id="username" class="form-control form-control-lg" placeholder="Username" name="username" id="username" value="<?= set_value('username'); ?>" />
                                <?= form_error('username', '<small class="text-danger ms-3">', '</small>'); ?>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control form-control-lg" placeholder="Password" name="password" id="password" />
                                <?= form_error('password', '<small class="text-danger ms-3">', '</small>'); ?>
                            </div>

                            <!-- Button Login -->
                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- FOOTER -->
            <div class="d-flex text-center text-md-start align-items-center full-width">
                <div class="text-dark ms-1 d-none d-md-block">
                    <!-- ©2023 | Pemerintah Kota Kediri -->
                </div>
            </div>
            <nav class="navbar fixed-bottom bg-light d-none d-lg-flex py-1 ps-2">
                <div class="container-fluid d-flex align-items-center ps-0 d-none d-lg-block">
                    <span class="text-dark h5 my-auto" href="#">©2023 | Pemerintah Kota Kediri</span>
                </div>
            </nav>
            <!-- END FOOTER -->
        </div>
    </main>
</section>

<?= $this->session->flashdata('message'); ?>