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

const siteSearch = document.querySelector('.header-site-search');
const siteSearchInput = document.querySelector('.header-site-search-input');
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

var swiperHome = new Swiper(".slider-home", {
    navigation: {
        nextEl: ".swiper-button-next-slider-home",
        prevEl: ".swiper-button-prev-slider-home",
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
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
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
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
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

var swiperProfileThumb = new Swiper(".profile-thumb", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 4,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiperProfileSlider = new Swiper(".profile-slider", {
    loop: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next-profile",
        prevEl: ".swiper-button-prev-profile",
    },
    thumbs: {
        swiper: swiperProfileThumb,
    },
});