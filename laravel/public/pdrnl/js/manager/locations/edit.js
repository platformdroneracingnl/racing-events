let markerText = {
    'nl': 'Aangewezen locatie',
    'de': 'Bestimmter Ort',
    'en': 'Chosen location'
}

function mapPicker() {
    var attrib = 'Map data &copy; PDRNL';

    // Create leaflet map and view location.
    var map = new L.map("map", {
        zoomControl: false,
        scrollWheelZoom: true,
        keyboard: false,
        dragging: !L.Browser.mobile,
        tap: false
    }).setView([latitude, longitude], 10);

    // Google Hybrid map
    var googleHybrid = L.tileLayer('https://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        minZoom: 6,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    // Google Streep map
    var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        minZoom: 8,
        subdomains:['mt0','mt1','mt2','mt3'],
        attribution: attrib
    }).addTo(map);

    // Zoom controls
    L.control.zoom({
        position:'bottomright'
    }).addTo(map);

    // To locate (GPS) a user
    var lc = L.control.locate({
        position: 'topleft',
        strings: {
            title: "Toon me waar ik ben"
        },
        locateOptions: {
            maxZoom: 15,
            enableHighAccuracy: true
        }
    }).addTo(map);

    // Green marker
    var greenIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
    });

    var marker = L.marker([latitude,longitude], {icon: greenIcon}).addTo(map);
    function updateMarker(lat, lng, lang) {
        marker
            .setLatLng([lat, lng])
            .bindPopup(lang)
            .openPopup();
    };

    map.on('click', function(e) {
        $('#form_latitude').val(e.latlng.lat);
        $('#form_longitude').val(e.latlng.lng);
        updateMarker(e.latlng.lat, e.latlng.lng, markerText["nl"]);
        reversLookUp(e.latlng.lat, e.latlng.lng);
    })

    function reversLookUp(lat, lng) {
        $.get('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat='+lat +'&lon='+lng, function(data) {
            // console.log(data.address);
            // Country
            // $('#form_country').val(data.address.country);
            // Province
            $('#form_province').val(data.address.state);
            // City
            $('#form_city').val(getCity(data));
            // Zip Code
            $('#form_zip_code').val(data.address.postcode);
            // Street
            $('#form_street').val(getStreet(data));
            // House number'
            $('#form_house_number').val(data.address.house_number);

            // Get the right city name
            function getCity(data) {
                if (data.address.city != null) {
                    return data.address.city.replace(/'/g, "")
                } else if (data.address.town != null) {
                    return data.address.town
                } else if (data.address.village != null) {
                    return data.address.village
                }
            };

            // Get the right street name
            function getStreet(data) {
                if (data.address.path != null) {
                    return data.address.path
                } else if (data.address.road != null) {
                    return data.address.road
                }
            }

        });
    }

    var baseMaps = {
        "Google Streets": googleStreets,
        "Google Hybrid": googleHybrid
    };

    var control = L.control.layers(baseMaps).addTo(map);
}

$(document).ready(function() {
    mapPicker();
    $(".select2").select2();
})

// Upload location image
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#img-upload').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Change image preview
$("#customFile").change(function(){
    readURL(this);
});