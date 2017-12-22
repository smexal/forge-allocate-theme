var revealing = {
    timer : 250,
    visibility : 30,

    init : function() {
        revealing.check();
        $(window).on('scroll', function() {
            revealing.check();
        });
    },

    check : function () {
        timer = revealing.timer;
        $("body.js-active").find(".reveal:not(.in)").each(function() {
            if(calculateVisibilityForDiv($(this)) > revealing.visibility) {
                var el = $(this);
                setTimeout(function() {
                    el.addClass('in');
                }, timer);
                timer+=revealing.timer;
            }
        });
    }
}
$(document).ready(function() {
    revealing.init();
})

function calculateVisibilityForDiv(div$) {
    var windowHeight = $(window).height(),
        docScroll = $(document).scrollTop(),
        divPosition = div$.offset().top,
        divHeight = div$.height(),
        hiddenBefore = docScroll - divPosition,
        hiddenAfter = (divPosition + divHeight) - (docScroll + windowHeight);

    if ((docScroll > divPosition + divHeight) || (divPosition > docScroll + windowHeight)) {
        return 0;
    } else {
        var result = 100;

        if (hiddenBefore > 0) {
            result -= (hiddenBefore * 100) / divHeight;
        }

        if (hiddenAfter > 0) {
            result -= (hiddenAfter * 100) / divHeight;
        }

        return result;
    }
}