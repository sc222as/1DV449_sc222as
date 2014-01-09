document.write('<input type="button" name="Vägtrafik" value="Vägtrafik" id="button1">');
document.write('<input type="button" name="Kollektivtrafik" value="Kollektivtrafik" id="button2">');
document.write('<input type="button" name="Planerad störning" value="Planerad störning" id="button3">');
document.write('<input type="button" name="Övrig" value="Övrig" id="button4">');
document.write('<input type="button" name="Alla Kategorier" value="Alla Kategorier" id="button5">');



function initialize() {
                $(function foo2 () {
                $("#button1").click(foo("0"));
                });
                $(function () {
                $("#button2").click(foo("1"));
                });
                $(function () {
                $("#button3").click(foo("2"));
                });
                $(function () {
                $("#button4").click(foo("3"));
                });
                $(function () {
                $("#button5").click(foo("4"));
                });
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


            
            function foo(cat) {
            alert(cat);
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
                          
                        if (cat == messages[i].category){
                        
                        }
                        else {
                            marker.setMap(null);
                        
                        };

                          
                          google.maps.event.addListener(marker, 'click', (function(marker, i) {
                          return function() {
        var date = new Date(parseInt(messages[i].createddate.substr(6)));
         
        //var datum = date.replace ("GMT+0100 (W. Europe Standard Time)","");
          infowindow.setContent('<p>' +'Titel: ' + messages[i].title + '<br/ > Beskrivning: ' + messages[i].description + '<br/ > Katergori: ' + messages[i].category + '<br/ > Datum: ' + date + '</p>');
          infowindow.open(map, marker);
        }
      })(marker, i));
                      }
                      
                    
                  }
                  

              }); 

}


}; 
google.maps.event.addDomListener(window, 'load', initialize);





