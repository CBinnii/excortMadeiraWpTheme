// MENU
function menuDesktop() {
    var menu = document.getElementById("menu-button-desktop");
    var collapse = document.getElementById("navbar-collapse-desktop");
    var menuPattern = document.getElementById("navbar-menu-desktop-pattern");
    var socialHeader = document.getElementById("social-header");

    if (collapse.classList.contains("show")) {
        collapse.classList.remove("show");
    } else {
        collapse.classList.add("show");
    }

    if (menuPattern.classList.contains("d-none")) {
        menuPattern.classList.remove("d-none");
    } else {
        menuPattern.classList.add("d-none");
    }

    if (menu.classList.contains("cross")) {
        menu.classList.remove("cross");
    } else {
        menu.classList.add("cross");
    }
}

// MENU
function menuMobile() {
    var menu = document.getElementById("menu-button");
    var collapse = document.getElementById("navbar-collapse");

    if (collapse.classList.contains("show")) {
        collapse.classList.remove("show");
    } else {
        collapse.classList.add("show");
    }

    if (menu.classList.contains("cross")) {
        menu.classList.remove("cross");
    } else {
        menu.classList.add("cross");
    }
}

// MENU WITH SUBMENU
const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');

menuItemsWithChildren.forEach(function (menuItem) {
    // Adiciona o evento de clique apenas nos itens com submenu
    menuItem.addEventListener('click', function (e) {
        const link = e.target.closest('a');

        // Verifica se o link possui um href válido (não #)
        if (link && link.getAttribute('href') !== '#') {
            return; // Permite a navegação
        }

        // Caso contrário, previne o comportamento padrão e alterna o submenu
        e.preventDefault();
        this.classList.toggle('active');
    });
});

// Função para fechar o submenu quando clicar fora
document.addEventListener('click', function (e) {
    const target = e.target;
    const hasChildren = document.querySelector('.menu-item-has-children.active');

    // Verifica se o clique ocorreu fora do menu ou do submenu
    if (hasChildren && !hasChildren.contains(target)) {
        hasChildren.classList.remove('active');
    }
});

// SEARCH 
const siteSearch = document.querySelector('.header-site-search.visible-desktop');
const siteSearchInput = document.querySelector('.header-site-search-input.visible-desktop');
const nav = document.querySelector('.js-nav');

if (siteSearch) {
    document.addEventListener('click', (event) => {
        const withinBoundaries = event.composedPath().includes(siteSearch)

        if (withinBoundaries) {
            siteSearch.classList.add('active');

            setTimeout(function () {
                if (siteSearchInput) {
                    siteSearchInput.focus();
                }
            }, 100);
        } else {
            if (!event.composedPath().includes(nav)) {
                siteSearch.classList.remove('active');
            }
        }
    })
}

document.addEventListener('DOMContentLoaded', function () {
    const link = document.getElementById('register');
    if (link) {
        link.textContent = 'Be a member'; // Substitua pelo texto desejado
    }
});

// SEARCH 
const siteSearchMobile = document.querySelector('.header-site-search.visible-mobile');
const siteSearchInputMobile = document.querySelector('.header-site-search-input.visible-mobile');
const navMobile = document.querySelector('.js-nav');

if (siteSearchMobile) {
    document.addEventListener('click', (event) => {
        const withinBoundaries = event.composedPath().includes(siteSearchMobile)

        if (withinBoundaries) {
            siteSearchMobile.classList.add('active');

            setTimeout(function () {
                if (siteSearchInputMobile) {
                    siteSearchInputMobile.focus();
                }
            }, 100);
        } else {
            if (!event.composedPath().includes(navMobile)) {
                siteSearchMobile.classList.remove('active');
            }
        }
    })
}

var swiperHome = new Swiper(".slider-home", {
    navigation: {
        nextEl: ".swiper-button-next-slider-home",
        prevEl: ".swiper-button-prev-slider-home",
    },
    loop: true,
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 16,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 1,
        },
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: true,
    },
});

var swiperGeneral = new Swiper(".slider-general", {
    navigation: {
        nextEl: ".swiper-button-next-slider-general",
        prevEl: ".swiper-button-prev-slider-general",
    },
});

var swiperTopExcorts = new Swiper(".slider-top-escorts", {
    navigation: {
        nextEl: ".swiper-button-next-top-escorts",
        prevEl: ".swiper-button-prev-top-escorts",
    },
    loop: true,
    breakpoints: {
        240: {
            slidesPerView: "auto",
            spaceBetween: 2,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 2,
        },
    },
});

var swiperTopExcorts = new Swiper(".slider-profile", {
    navigation: {
        nextEl: ".swiper-button-next-profile",
        prevEl: ".swiper-button-prev-profile",
    },
});

var swiperBlog = new Swiper(".slider-blog", {
    navigation: {
        nextEl: ".swiper-button-next-blog",
        prevEl: ".swiper-button-prev-blog",
    },
    slidesPerView: 2,
    spaceBetween: 0,
    grid: {
        rows: 3,
    },
});

var swiperWhy = new Swiper(".slider-why", {
    loop: true,
    pagination: {
        el: ".swiper-pagination-why",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 30,
            effect: "fade",
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        991: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
    },
});

var swiperProfileSlider = new Swiper(".profile-slider", {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next-profile",
        prevEl: ".swiper-button-prev-profile",
    },
});