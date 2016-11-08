
$(function(){
    if($("#map_canvas").length>0) {
        $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyD2CanRr0xmRpbfMTIFj7lOMmTI-fDUu7w", function () {
            map_initialize($('#map_address').html());
        });
    }
});


function map_initialize(address){
    console.log("map init");
    var geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
        zoom: 15,
        center: latlng,
        mapTypeControl: true,
        mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
        navigationControl: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapDom=document.getElementById("map_canvas");
    var map = new google.maps.Map(mapDom, myOptions);
    if (geocoder) {
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
                    map.setCenter(results[0].geometry.location);

                    var infowindow = new google.maps.InfoWindow(
                        {
                            content: '<b>' + address + '</b>',
                            size: new google.maps.Size(150, 50)
                        });

                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        title: address
                    });
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });

                } else {
                    console.log("adress not found");
                    mapDom.style.display('none');
                }
            } else {
                console.log("geocode unsuccessfull :"+status);
                mapDom.style.display('none');
                //alert("Geocode was not successful for the following reason: " + status);
            }
        });
    }
}
