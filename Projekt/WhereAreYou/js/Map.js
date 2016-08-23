function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(55.000, 11.000),
        zoom: 6,


    };

    
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);


    $.ajax({

        dataType: 'json',
        url: "DataRetrieve.php",
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
            var title = data[i].Name + " Time: " + data[i].Time;
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(data[i].Lat, data[i].Long),
                map: map,
                title: title

            });
            
            markers.push(marker)
            
        }


    }


});

}
google.maps.event.addDomListener(window, 'load', initialize);