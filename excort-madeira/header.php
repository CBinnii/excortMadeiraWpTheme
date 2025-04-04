<!DOCTYPE html>
    <html lang="nl">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Escort Madeira - <?php echo get_the_title(); ?></title>
        <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png">
        <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>

    <body>
        <?php 
            $whatsapp = get_field('whatsapp_url', 'option');
            $telegram = get_field('telegram_url', 'option');
        ?>
        <?php if($telegram): ?>
            <div class="follow-floted">
                <label>SUBSCRIBE TO OUR CHANNEL! | </label>
                <ul>
                    <li>
                        <a target="_blank" title="Telegram" href="<?php echo $telegram; ?>">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/telegram.svg" alt="Telegram icon">
                        </a>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if($whatsapp): ?>
            <a target="_blank" title="Whatsapp" href="<?php echo $whatsapp; ?>" class="icon-telegram">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icons/whatsapp.svg" alt="Whatsapp icon">
            </a>
        <?php endif; ?>

        <header id="header" class="header">
            <nav class="navbar">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-sm-7 logo-header">
                            <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Logo"></a>
                        </div>

                        <div class="col-sm-5 menu-header">
                            <div class="navbar-menu">
                                <div class="collapse navbar-collapse" id="navbar-collapse">
                                    <div class="col-sm-7 logo-header">
                                        <span class="navbar-brand"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" alt="Logo"></span>
                                    </div>
                                    
                                    <?php
                                        $menu_hamburguer = get_term_by('name', 'Menu Hamburguer', 'nav_menu');

                                        if ($menu_hamburguer) {
                                            wp_nav_menu(array(
                                                'menu'        => $menu_hamburguer->term_id, // Usar 'menu' em vez de 'menu_id'
                                                'container'   => false,
                                                'menu_class'  => 'navbar-nav me-auto mb-2 mb-lg-0',
                                                'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                'depth'       => 1,
                                            ));
                                        } else {
                                            echo '<p>Menu Hamburguer não encontrado.</p>';
                                        }
                                    ?>
                                    
                                    <a href="booking" class="button bold outline">
                                        BOOK NOW
                                    </a>
                                </div>
                                <div class="navbar-action">
                                    <a href="booking" class="button bold outline medium">
                                        BOOK NOW
                                    </a>
                                    <span class="social">
                                        <div class="header-site-search">
                                            <span class="header-site-search-icon"></span>
                                            <form method="GET" action="#" role="search">
                                                <input class="header-site-search-input" type="text" name="keyword"
                                                    id="keyword" placeholder="Search...">
                                                <button type="submit">Search</button>
                                            </form>
                                        </div>

                                        <button class="navbar-toggler">
                                            <div class="menu-button" id="menu-button" onclick="menuMobile()">
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                            </div>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 desktop mt-2">
                            <?php
                                $menu_padrao = get_term_by('name', 'Menu', 'nav_menu');

                                if ($menu_padrao) {
                                    wp_nav_menu(array(
                                        'menu'        => $menu_padrao->term_id, // Usar 'menu' em vez de 'menu_id'
                                        'container'   => false,
                                        'menu_class'  => 'navbar-nav navbar-nav-desktop me-auto mb-2 mb-lg-0',
                                        'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth'       => 2,
                                    ));
                                } else {
                                    echo '<p>Menu padrão não encontrado.</p>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
        </header>