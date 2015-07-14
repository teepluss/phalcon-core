var jQuery = require('../vendor/jquery/dist/jquery.min');

class ApppleMusic {
    constructor() {
        this.endpoint = "https://itunes.apple.com/search";
    }
    finding(term, result) {
        var requestCount = 0;

        jQuery.ajax({
            url: this.endpoint,
            jsonp: 'callback',
            dataType: 'jsonp',
            requestCount: ++requestCount,
            data: {
                term: term,
                format: 'json'
            },
            success: function(response) {
                if (requestCount !== this.requestCount) return;
                result(response);
            }
        })
    }
}

var appleMusic = new ApppleMusic();

jQuery('#search').on('keypress', function(e) {
    var q = jQuery(this).val();
    appleMusic.finding(q, function(response) {
        var tracks = [];

        jQuery(response.results).each(function(i, v) {
            let track = "<li>" + v.trackName + ' - ' + v.artistName + "</li>";
            tracks.push(track);
        });

        jQuery('#apple').html(tracks.join(''));
    });
});

