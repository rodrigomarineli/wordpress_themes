var map;
var lastOpenedInfoWindow;
var markers = [];
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

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: -23.599804, lng: -46.720112},
		zoom: 14,
		scrollwheel: false,
	});
	var options = {
		enableHighAccuracy: true,
		timeout: 5000,
		maximumAge: 0
	};

	function success(pos) {
	  var crd = pos.coords;

		var pos = {
			lat: crd.latitude,
			lng: crd.longitude
		};
		map.setCenter(pos);
		var marker = new google.maps.Marker({
			map: map,
			position: pos,
			icon: template_url+'/images/icon/icon_local.png'
		});
		markers.push(marker);

	};

	function error(err) {
		console.warn('ERROR(' + err.code + '): ' + err.message);
	};

	navigator.geolocation.getCurrentPosition(success, error, options);


	var script = document.createElement('script');
	script.src = template_url+'/js/ajax/unidades.php';
	document.getElementsByTagName('head')[0].appendChild(script);
}

window.eqfeed_callback = function(results) {
	for (var i = 0; i < results.features.length; i++) {
		endereco = results.features[i].properties.place+' - '+results.features[i].properties.cidade;
		AddMarker(endereco, results.features[i].properties.title, results.features[i].properties.tel, results.features[i].properties.email, results.features[i].properties.facebook, results.features[i].properties.twitter, results.features[i].properties.instagram, results.features[i].properties.url)
	}
}

function AddMarker(address,title,tel,email,facebook,twitter,instagram,url) {
	geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		'address': address
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			var myOptions = {
				zoom: 6,
				center: results[0].geometry.location,
			}

			var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location,
				title: title,
				icon: template_url+'/images/icon/map.png'
			});
			f = (facebook != '') ? '<a target="_blank" href="'+facebook+'" class="icon_facebook"></a>' : '';
			t = (twitter != '') ? '<a target="_blank" href="'+twitter+'" class="icon_twitter"></a>' : '';
			i = (instagram != '') ? '<a target="_blank" href="'+instagram+'" class="icon_instagram"></a>' : '';
			s = (url != '') ? '<div id="url"><a target="_blank" href="'+url+'"><img src="'+template_url+'/images/icon/icon_site.png" alt="" /><strong><span>Acesse o site da unidade</span></strong></a></div>' : '';
			var contentString = 
				'<div id="content">'+
					'<div id="siteNotice">'+
					'</div>'+
					'<h1 id="firstHeading" class="firstHeading"><strong>'+title+'</strong></h1>'+
					'<div id="bodyContent">'+
						'<p>'+address+'<br/>'+tel+'<br/>'+email+'</p>'+
						'<div id="social">'+
							f+
							t+
							i+
						'</div>'+
						s+
					'</div>'+
				'</div>';
			attachSecretMessage(marker, contentString);
		}
	});
}

function attachSecretMessage(marker, secretMessage) {
	var infowindow = new google.maps.InfoWindow({
		content: secretMessage
	});

	marker.addListener('click', function() {
		closeLastOpenedInfoWindo();
		map.setCenter(marker.getPosition());
		map.setZoom(10);
		map.panBy(-80, 0);
		infowindow.open(marker.get('map'), marker);
		lastOpenedInfoWindow = infowindow;
	});
}
google.maps.event.addDomListener(window, 'load', initialize)

function closeLastOpenedInfoWindo() {
	if (lastOpenedInfoWindow) {
		lastOpenedInfoWindow.close();
	}
}

$(function() {
	$( "#tabs" ).tabs();
});

function codeAddress(address,zoom,pin) {
	geocoder = new google.maps.Geocoder();
	geocoder.geocode({
		'address': address
	}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			map.setZoom(zoom);
			if(typeof pin != 'undefined') {
				deleteMarkers();
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					title: address,
					icon: template_url+'/images/icon/icon_local.png'
				});
				markers.push(marker);
			}
		}
	});
}

function deleteMarkers() {
	clearMarkers();
	markers = [];
}

function clearMarkers() {
	setMapOnAll(null);
}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}

$(document).ready(function(){

	$('#estado').change(function(event) {
		var estado = $('option:selected',this).text();
		var sigla = $('option:selected',this).val();
		$.ajax({
			url: template_url+'/js/ajax/filtro.php',
			type: 'POST',
			url: template_url+'/js/ajax/filtro.php',
			data: {sigla: sigla, label: 'Cidades'},
		})
		.done(function(data) {
			$('#cidade').html(data);
			$('#unidade').html('<option value=""></option>');
		})
		var place = codeAddress(estado,6);
	});

	$('#cidade').change(function(event) {
		var estado = $('#estado option:selected').text();
		var cidade = $('option:selected',this).text();
		var sigla = $('#estado option:selected',this).val();
		local = cidade+'/'+estado;
		$.ajax({
			url: template_url+'/js/ajax/filtro.php',
			type: 'POST',
			url: template_url+'/js/ajax/filtro.php',
			data: {sigla: sigla, cidade: cidade, label: 'Unidades'},
		})
		.done(function(data) {
			$('#unidade').html(data);
		})
		var place = codeAddress(local,10);
	});

	$('#unidade').change(function(event) {
		var estado = $('#estado option:selected').text();
		var cidade = $('#cidade option:selected').text();
		var unidade = $('option:selected',this).val();
		local = unidade+' '+cidade+'/'+estado;
		var place = codeAddress(local,14);
	});

	initAutocomplete();

	$('#fav ul li a').click(function(event) {
		event.preventDefault();
		anchor = $(this).attr('href');
		inicial = $(window).scrollTop();
		if(inicial <= 71) {
			var targetOffset = $(anchor).offset().top - 220;
		}
		else{
			var targetOffset = $(anchor).offset().top - 110;	
		}
		$('html,body').animate({scrollTop: targetOffset}, 'slow');
	});

	$('section#cursos article div ul > li > a').click(function(event) {
		event.preventDefault();
		anchor = $(this).attr('href');
		if(anchor.indexOf('#') != -1) {
			inicial = $(window).scrollTop();
			if(inicial <= 71) {
				var targetOffset = $(anchor).offset().top - 220;	
			}
			else {
				var targetOffset = $(anchor).offset().top - 110;
			}
			$('html,body').animate({scrollTop: targetOffset}, 'slow');
		}
		else {
			location.href=anchor;
		}
	});

	$('section#cursos article div ul > li a strong').append('<br/>');
	$('section#cursos article div ul > li a em').append('<br/>');

	$("#accordion p").hide();
	$(document).on('click', '#accordion h4', function(event) {
		event.preventDefault();
		$('+ p',this).slideToggle("slow");
	});

	$('.top a').click(function(event){
		event.preventDefault();
		$('html, body').animate({scrollTop:0}, 'slow');
	});

	var scre = $("body").width();

	if(scre >= 768) {
		$(window).scroll(function(e){
			if($(window).scrollTop() < 71){
				$('header nav').css({
					'position': 'initial',
					'top': '0'
				});
			}
			else{
				$('header nav').css({
					'position': 'fixed',
					'top': '0'
				});
			}
		});
	}

	$(document).on('click', '.load_more', function(event) {
		event.preventDefault();
		var qtd_posts = $('#blog .post').size();
		$.ajax({
			url: template_url+'/js/ajax/more_post.php',
			type: 'POST',
			data: {qtd_posts: qtd_posts},
			beforeSend: function(){
				$('#blog .load').show();
			},
		})
		.done(function(response) {
			$('#blog #posts_blog').append(response);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			$('#blog .load').hide();
		});
		
	});

	$(".light_video").colorbox({
		iframe:true, 
		innerWidth:640, 
		innerHeight:390,
		close: "fechar"
	});

	$('.menu_mobile').change(function(event) {
		location.href = $('option:selected',this).val();

	});

	$(window).scroll(function(event) {
		if($(window).scrollTop() <= 1){
			$('footer div.top a').hide();	
		}
		else {
			$('footer div.top a').show();
		}
	});


});