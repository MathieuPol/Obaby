$('.owl-carousel').owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    margin: 50,
    dots: true,
    loop: true,
    nav : false,
    navText : [
        '<i class="bi bi-arrow-left"></i>',
        '<i class="bi bi-arrow-right"></i>'
    ],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:2
        }
    }
})