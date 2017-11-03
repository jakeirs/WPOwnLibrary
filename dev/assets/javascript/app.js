/**
 *  Loading up Css using JS
 */

function loadcss(url) {
    var head = document.getElementsByTagName('head')[0],
        link = document.createElement('link');
    link.type = 'text/css';
    link.rel = 'stylesheet';
    link.href = url;
    head.appendChild(link);
    return link;
}
// console.log(window.location.origin)
loadcss( window.location.origin + '/wp-content/themes/WPThemeSequencesh01/assets/stylesheets/style.css');


/**
 * Resize fixed used to offset page header
 */
(function() {
    var throttle = function(type, name, obj) {
        obj = obj || window;
        var running = false;
        var func = function() {
            if (running) { return; }
            running = true;
            requestAnimationFrame(function() {
                obj.dispatchEvent(new CustomEvent(name));
                running = false;
            });
        };
        obj.addEventListener(type, func);
    };

    /* init - you can init any event */
    throttle("resize", "optimizedResize");
})();

/**
 * Section Devider
 */
((win, doc) => {
    'use strict';

    const dividers = doc.querySelectorAll('.section__divider');

    win.addEventListener('load', activate);
    win.addEventListener('resize', activate);

    function activate() {
        for (let i = 0, len = dividers.length; i < len; i++) {
            dividers[i].style.height = null;
            const height = dividers[i].parentNode.offsetHeight;
            const margin = parseInt(dividers[i].getAttribute('data-margin')) || 30;

            dividers[i].style.height = (height - margin - 136) + 'px';
            dividers[i].style.marginTop = margin + 'px';
        }
    }

})(window, document);



Platform.ensureJQuery(function($) {

    /**
     * Smooth Scroll to
     */
    $(document).ready( () => {
        // Select all links with hashes
        $('a[href*="#"]')
        // Remove links that don't actually link to anything
            .not('[href="#"]')
            .not('[href="#0"]')
            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                    &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                }
            });

    })


    /**
     * Needed for scroll To exact #Hash ID section ANIMATION
     */
    jQuery.easing['jswing'] = jQuery.easing['swing'];

    jQuery.extend( jQuery.easing,
        {
            def: 'easeOutQuad',

            easeInCirc: function (x, t, b, c, d) {
                return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
            },
            easeOutCirc: function (x, t, b, c, d) {
                return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
            },
            easeInOutCirc: function (x, t, b, c, d) {
                if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
                return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
            }

        });

    /**
     * Offer section
     * Open Slide by clicking More/Less button
     */
    var slideActivator = $("#slide-activator");

    $(slideActivator).click(function () {
        let text = $(slideActivator).text();
        $(slideActivator).text(
            text !== "Zwiń" ? "Zwiń" : "Więcej");
        $("#slide-container").slideToggle({
            duration: 700,
            easing: 'easeOutCirc'
        });
    });

    /**
     * features section
     * Open Slide by clicking More/Less button
     */
    var slideActivatorFeatures = $("#slide-activator--features");

    $(slideActivatorFeatures).click(function () {
        let text = $(slideActivatorFeatures).text();
        $(slideActivatorFeatures).text(
            text !== "Zwiń" ? "Zwiń" : "Więcej");
        $("#slide-container--features").slideToggle({
            duration: 700,
            easing: 'easeOutCirc'
        });
    });


    /**
     * Offset for Page header Large hero
     */
    ((win, doc) => {
        var barTop = $("#bar-top"),
            barTopHeight = $(barTop).outerHeight(),
            pageHeaderNav = $(".page-header--nav"),
            windowVariable = $(window),
            windowHeight = $(windowVariable).height(),
            calculatedHeight = parseInt(parseInt(windowHeight) - parseInt(barTopHeight));

        // console.log(`widnows: ${windowHeight}`, `barHeight: ${barTopHeight}`, `calculated Height ${calculatedHeight}`);

        $(pageHeaderNav).css( "height", `${calculatedHeight}px` );
        $(pageHeaderNav).css( "min-height", `${calculatedHeight}px` );
        $(pageHeaderNav).css( "line-height", `${calculatedHeight}px` );

        // handle event
        window.addEventListener("optimizedResize", function() {
            var barTopHeight = $(barTop).outerHeight(),
                windowHeight = $(windowVariable).height(),
                calculatedHeight = parseInt(parseInt(windowHeight) - parseInt(barTopHeight));

            event.preventDefault();
            $(pageHeaderNav).css( "height", `${calculatedHeight}px` );
            $(pageHeaderNav).css( "min-height", `${calculatedHeight}px` );
            $(pageHeaderNav).css( "line-height", `${calculatedHeight}px` );
        });

    })(window, document);



    /**
     * On carousel--team member click
     */
    var teamMemberPopup = $(".team-member__popup"),
        carousel = $("#carousel--team");

    (function popupTeamMemberContainer(teamMemberPopup) {
        $(carousel).on("click", function (event) {
            event.stopPropagation();
            var target = $(event.target)[0],
                closest = $(target).closest(".carousel__item");

            var img = $(closest).find(".carousel__img").attr("src"),
                title = $(closest).find(".carousel__title").attr("title"),
                subtitle = $(closest).find(".carousel__subtitle").attr("title"),
                soacialMedia = $(closest).find(".carousel__media").html(),
                biography = $(closest).find(".carousel__subtitle").attr("data-bio");

            var popupImg = $(teamMemberPopup).find(".team-member__img").attr("src", img),
                popupTitle = $(teamMemberPopup).find(".team-member__title").text(title),
                popupSubitle = $(teamMemberPopup).find(".team-member__subtitle").text(subtitle),
                popupSoacialMedia = $(teamMemberPopup).find(".team-member__media").html(soacialMedia),
                popupBiography = $(teamMemberPopup).find(".team-member__bio").html(biography);

            $(teamMemberPopup).toggleClass("is-active");
            $('body').on( 'click', bodyEvent ); // close modal on click anywhere else

        });

        teamMemberPopup.click( (event) => {
            event.stopPropagation();
        } )

        function bodyEvent(event) {
            if ( !$(teamMemberPopup).hasClass("is-active") ) {
                return;
            }
            $( teamMemberPopup ).toggleClass( "is-active" );
            $('body').off( 'click' );
        }

        // closing button
        var closeButton = $(".team-member__close");
        closeButton.click(function () {
            $( teamMemberPopup ).toggleClass( "is-active" );
        });
    })(teamMemberPopup);


    /**
     * Gallery shortcode:
     * Adding attr to gallery item
     * for proper working lightbox
     */

    (function galleryLightboxShortcode() {
        let gallerySelector = $('[id^="gallery-"]')[0];
        // console.log(gallerySelector);


    })()





});
/**
 * End Ensure jQuery
 */

// team carousel
var slickTeamCarousel = Platform.CarouselSimple('#carousel--team', {
    slidesToShow: 5,
    centerMode: false,
    prevArrow: document.getElementById("prev"),
    nextArrow: document.getElementById("next"),
    // respondTo: document.getElementById("carousel--team"),
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
            }
        },
        {
            breakpoint: 640,
            settings: {
                slidesToShow: 1,
            }
        },
    ]

});



// bar-tabs carousel
var slickBarTabsCarousel = Platform.CarouselSimple('#carousel--bar-tabs', {
    slidesToShow: 1,
    // centerMode: true,
    variableWidth: true,
    // dots: true,
    arrows: false,
    infinite: false
});

// change url address in themeSwitcha
(par) => {
    const themeSwitchaList = document.getElementById("theme-switcha"),
        themeSwitchaItemArray = Array.from(themeSwitchaList.children),
        originUrl = location.origin,
        themeKey = "?theme=";

    themeSwitchaItemArray.forEach( (elem, index, array) => {
        let themeSwitchaAnchor = elem.children[0],
            themeUrl = themeSwitchaAnchor.getAttribute( "href" ),
            indexThemeKey = themeUrl.indexOf(themeKey),
            substrThemeRequest = themeUrl.substr( indexThemeKey );

        themeUrl = originUrl.concat( "/", substrThemeRequest )

        /** rename url and set in href attr */

        themeSwitchaAnchor.setAttribute( "href", themeUrl );
    });
};
