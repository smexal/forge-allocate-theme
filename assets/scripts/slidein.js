var slidein = {

    init : function() {
        $("a.to-overlay").each(function() {
            $(this).on('click', function(e) {
                e.stopImmediatePropagation();
                e.preventDefault();

                var url = $(this).attr('href');
                slidein.open(url);
            });
        });
    },

    open : function(url) {
        var overlay = $("#slidein-overlay");
        if(! $("body").hasClass('overlay-open')) {
            $("body").addClass('overlay-open');
        }
        if(! overlay.hasClass('in')) {
            overlay.addClass('in');
        }
        if(! overlay.hasClass('loading')) {
            overlay.addClass('loading');
        }
        slidein.bindClose();
        slidein.loadData(url);
    },

    loadData : function (_url) {
        $.ajax({
            url: _url,
        }).done(function( data ) {
            $("#slidein-overlay .content").html(data);
            $("#slidein-overlay").removeClass("loading");
            $("#slidein-overlay .content").addClass('has-content');
        });
    },

    close : function() {
        var overlay = $("#slidein-overlay");
        if($("body").hasClass('overlay-open')) {
            $("body").removeClass('overlay-open');
        }
        if(overlay.hasClass('in')) {
            overlay.removeClass('in');
        }
        if(overlay.hasClass('loading')) {
            overlay.removeClass('loading');
        }
        overlay.find(".content").empty().removeClass('has-content');
    },

    bindClose : function() {
        $("body.overlay-open header, body.overlay-open > .content").unbind('click').on('click', function() {
            slidein.close();
        });
        $("#slidein-overlay > .close").unbind('click').on('click', function() {
            slidein.close();
        });
        $(document).keyup(function(e) {
            if (e.keyCode === 27) {
                slidein.close();
            }
        });
    }


}
$(document).ready(function() {
    slidein.init();
})