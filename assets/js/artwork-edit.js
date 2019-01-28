import $ from "jquery"
import './vendors/leaflet/leaflet.js'

var $collectionHolder;

jQuery(document).ready(function() {
  // Get the ul that holds the collection of tags
  $collectionHolder = $('#artwork_documents');
  var $addTagLink = $('.add-document-link');

  // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)
  $collectionHolder.data('index', $collectionHolder.find(':input').length);

  $addTagLink.on('click', function(e) {
    // prevent the link from creating a "#" on the URL
    e.preventDefault();

    // add a new tag form (see next code block)
    addTagForm($collectionHolder);
  });

  $collectionHolder.find('.item-document').each(function() {
    addTagFormDeleteLink($(this));
  });

  $('body').on('click', '.field-image-btn-gps', function(e) {
    const lat = $(e.currentTarget).data('lat');
    const long = $(e.currentTarget).data('long');

    if (lat && long) {
      $('#artwork_poi_latitude').val(lat);
      $('#artwork_poi_longitude').val(long);
      getAddressFromCoordinates();
    }
  });

    $(function() {
        $('#search-artist').on('keyup', function() {
            var pattern = $(this).val();
            $('.searchable-container .items').hide();
            $('.searchable-container .items').filter(function() {
                return $(this).text().match(new RegExp(pattern, 'i'));
            }).show();
        });
    });
    $( "#author-toggle" ).click(function() {
        $( "#author-div" ).toggle();
    });
});

function getAddressFromCoordinates() {
    var lat = $('#artwork_poi_latitude').val();
    var long = $('#artwork_poi_longitude').val();
    const key = 'AIzaSyAW-nTdgEOCmpA9z7mblXxh8jh4bm0yV-A';
    $.ajax({
        url : 'https://maps.googleapis.com/maps/api/geocode/json',
        type : 'GET',
        dataType : 'json',
        data : 'latlng=' + lat + ',' + long + '&key=' + key,
        success : function(data){
            var result = data.results.shift();
            console.log(result);
            $.each(result['address_components'], function( key, value ) {
                if (value.types.includes('administrative_area_level_1') && $('#artwork_poi_city').val == '') {
                    $('#artwork_poi_city').val(value.long_name);
                } else if (value.types.includes('country')) {
                    $('#artwork_poi_country').val(value.long_name);
                } else if (value.types.includes('locality')) {
                    $('#artwork_poi_city').val(value.long_name);
                }
            });

            $('#artwork_poi_address').val(result['formatted_address']);
        }
    });
}

function addTagForm($collectionHolder) {
  // Get the data-prototype explained earlier
  var prototype = $collectionHolder.data('prototype');

  // get the new index
  var index = $collectionHolder.data('index');

  var newForm = prototype;
  // You need this only if you didn't set 'label' => false in your tags field in TaskType
  // Replace '__name__label__' in the prototype's HTML to
  // instead be a number based on how many items we have
  // newForm = newForm.replace(/__name__label__/g, index);

  // Replace '__name__' in the prototype's HTML to
  // instead be a number based on how many items we have
  newForm = newForm.replace(/__name__/g, index);

  // increase the index with one for the next item
  $collectionHolder.data('index', index + 1);

  var $newForm = $(newForm);

  $collectionHolder.append($newForm);

  addTagFormDeleteLink($newForm);
}

function addTagFormDeleteLink($tagFormLi) {
  var $removeFormA = $('<button class="btn btn-danger btn-sm">' + translations.delete + '</button>');
  $tagFormLi.find('label .field-image-actions').append($removeFormA);

  $removeFormA.on('click', function(e) {
    // prevent the link from creating a "#" on the URL
    e.preventDefault();

    // remove the li for the tag form
    $tagFormLi.remove();
  });
}

const initMap = () => {

    var map = L.map('map', { scrollWheelZoom:false }).setView([47.218371, -1.553621], 10);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
        '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
        id: 'mapbox.streets'
    }).addTo(map);

    map.on('click', function (e) {
        $('#artwork_poi_latitude').val(e.latlng.lat);
        $('#artwork_poi_longitude').val(e.latlng.lng);

        getAddressFromCoordinates();
    });

    var MapboxGeocoder = require('@mapbox/mapbox-gl-geocoder');

    var geocoder = new MapboxGeocoder({
        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
    });

    // map.addControl(geocoder);
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));

}

$(function () {
    initMap();
})