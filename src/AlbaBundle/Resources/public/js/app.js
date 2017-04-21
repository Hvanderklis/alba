function initialize()
{

    var locations = [
        ['Knockando Woolmill', 57.465735, -3.355088, 3],
        ['Linn Falls', 57.461174, -3.226149, 4],
        ['Aberlour Distillery', 57.467516, -3.228945, 2],
        ['The Macallan Distillery', 57.484647, -3.206955, 1],
        ['Aberlour', 57.474911, -3.216983, 5]
    ];

    var latlng = new google.maps.LatLng(57.474911,-3.216983);
    var myOptions =
        {
            zoom: 12,
            center: latlng,
            scrollwheel: false,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: false,
            mapTypeId: google.maps.MapTypeId.HYBRID
        };

    var map = new google.maps.Map(document.getElementById("sight"), myOptions);

    var marker, i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }

    var infowindow = new google.maps.InfoWindow();

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
        }
    })(marker, i));
}
