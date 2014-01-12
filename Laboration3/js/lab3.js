function foo(cat) {
    var mapOptions = {
        center: new google.maps.LatLng(60.000, 15.644),
        zoom: 6
    };


    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    console.log(cat);
    $.ajax({

        dataType: 'json',
        url: "data.php",
        success: function (data) {

            var text = '';
            var messages = data.messages;
            var infowindow = new google.maps.InfoWindow({
                maxWidth: 260
            });

            var marker;
            var markers = new Array();
            var len = messages.length;

            for (var i = 0; i < len; i++) {




                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(messages[i].latitude, messages[i].longitude),
                    map: map

                });

                markers.push(marker)



                if (cat == messages[i].category || cat == null) {

                }
                else {
                    marker.setMap(null);

                };


                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        var date = new Date(parseInt(messages[i].createddate.substr(6)));


                        infowindow.setContent('<p>' + 'Titel: ' + messages[i].title + '<br/ > Beskrivning: ' + messages[i].description + '<br/ > Katergori: ' + messages[i].category + '<br/ > Datum: ' + date + '</p>');
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }


        }


    });

}
function getMarkersAsText() {

    $.ajax({
        url: 'http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false&indent=true&size=100',
        dataType: 'jsonp',
        success: function (data) {

            var text = '';
            var messages = data.messages;
            var len = messages.length;
            for (var i = 0; i < len; i++) {
                var date = new Date(parseInt(messages[i].createddate.substr(6)));
                text += '<p>' + 'Titel: ' + messages[i].title + '<br/ > Beskrivning: ' + messages[i].description + '<br/ > Katergori: ' + messages[i].category + '<br/ > Datum: ' + date + '</p>'

            }
            $('body').append(text);

        }

    });

};