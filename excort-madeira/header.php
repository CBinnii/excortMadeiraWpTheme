<!DOCTYPE html>
<?php $lang = function_exists('pll_current_language') ? pll_current_language() : 'pt'; ?>
<?php if ($lang === 'en') { ?>
    <html lang="en">
<?php } else if ($lang === 'pt') {?>
    <html lang="pt-PT">
<?php } else {?>
    <html lang="nl">
<?php } ?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png">
  <title>
    <?php
      if (is_tax('location') || is_search()) {
        // Recebe o texto customizado dos filtros definidos nos templates
        echo esc_html( wp_get_document_title() );
      } else {
        // Base padrão em todas as outras telas
        echo 'The Girl Next Door - ' . esc_html( get_the_title() );
      }
    ?>
  </title>

  <!-- 🚀 Preload Rufina fonts (load instantly before CSS) -->
  <link rel="preload" href="/wp-content/uploads/fonts/rufina/rufina-v17-latin-regular.woff2" as="font" type="font/woff2" crossorigin>
  <link rel="preload" href="/wp-content/uploads/fonts/rufina/rufina-v17-latin-700.woff2" as="font" type="font/woff2" crossorigin>

  <!-- 🧠 WordPress core & plugin hooks -->
  <?php wp_head(); ?>

  <!-- 🎨 Main stylesheet -->
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/style.css">

  <!-- 💅 Inline reset & minor tweaks -->
  <style>
    html, body {
      margin-top: 0 !important;
      font-family: 'Rufina', serif !important; /* ensure Rufina applies globally */
    }
    img {
      -webkit-user-drag: none;
      user-drag: none;
    }
  </style>
</head>

    <body>
        <header id="header" class="header">
            <nav class="navbar">
                <div class="container p-0">
                    <div class="row w-100 m-0">
                        <div class="col-sm-8 logo-header">
                            <a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="Logo"></a>

                            <div class="desktop d-flex align-items-center" id="navbar-menu-desktop-pattern">
                                <nav class="navbar navbar-expand-lg">
                                    <div class="container-fluid">
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                                <li class="nav-item">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        <a class="nav-link <?php echo (is_page(array('acompanhantes','escorts'))) ? 'active' : ''; ?>"" aria-current="page" href="<?php echo get_home_url(); ?>/acompanhantes">Acompanhantes</a>
                                                    <?php else : ?>
                                                        <a class="nav-link <?php echo (is_page(array('acompanhantes','escorts'))) ? 'active' : ''; ?>"" aria-current="page" href="<?php echo get_home_url(); ?>/escorts">Escorts</a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="nav-item">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        <a class="nav-link <?php echo (is_page(array('servicos','services'))) ? 'active' : ''; ?> " aria-current="page" href="<?php echo get_home_url(); ?>/servicos">Serviços</a>
                                                    <?php else : ?>
                                                        <a class="nav-link <?php echo (is_page(array('servicos','services'))) ? 'active' : ''; ?> " aria-current="page" href="<?php echo get_home_url(); ?>/services">Services</a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            Cidades
                                                        <?php else : ?>
                                                            Locations
                                                        <?php endif; ?>
                                                    </a>
                                                    <div class="dropdown-menu px-3 rounded-3 border-0 shadow">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/acompanhantes-lisboa">
                                                                <?php else : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/lisbon-escorts">
                                                                <?php endif; ?>
                                                                    <div class="d-flex align-items-center py-3 px-1 rounded-3">
                                                                        <div class="icon rounded-3 fs-1">
                                                                            <img src="https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-lisbon-portugal.png" alt="Lisboa Image">
                                                                        </div>
                                                                        <div class="text ps-3">
                                                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                                <h5>Lisboa</h5>
                                                                            <?php else : ?>
                                                                                <h5>Lisbon</h5>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/acompanhantes-porto">
                                                                <?php else : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/porto-escorts">
                                                                <?php endif; ?>
                                                                    <div class="d-flex align-items-center py-3 px-1 rounded-3">
                                                                        <div class="icon rounded-3 fs-1">
                                                                            <img src="https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-porto-portugal.png" alt="Porto Image">
                                                                        </div>
                                                                        <div class="text ps-3">
                                                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                                <h5>Porto</h5>
                                                                            <?php else : ?>
                                                                                <h5>Porto</h5>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/acompanhantes-madeira">
                                                                <?php else : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/madeira-escorts">
                                                                <?php endif; ?>
                                                                    <div class="d-flex align-items-center py-3 px-1 rounded-3">
                                                                        <div class="icon rounded-3 fs-1">
                                                                            <img src="https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-madeira-portugal.png" alt="Madeira Image">
                                                                        </div>
                                                                        <div class="text ps-3">
                                                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                                <h5>Madeira</h5>
                                                                            <?php else : ?>
                                                                                <h5>Madeira</h5>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/acompanhantes-algarve">
                                                                <?php else : ?>
                                                                    <a href="<?php echo get_home_url(); ?>/algarve-escorts">
                                                                <?php endif; ?>
                                                                    <div class="d-flex align-items-center py-3 px-1 rounded-3">
                                                                        <div class="icon rounded-3 fs-1">
                                                                            <img src="https://the-girl-next-door.com/wp-content/uploads/2025/08/escorts-algarve-portugal.png" alt="Algarve Image">
                                                                        </div>
                                                                        <div class="text ps-3">
                                                                            <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                                                <h5>Algarve</h5>
                                                                            <?php else : ?>
                                                                                <h5>Algarve</h5>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="nav-item">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        <a class="nav-link <?php echo (is_page(array('namorada','your-girl-next-door'))) ? 'active' : ''; ?>" href="<?php echo get_home_url(); ?>/namorada" style="width: 80px;">Match</a>
                                                    <?php else : ?>
                                                        <a class="nav-link <?php echo (is_page(array('namorada','your-girl-next-door'))) ? 'active' : ''; ?>" href="<?php echo get_home_url(); ?>/your-girl-next-door" style="width: 130px;">Your Girl</a>
                                                    <?php endif; ?>
                                                </li>
                                                <li class="nav-item">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        <a class="nav-link <?php echo (is_page(array('contato','contact'))) ? 'active' : ''; ?>" href="<?php echo get_home_url(); ?>/contato">Contato</a>
                                                    <?php else : ?>
                                                        <a class="nav-link <?php echo (is_page(array('contato','contact'))) ? 'active' : ''; ?>" href="<?php echo get_home_url(); ?>/contact">Contact</a>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="col-sm-4 menu-header">
                            <div class="navbar-menu">    
                                <div class="language-switcher d-none" id="language-switcher">
                                    <a href="<?php echo pll_home_url('en'); ?>">EN</a>/<a href="<?php echo pll_home_url('pt'); ?>">PT</a>
                                </div>
                                
                                <div class="collapse navbar-collapse desktop" id="navbar-collapse-desktop">
                                    <div class="col-sm-7 logo-header">
                                        <span class="navbar-brand"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="Logo"></span>
                                    </div>
                                    <div>
                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                            <a href="https://wa.me/351915974302?text=Ol%C3%A1%2C%20gostaria%20de%20criar%20um%20perfil.%20Como%20devo%20proceder%3F" class="d-flex f-size-18 mb-24 button bold outline medium">
                                                Anunciar
                                            </a>
                                        <?php else : ?>
                                            <a href="https://wa.me/351915974302?text=Hello%2C%20I%20would%20like%20to%20create%20a%20profile.%20How%20should%20I%20proceed%3F" class="d-flex f-size-18 mb-24 button bold outline medium">
                                                Advertise
                                            </a>
                                        <?php endif; ?>

                                        <?php
                                            $lang = function_exists('pll_current_language') ? pll_current_language() : 'pt';
                                            if ($lang === 'en') {
                                                $menu_1_name = 'Menu Mobile';
                                            } elseif ($lang === 'pt') {
                                                $menu_1_name = 'Menu Mobile PT';
                                            }

                                            $menu_hamburguer = get_term_by('name', $menu_1_name, 'nav_menu');

                                            if ($menu_hamburguer) {
                                                wp_nav_menu(array(
                                                    'menu'        => $menu_hamburguer->term_id, // Usar 'menu' em vez de 'menu_id'
                                                    'container'   => false,
                                                    'menu_class'  => 'navbar-nav me-auto mb-2 mb-lg-0',
                                                    'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    'depth'       => 2,
                                                ));
                                            } else {
                                                echo '<p>Menu Hamburguer não encontrado.</p>';
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="collapse navbar-collapse mobile" id="navbar-collapse">
                                    <div class="col-sm-7 logo-header">
                                        <span class="navbar-brand"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.svg" alt="Logo"></span>
                                    </div>

                                    <div>
                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                            <a href="https://wa.me/351915974302?text=Ol%C3%A1%2C%20gostaria%20de%20criar%20um%20perfil.%20Como%20devo%20proceder%3F" class="d-flex f-size-18 mb-24 button bold outline medium">
                                                Anunciar
                                            </a>
                                        <?php else : ?>
                                            <a href="https://wa.me/351915974302?text=Hello%2C%20I%20would%20like%20to%20create%20a%20profile.%20How%20should%20I%20proceed%3F" class="d-flex f-size-18 mb-24 button bold outline medium">
                                                Advertise
                                            </a>
                                        <?php endif; ?>

                                        <?php
                                            $menu_mobile = get_term_by('name', $menu_1_name, 'nav_menu');

                                            if ($menu_mobile) {
                                                wp_nav_menu(array(
                                                    'menu'        => $menu_mobile->term_id, // Usar 'menu' em vez de 'menu_id'
                                                    'container'   => false,
                                                    'menu_class'  => 'navbar-nav me-auto mb-2 mb-lg-0',
                                                    'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    'depth'       => 2,
                                                ));
                                            } else {
                                                echo '<p>Menu mobile não encontrado.</p>';
                                            }
                                        ?>
                                    </div>
                                    
                                    <div class="row w-100">
                                        <div class="col-12">
                                            <div class="header-site-search visible-mobile">
                                                <span class="header-site-search-icon visible-mobile"></span>
                                                <form method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                                                    <input class="header-site-search-input visible-mobile" type="text" name="s" id="keyword" placeholder="<?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>Pesquisar<?php else : ?>Search<?php endif; ?>..." value="<?php echo get_search_query(); ?>">
                                                    <button type="submit">
                                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                            Pesquisar
                                                        <?php else : ?>
                                                            Search
                                                        <?php endif; ?>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="navbar-action">
                                    <span class="social" id="social-header">
                                        <div class="header-site-search visible-desktop">
                                            <span class="header-site-search-icon visible-desktop"></span>
                                            <form method="GET" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
                                                <input class="header-site-search-input visible-desktop" type="text" name="s" id="keyword" placeholder="<?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>Pesquisar<?php else : ?>Search<?php endif; ?>..." value="<?php echo get_search_query(); ?>">
                                                <button type="submit">
                                                    <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                                        Pesquisar
                                                    <?php else : ?>
                                                        Search
                                                    <?php endif; ?>
                                                </button>
                                            </form>
                                        </div>

                                        <?php if (function_exists('pll_current_language') && pll_current_language() === 'pt') : ?>
                                            <a href="https://wa.me/351915974302?text=Ol%C3%A1,%20gostaria%20de%20criar%20um%20perfil.%20Como%20devo%20proceder?" class="button bold outline medium p-0">
                                                Anunciar
                                            </a>
                                        <?php else : ?>
                                            <a href="https://wa.me/351915974302?text=Hello,%20I%20would%20like%20to%20create%20a%20profile.%20How%20should%20I%20proceed?" class="button bold outline medium p-0">
                                                Advertise
                                            </a>
                                        <?php endif; ?>
                                    </span>

                                    <div class="desktop">
                                        <button class="navbar-toggler">
                                            <div class="menu-button" id="menu-button-desktop" onclick="menuDesktop()">
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                            </div>
                                        </button>
                                    </div>

                                    <div class="mobile">
                                        <button class="navbar-toggler">
                                            <div class="menu-button" id="menu-button" onclick="menuMobile()">
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                                <div class="bar"></div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>