
function initialize() {
    
        var mapOptions = {
          center: new google.maps.LatLng(60.000, 15.644),
          zoom: 6
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

      }
      //google.maps.event.addDomListener(window, 'load', initialize);

      function getMarkers() {
          $.get("http://api.sr.se/api/v2/traffic/messages", { history: 100 }, function (data) {
              $(data).find("message").each(function () {

                  $("body").append($(this).find('description').text() + "hej");
              });


          });


      };


      //var hemma = new google.maps.LatLng(56.2394, 12.8698);
      //var marker = new google.maps.Marker({
      //    position: hemma,
      //    map: map,
      //    title: "Hello World!"
      //});      
      //marker.setMap(map);