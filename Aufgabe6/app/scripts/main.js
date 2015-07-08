(function ($, L) {
	"use strict";

	var window = this;

	function LocateMe() {
		this.baseURL = 'http://localhost:9000/'
		this.$map = $('#map');
		this.$enterLocationView = $('.enterLocation');
		this.$locateMeButton = $('.locateMeButton');
		this.$locationLink = $('.locationLink');
		this.$alert = $('.alert');

		$(window).on('hashchange', function () {
			this.start();
		}.bind(this));

		this.start();
	}

	LocateMe.prototype.start = function () {
		[this.$enterLocationView, this.$map, this.$locationLink, this.$alert].forEach(function(elm) {
			elm.removeClass('hidden');
			elm.hide();
		})

		this.locationURL = window.location.hash;
		this.locationURL = this.locationURL.slice(1) || null;

		if (!this.locationURL) {
			this.initShowEnterLocationView();
		} else {
			this.initShowLocationView();
		}
	};

	LocateMe.prototype.initShowEnterLocationView = function () {
		this.$enterLocationView.show();
		this.$locateMeButton
			.unbind()
			.click(this.retrieveCurrentLocation.bind(this));
	};

	LocateMe.prototype.initShowLocationView = function () {
		var location = this.locationURL.split('|');
		if (location.length !== 2 || !location.every(jQuery.isNumeric)) {
			$('.alert').show();
			return;
		}

		if (this.map) {
			this.map.remove();
		}

		this.map = L.map(this.$map.get(0), {
			zoom: '10',
			maxZoom: 19,
			minZoom: 8,
			center: location,
			layers: [
				L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				})
			]
		});

		L.marker(location)
			.addTo(this.map)
			.bindPopup('You stay here');

		this.$map.show();
		this.map.invalidateSize();

	};

	LocateMe.prototype.retrieveCurrentLocation = function () {
		if (!navigator.geolocation) {
			alert('Geolocation isn\'t supported by your browser.');
		} else {
			navigator.geolocation.getCurrentPosition(this.showLocationLink.bind(this));
		}
	};

	LocateMe.prototype.showLocationLink = function (location) {
		var url = this.baseURL + '#' + location.coords.latitude + '|' + location.coords.longitude;
		this.$locationLink.empty().append(
			$('<a></a>')
				.attr('href', url)
				.text(url)
				.click(function (event) {
					window.history.
					window.location.href = url;
				})
		).show();
	};

	this.locateMe = new LocateMe();
	this.locateMe.start();

}).call(this, jQuery, L);
