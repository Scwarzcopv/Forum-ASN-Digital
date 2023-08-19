                            <div id="carousel_foto_dokumentasi" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php $i = 0; ?>
                                    <?php foreach ($foto_dokumentasi as $img) : ?>
                                        <?php $path = base_url('assets/img/photos/' . $img['path'] . ''); ?>
                                        <div class="carousel-item <?= ($i == 0) ? "active" : ""; ?>" data-bs-interval="1000">
                                            <!-- <div class="magnific-img"> -->
                                            <span class="image-popup" href="<?= $path; ?>">
                                                <img src="<?= $path; ?>" alt="Dokumentasi" class="img-fluid mb-2 w-100 img-carrousel rounded-4 px-1" />
                                            </span>
                                            <!-- </div> -->
                                        </div>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel_foto_dokumentasi" data-bs-slide="prev">
                                    <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-left fa-lg"></i></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel_foto_dokumentasi" data-bs-slide="next">
                                    <span class="" aria-hidden="true"><i class="fa-solid fa-circle-chevron-right fa-lg"></i></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>