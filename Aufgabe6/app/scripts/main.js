(function($, L) {
    "use strict";

    var global = this;

    function LocateMe() {
        this.locationURL = window.location.hash.slice(1);
        this.locationURL = this.locationURL || null;
        this.baseURL = 'http://localhost:9000/'
        this.init();


    }

    LocateMe.prototype.init = function() {
        $('.enterLocation').hide();
        $('.locationLink').hide();
        $('.showLocation').hide();

        if (!this.locationURL) {
            $('.locateMeButton').click(this.retrieveCurrentLocation.bind(this));
            $('.enterLocation').show();
        } else {
            var location = this.locationURL.split('|');
            var map = L.map('map').setView(location[0], location[1], 13);
            var marker = L.marker([location[0], location[1]]).addTo(map);

            $('.showLocation').show();
        }


    };

    LocateMe.prototype.retrieveCurrentLocation = function() {
        if (!navigator.geolocation) {
            alert('Geolocation isn\'t supported by your browser.');
        } else {
            navigator.geolocation.getCurrentPosition(this.showLocationLink.bind(this));
        }
    };

    LocateMe.prototype.showLocationLink = function(location) {
        var url = this.baseURL + '#' + location.coords.latitude + '|' +  location.coords.longitude;
        var $locationLink = $('.locationLink');
        $('<a></a>')
            .attr('href', url)
            .text(url)
            .click(function(event) {
                global.location.href=url;
            })
            .appendTo($locationLink);

        $locationLink.show();
    };


    new LocateMe();

}).call(this, jQuery, L);