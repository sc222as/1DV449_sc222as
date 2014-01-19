function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(56.245, 12.863),
        zoom: 13

    };

    
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


    $.ajax({

        dataType: 'json',
        url: "data.php",
        error: function () { alert("Ett fel har inträffat, var vänlig försök igen lite senare"); },
        success: function (data) {

            var text = '';



            var marker;
            var markers = new Array();
            var len = data.length;


            var infowindow2 = new google.maps.InfoWindow({
        });
        var infowindow = new google.maps.InfoWindow({
            maxWidth: 360
        });


        for (var i = 0; i < len; i++) {

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(data[i].lat, data[i].long),
                map: map,
                url: data[i].adresser

            });




            
            markers.push(marker)

            google.maps.event.addListener(marker, "mouseover", (function (marker, i) {
                return function () {

                    infowindow2.setContent('<p>' + 'Adress: ' + data[i].adresser + ' </br> ' + "Klicka för mer info" + '<p>');
                    
                    
                    infowindow.close(map, this);
                    infowindow2.open(map, this);
                }
            })(marker, i));

            google.maps.event.addListener(marker, 'mouseout', function () {
                infowindow2.close();
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {

                return function () {

                    map.setZoom(17);
                    map.setCenter(marker.getPosition());
                    $.ajax({

                        dataType: 'json',
                        url: "energidata.php",
                        error: function () { alert("Ett fel har inträffat, var vänlig försök igen lite senare."); },
                        success: function (data) {
                            var len = data.length;
                            infowindow.setContent('<p>' + 'Elleverantör: ' + data[0].leverantor + ' - Pris:' + data[0].pris + ' Öre/KwH </br> ' + 'Elleverantör: ' + data[1].leverantor + ' - Pris:' + data[1].pris + ' Öre/KwH </br> ' + 'Elleverantör: ' + data[2].leverantor + ' - Pris:' + data[2].pris + ' Öre/KwH'+'</p>');
                            infowindow.open(map, marker);

                        }

                    });
                }
            })(marker, i));
            
        }


    }


});

}
google.maps.event.addDomListener(window, 'load', initialize);