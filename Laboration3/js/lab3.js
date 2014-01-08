
function initialize() {

        var mapOptions = {
          center: new google.maps.LatLng(60.000, 15.644),
          zoom: 6
        };
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

                var hemma = new google.maps.LatLng(56.2394, 12.8698);
              var marker = new google.maps.Marker({
                  position: hemma,
                  map: map,
                  title: "Hello World!"
              });      
              marker.setMap(map);

 
            

              $.ajax({
                  url: 'http://api.sr.se/api/v2/traffic/messages?format=json&pagination=false&indent=true&size=100',
                  dataType: 'json',
                  success: function (data) {
                      alert("so far so good1")
                      var text = '';
                      var messages = data.messages;
                      var len = messages.length;
                      for (var i = 0; i < len; i++) {

                          var hemma = new google.maps.LatLng(messages[i].latitude, messages[i].longitude);
                          var marker = new google.maps.Marker({
                              position: hemma,
                              map: map,
                              title: messages[i].title
                          });
                          marker.setMap(map);


                          text += '<p>' + +'<br/ >' + +'<br/ >' + +'</p>'

                      }
                      $('body').html(text);

                  }

              }); 




}; 
google.maps.event.addDomListener(window, 'load', initialize);





