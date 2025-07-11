        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer-logo">
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <h3>Quick Menu</h3>
                        <?php if (have_rows('quick_menu', 'option')) : ?>
                            <ul class="footer-menu">
                                <?php while (have_rows('quick_menu', 'option')) : the_row(); ?>
                                    <li class="nav-item">
                                        <a href="<?php the_sub_field('link_menu', 'option'); ?>"><?php the_sub_field('text_menu', 'option'); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                        <h3>Legal</h3>

                        <?php if (have_rows('terms_conditions', 'option')) : ?>
                            <ul class="footer-menu">
                                <?php while (have_rows('terms_conditions', 'option')) : the_row(); ?>
                                    <li>
                                    <a href="<?php the_sub_field('link_terms', 'option'); ?>"><?php the_sub_field('text_terms', 'option'); ?></a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="col-sm-4">
                        <h3>Contact</h3>

                        <div class="footer-contact">
                            <?php echo the_field('contact', 'option'); ?>

                            <?php 
                                $whatsapp = get_field('whatsapp_url', 'option');
                                $telegram = get_field('telegram_url', 'option');
                            ?>
                            <ul class="d-flex justify-content-center align-items-center">
                                <li>
                                    <?php if($whatsapp): ?>
                                        <a href="<?php echo $whatsapp; ?>" target="_blank">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/whatsapp.svg" width="24" alt="Whatsapp icon">
                                        </a>
                                    <?php endif; ?>
                                    <?php if($telegram): ?>
                                        <a href="<?php echo $telegram; ?>" target="_blank">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/telegram.svg" width="24" alt="Telegram icon">
                                        </a>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="partner">
                    <div class="content">
                        <p class="mb-16"><strong>The girl next door</strong> is a platform for verified independent escorts. We facilitate introductions only and do not manage, influence or take responsibility for any agreement before, during or after a meeting. Read full disclaimer</p>
                    </div>

                    <?php 
                        $instagram = get_field('instagram_url', 'option');
                        $tiktok = get_field('tiktok_url', 'option');
                    ?>
                    
                    <?php if($instagram || $tiktok) : ?>
                        <ul>
                            <?php if($instagram): ?>
                                <li>
                                    <a href="<?php echo $instagram; ?>" target="_blank">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_266_19)">
                                                <path
                                                    d="M6.96 0H17.04C20.88 0 24 3.12 24 6.96V17.04C24 18.8859 23.2667 20.6562 21.9615 21.9615C20.6562 23.2667 18.8859 24 17.04 24H6.96C3.12 24 0 20.88 0 17.04V6.96C0 5.11409 0.733284 3.34379 2.03854 2.03854C3.34379 0.733284 5.11409 0 6.96 0ZM6.72 2.4C5.57426 2.4 4.47546 2.85514 3.6653 3.6653C2.85514 4.47546 2.4 5.57426 2.4 6.72V17.28C2.4 19.668 4.332 21.6 6.72 21.6H17.28C18.4257 21.6 19.5245 21.1449 20.3347 20.3347C21.1449 19.5245 21.6 18.4257 21.6 17.28V6.72C21.6 4.332 19.668 2.4 17.28 2.4H6.72ZM18.3 4.2C18.6978 4.2 19.0794 4.35804 19.3607 4.63934C19.642 4.92064 19.8 5.30218 19.8 5.7C19.8 6.09782 19.642 6.47936 19.3607 6.76066C19.0794 7.04197 18.6978 7.2 18.3 7.2C17.9022 7.2 17.5206 7.04197 17.2393 6.76066C16.958 6.47936 16.8 6.09782 16.8 5.7C16.8 5.30218 16.958 4.92064 17.2393 4.63934C17.5206 4.35804 17.9022 4.2 18.3 4.2ZM12 6C13.5913 6 15.1174 6.63214 16.2426 7.75736C17.3679 8.88258 18 10.4087 18 12C18 13.5913 17.3679 15.1174 16.2426 16.2426C15.1174 17.3679 13.5913 18 12 18C10.4087 18 8.88258 17.3679 7.75736 16.2426C6.63214 15.1174 6 13.5913 6 12C6 10.4087 6.63214 8.88258 7.75736 7.75736C8.88258 6.63214 10.4087 6 12 6ZM12 8.4C11.0452 8.4 10.1295 8.77928 9.45442 9.45442C8.77928 10.1295 8.4 11.0452 8.4 12C8.4 12.9548 8.77928 13.8705 9.45442 14.5456C10.1295 15.2207 11.0452 15.6 12 15.6C12.9548 15.6 13.8705 15.2207 14.5456 14.5456C15.2207 13.8705 15.6 12.9548 15.6 12C15.6 11.0452 15.2207 10.1295 14.5456 9.45442C13.8705 8.77928 12.9548 8.4 12 8.4Z"
                                                    fill="#D2261A" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_266_19">
                                                    <rect width="24" height="24" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <?php if($tiktok): ?>
                                <li>
                                    <a href="<?php echo $tiktok; ?>" target="_blank">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.8453 0V7.69719C9.16226 7.38878 7.42384 7.60005 5.86679 8.30223C4.30973 9.00441 3.00973 10.1634 2.14382 11.6213C1.27791 13.0792 0.888183 14.7652 1.02771 16.4496C1.16724 18.1341 1.82924 19.7351 2.92356 21.0348C4.01788 22.3344 5.49133 23.2694 7.14325 23.7125C8.79516 24.1556 10.5453 24.0851 12.1552 23.5108C13.7651 22.9365 15.1566 21.8863 16.1402 20.503C17.1238 19.1198 17.6517 17.4709 17.6519 15.7808V11.2974C18.9586 11.846 20.3647 12.1261 21.7845 12.1206H23V5.40027H21.7845C19.4715 5.40027 17.6519 3.55578 17.6519 1.20006V0H10.8453ZM13.2762 2.40012H15.328C15.8069 5.06426 17.8561 7.19556 20.5691 7.69239V9.63409C19.3074 9.45168 18.1685 8.98366 17.1135 8.28642L15.221 7.03596V15.7808C15.2209 16.9447 14.8673 18.0819 14.206 19.0454C13.5447 20.0089 12.606 20.7545 11.5111 21.1859C10.4162 21.6174 9.21551 21.7148 8.06399 21.4656C6.91247 21.2165 5.86305 20.6322 5.05129 19.7882C4.23952 18.9442 3.70269 17.8793 3.51012 16.731C3.31756 15.5827 3.47811 14.4038 3.97104 13.3466C4.46397 12.2893 5.26663 11.4022 6.27536 10.7999C7.28409 10.1976 8.45255 9.90771 9.62984 9.96771V11.8926C8.83792 11.8323 8.04598 12.0091 7.35737 12.3999C6.66876 12.7907 6.11546 13.3773 5.76968 14.0833C5.4239 14.7893 5.3017 15.5818 5.41904 16.3574C5.53637 17.133 5.88778 17.8557 6.42741 18.4311C6.96705 19.0065 7.66983 19.4079 8.44405 19.583C9.21827 19.7581 10.028 19.6987 10.7675 19.4125C11.507 19.1263 12.1419 18.6267 12.5895 17.9789C13.037 17.331 13.2763 16.565 13.2762 15.7808V2.40012ZM7.80663 15.7808C7.80663 15.383 7.96671 15.0014 8.25164 14.7201C8.53657 14.4388 8.92302 14.2807 9.32597 14.2807C9.72892 14.2807 10.1154 14.4388 10.4003 14.7201C10.6852 15.0014 10.8453 15.383 10.8453 15.7808C10.8453 16.1786 10.6852 16.5602 10.4003 16.8415C10.1154 17.1228 9.72892 17.2809 9.32597 17.2809C8.92302 17.2809 8.53657 17.1228 8.25164 16.8415C7.96671 16.5602 7.80663 16.1786 7.80663 15.7808Z"
                                                fill="#D2261A" />
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="content">
                        <p>All rights reserved | 2025 Escort ©</p>
                    </div>
                </div>
            </div>
        </footer>

		<?php wp_footer(); ?>
        <!-- JQuery JS -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.min.js"></script>
        <!-- Lightbox JS -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/fslightbox.js"></script>
        <!-- Swiper JS -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/swiper-bundle.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/bootstrap.bundle.min.js"></script>
        <!-- App JS -->
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/app.js"></script>
    </body>
</html>