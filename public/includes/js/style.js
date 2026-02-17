$(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 250) {
            $('.sticky-top').addClass('sticky-nav').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('sticky-nav').css('top', '-100px');
        }
    });
});

$(function () {
    if ($(window).width() > 768) {
        $('.industries ul li').hover(function () {
            handleIndustry($(this));
        });
    } else {
        $('.industries ul li').on('click', function () {
            handleIndustry($(this));
        });
    }

    function handleIndustry($el) {
        var id = $el.data('id');
        console.log(id);

        $('.industries ul li').removeClass('active');
        $el.addClass('active');

        $('.image__image').removeClass('active');
        $('.img_' + id).addClass('active');
    }
});

$(function () {
    // Owl Carousel
    var owl = $(".initiatives_section .owl-carousel");
    owl.owlCarousel({
        items: 3,
        margin: 10,
        loop: true,
        nav: true,
        autoplay: true,
        navigation: true,
        center: true,
        navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});
