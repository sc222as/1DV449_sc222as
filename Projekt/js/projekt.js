function initialize() {
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
        center: new google.maps.LatLng(56.245, 12.863),
        zoom: 13

    };

    
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


    $.ajax({

        dataType: 'json',
        url: "data.php",
        error: function () { console.log("ao"); },
        success: function (data) {

            var text = '';

            var infowindow = new google.maps.InfoWindow({
                maxWidth: 260
            });
            
            var marker;
            var markers = new Array();
            var len = data.length;

console.log(data[0].long);



            for (var i = 0; i < len; i++) {
                

                //                function sleep(miliseconds) {
                //                    var currentTime = new Date().getTime();

                //                    while (currentTime + miliseconds >= new Date().getTime()) {
                //                    }
                //                }

                //                sleep(1000);
//                geocoder.geocode({ 'address': data[i] }, function (results) {

//                    var marker = new google.maps.Marker({
//                        map: map,
//                        position: results[0].geometry.location

//                    });

//                });

                //                                markers.push(marker)

                //                                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                //                                    return function () {

                //                                        infowindow.setContent('<p>' + 'Adress: ' + data[i] + '</p>');
                //                                        infowindow.open(map, marker);
                //                                    }
                //                                })(marker, i));
            }

            alert("Done");
        }


    });

}
google.maps.event.addDomListener(window, 'load', initialize);