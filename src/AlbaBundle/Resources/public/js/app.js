function showMap() {
    var myLatLng = {lat: 57.474911, lng: -3.216983};
    sight = new google.maps.Map(document.getElementById('sight'), {
        zoom: 12,
        center: myLatLng,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: false
    });

    var locations = [
        {
            title: 'Knockando Woolmill',
            position: {lat: 57.465735, lng: -3.355088},
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            }

        },
        {
            title: 'Linn Falls',
            position: {lat: 57.461174, lng: -3.226149},
            html: 'Linn Falls',
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            }
        },
        {
            title: 'Aberlour Distillery',
            position: {lat: 57.467516, lng: -3.228945},
            html: 'Aberlour Distillery',
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/purple-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            }
        },
        {
            title: 'The Macallan Distillery',
            position: {lat: 57.484647, lng: -3.206955},
            html: 'The Macallan Distillery',
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            }
        },
        {
            title: 'Aberlour',
            position: {lat: 57.474911, lng: -3.216983},
            html: 'Aberlour',
            icon: {
                url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
                scaledSize: new google.maps.Size(32, 32)
            }
        }
    ];

    locations.forEach( function( element, index ){
        var marker = new google.maps.Marker({
            position: element.position,
            map: sight,
            title: element.title,
            icon: element.icon
        });
    });
}


