var slidein = {

    init : function() {
        $("a.to-overlay").each(function() {
            $(this).on('click', function(e) {
                e.stopImmediatePropagation();
                e.preventDefault();

                var url = $(this).attr('href');
                slidein.open(url);

                $("#slidein-overlay").attr('refresh-on-close', $(this).attr('refresh-on-close'));
                $("#slidein-overlay").attr('refresh-target', $(this).attr('refresh-target'));
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

    refreshTarget : function(_url, _target) {
        $.ajax({
            url: _url,
        }).done(function(data) {
            $(_target).replaceWith($(data).find(_target));
            $(document).trigger("ajaxReload");
        });
    },

    loadData : function (_url) {
        $.ajax({
            url: _url,
        }).done(function( data ) {
            $("#slidein-overlay .content").html(data);
            $("#slidein-overlay").removeClass("loading");
            $("#slidein-overlay .content").addClass('has-content');
            $(document).trigger("ajaxReload");
        });
    },

    close : function() {
        var overlay = $("#slidein-overlay");

        var refreshUrl = overlay.attr('refresh-on-close');
        var refreshTarget = overlay.attr('refresh-target');

        if(typeof( refreshUrl ) !== 'undefined' && typeof(refreshTarget) !== 'undefined') {
            this.refreshTarget(refreshUrl, refreshTarget);
        }

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

$(document).ready(slidein.init);
$(document).on("ajaxReload", slidein.init);