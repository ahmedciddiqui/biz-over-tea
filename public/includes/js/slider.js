
window.currentLastSlide = 1;
window.totalSlides = 0;
window.isDisabled = false;
window.isAutomatic = false;
function initialize_caseslider() {
    window.currentLastSlide = 1;
    jQuery(".cases_contents")
        .find(".case_content_slide")
        .each(function (index, value) {
            window.totalSlides++;
            jQuery(this).attr("id", "cslide_" + (index + 1));
            if (index == 0) {
                jQuery(this).addClass("first");
            } else if (index == 1) {
                jQuery(this).addClass("second");
            } else if (index == 2) {
                jQuery(this).addClass("third");
            }
        });
    jQuery(".cases_images")
        .find(".flex-fixer")
        .find(".case_image_slide")
        .each(function (index, value) {
            jQuery(this).attr("id", "cimgslide_" + (index + 1));
            if (index == 0) {
                jQuery(this).addClass("first");
            }
        });
    jQuery("#total_slides").text(parseInt(window.totalSlides));
    jQuery("#current_slide").text("1");
}
function adjust_height() {
    var maxHeight = 0;
    jQuery(".case_content_slide").each(function () {
        maxHeight =
            jQuery(this).height() > maxHeight
                ? jQuery(this).height()
                : maxHeight;
    });
    jQuery(".cases_contents .flex-fixer").height(maxHeight);
}
function activate_cases_navigation() {
    var nextBtn = jQuery("#cs_next_btn");
    var prevBtn = jQuery("#cs_prev_btn");
    nextBtn.click(function () {
        do_next_slide();
        clearInterval(window.isAutomatic);
        automatic_slider();
    });
    prevBtn.click(function () {
        do_prev_slide();
        clearInterval(window.isAutomatic);
        automatic_slider();
    });
}
function do_next_slide() {
    if (disable_slide()) {
        if (window.currentLastSlide < window.totalSlides) {
            hide_cases_slide(window.currentLastSlide);
            window.currentLastSlide++;
        } else {
            hide_cases_slide(window.totalSlides);
            window.currentLastSlide = 1;
        }
        show_cases_slide(window.currentLastSlide);
    }
}
function do_prev_slide() {
    if (disable_slide()) {
        if (window.currentLastSlide == 1) {
            hide_cases_slide(window.currentLastSlide);
            window.currentLastSlide = window.totalSlides;
        } else {
            hide_cases_slide(window.currentLastSlide);
            window.currentLastSlide--;
        }
        show_cases_slide(window.currentLastSlide);
    }
}
function disable_slide() {
    if (!window.isDisabled) {
        window.isDisabled = true;
        return true;
    }
}
function hide_cases_slide(slideNum) {
    jQuery("#cslide_" + slideNum).addClass("hide_slide");
    jQuery("#cimgslide_" + slideNum).addClass("hide_slide");
    setTimeout(function () {
        jQuery("#cslide_" + slideNum)
            .removeClass("hide_slide")
            .removeClass("first");
        jQuery("#cimgslide_" + slideNum)
            .removeClass("hide_slide")
            .removeClass("first");
        window.isDisabled = false;
    }, 1000);
}
function show_cases_slide(slideNum) {
    jQuery("#cslide_" + slideNum).addClass("first");
    jQuery("#cimgslide_" + slideNum).addClass("first");
    jQuery("#current_slide").text(parseInt(slideNum));
}
function automatic_slider() {
    window.isAutomatic = setInterval(function () {
        do_next_slide();
    }, 5000);
}
function related_services_showcase(view, elementHeight) {
    var maxHeight = Math.max.apply(
        null,
        jQuery(elementHeight)
            .map(function () {
                return jQuery(this).outerHeight() + 0;
            })
            .get()
    );
    if (view == "pointer") {
        jQuery("a.related_service:not(.mobile)").each(function () {
            jQuery(
                jQuery(this).find(
                    ".inner_container, .related_service_back, .related_service_front "
                )
            ).outerHeight(maxHeight);
        });
    } else {
        jQuery("a.related_service.mobile").each(function () {
            jQuery(
                jQuery(this).find(".inner_container, .related_service_back")
            ).outerHeight(maxHeight);
        });
    }
}
function hyphensDE() {
    if (jQuery("body").hasClass("postid-12201")) {
        jQuery("h1").html(
            jQuery("h1")
                .html()
                .replace(
                    "Datendienstunternehmen",
                    "Daten&shy;dienst&shy;un&shy;ter&shy;neh&shy;men"
                )
        );
    }
}
jQuery(document).ready(function () {
    initialize_caseslider();
    activate_cases_navigation();
    automatic_slider();
    jQuery(".background-container, .animate")
        .next()
        .attr("id", "services_provided");
    if (jQuery('html[lang="de-DE"]')) {
        hyphensDE();
    }
});
jQuery(window).on("ready load resize", function () {
    related_services_showcase();
    adjust_height();
    function isTouchDevice() {
        return (
            "ontouchstart" in window ||
            navigator.maxTouchPoints > 0 ||
            navigator.msMaxTouchPoints > 0
        );
    }
    if (isTouchDevice()) {
        jQuery("a.related_service").hide();
        jQuery("a.related_service.mobile").show();
    } else {
        jQuery("a.related_service").show();
        jQuery("a.related_service.mobile").hide();
        related_services_showcase("pointer", ".related_service_back p");
    }
});

