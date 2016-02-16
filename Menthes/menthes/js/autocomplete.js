var placeSearch, autocomplete;

function initAutocomplete() {
	// Create the autocomplete object, restricting the search to geographical
	// location types.
	autocomplete = new google.maps.places.Autocomplete(
		/** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
		{types: ['geocode']}
	);

	// When the user selects an address from the dropdown, populate the address
	// fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();

	// console.log(place.address_components);
	if (!isNaN(place.address_components[0]['long_name'])) {
		endereco = place.address_components[1]['long_name']+', '+place.address_components[0]['long_name']+' '+place.address_components[3]['long_name']+'/'+place.address_components[5]['short_name']
	}
	else if (place.address_components[4] == undefined) {
		endereco = place.address_components[0]['long_name']+' '+place.address_components[2]['long_name'];
	}
	else {
		endereco = place.address_components[0]['long_name']+' '+place.address_components[2]['long_name']+'/'+place.address_components[4]['long_name'];
	}
	codeAddress(endereco,14,'true');

}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			var geolocation = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			// console.log(geolocation);
			var circle = new google.maps.Circle({
				center: geolocation,
				radius: position.coords.accuracy
			});
			// console.log(circle);
			autocomplete.setBounds(circle.getBounds());
		});
	}
}