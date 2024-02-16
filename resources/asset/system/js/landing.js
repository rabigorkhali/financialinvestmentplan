(function ($) {
    "use strict";
    $('.demo-imgs .hover-link .html').on('click', function () {
        // debugger
        var type = $(this).attr("data-attr");
        var boxed = "";
        if ($(".page-wrapper").hasClass("landing-page")) {
            boxed = "landing-page";
        }
        switch (type) {
            case 'default-body': {
                $(".page-wrapper").attr("class", "page-wrapper only-body" + boxed);
                localStorage.setItem('page-wrapper', 'only-body');
                break;
            }

            case 'dark-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper dark-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper dark-sidebar');
                break;
            }

            case 'compact-wrap': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar');
                break;
            }

            case 'color-sidebar': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper color-sidebar" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper color-sidebar');
                break;
            }

            case 'compact-small': {
                $(".page-wrapper").attr("class", "page-wrapper compact-sidebar compact-small" + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small');
                break;
            }

            case 'box-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper box-layout " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper box-layout');
                break;
            }

            case 'enterprice-type': {
                $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper enterprice-type" + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type');
                break;
            }

            case 'modern-layout': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper modern-type" + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper modern-type');
                break;
            }

            case 'material-layout': {
                var contentwidth = jQuery(window).width();

                if (contentwidth > 992) {
                    $(".page-wrapper").attr("class", "page-wrapper horizontal-wrapper material-type" + boxed);
                    localStorage.setItem('page-wrapper', 'horizontal-wrapper material-type');
                } else {
                    $(".page-wrapper").attr("class", "page-wrapper compact-wrapper material-type" + boxed);
                    localStorage.setItem('page-wrapper', 'compact-wrapper material-type');
                }

                break;
            }

            case 'default': {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }

            case 'advance-type': {
                $(".page-wrapper").attr("class", "horizontal-wrapper enterprice-type advance-layout " + boxed);
                localStorage.setItem('page-wrapper', 'horizontal-wrapper enterprice-type advance-layout');
                break;
            }

            case 'material-icon': {
                $(".page-wrapper").attr("class", "compact-sidebar compact-small material-icon " + boxed);
                localStorage.setItem('page-wrapper', 'compact-sidebar compact-small material-icon');
                break;
            }

            default: {
                $(".page-wrapper").attr("class", "page-wrapper compact-wrapper " + boxed);
                localStorage.setItem('page-wrapper', 'compact-wrapper');
                break;
            }
        }

    });
})(jQuery);
