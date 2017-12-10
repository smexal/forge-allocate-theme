var themeMain = {
    animationTimer : 300,

    init : function() {
        themeMain.formFocus();
        themeMain.overlayFitsize();
    },

    overlayFitsize : function() {
        $(".trigger-overlay-fitsize").each(function() {
            var ov = $('' + $(this).data('trigger'));
            var timeout = false;
            ov.hover(function() {
                clearTimeout(timeout);
            }, function() {
                timeout = setTimeout(function() {
                    $("body").removeClass("login-overlay-open");
                    ov.addClass('animate-out');
                    setTimeout(function() {
                        ov.removeClass('animate-out');
                        ov.addClass('hidden');
                    }, themeMain.animationTimer);
                }, 2000);
            });

            $(this).on('click', function() {
                var ov = $('' + $(this).data('trigger'));
                if(ov.hasClass('hidden')) {
                    ov.removeClass('hidden');
                    ov.addClass('animate-in');
                    $("body").addClass("login-overlay-open");
                    setTimeout(function() {
                        ov.removeClass('animate-in');
                    }, themeMain.animationTimer);
                } else {
                    ov.addClass('animate-out');
                    $("body").removeClass("login-overlay-open");
                    setTimeout(function() {
                        ov.removeClass('animate-out');
                        ov.addClass('hidden');
                    }, themeMain.animationTimer);
                }
            });
        });
    },

    formFocus : function() {
        $("label.control-label").each(function(){
            $(this).on('click', function() {
                $(this).next().focus();
            });
        });
        $("input[type='text'], input[type='password'], textarea").each(function() {
            if($(this).val().length > 0) {
                $(this).parent().addClass('focus');
            }

            $(this).on('focus', function() {
                if(! $(this).parent().hasClass('focus')) {
                    $(this).parent().addClass('focus');
                }
            }).on('blur', function() {
                if($(this).val().length == 0) {
                    $(this).parent().removeClass('focus');
                }
            })
        })
    },

};

$(document).ready(function() {
    themeMain.init();
})
