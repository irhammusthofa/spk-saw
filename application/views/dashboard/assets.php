<?php 

$script = '<script>

        var map;
        var marker=[];
        
         
        function initMap() {
              var uluru = {lat: -3.004257, lng: 120.103221};
              map = new google.maps.Map(document.getElementById("world-map"), {
                zoom: 5,
                center: uluru
              });
              $.getJSON("'.base_url("user/dashboard/map").'", function(data) {
                  $.each(data, function(fieldName, fieldValue) {
                        var id = fieldValue.a_kode;
                        var nama = fieldValue.a_nama;
                        var kordinat = fieldValue.a_kordinat;
                        if (kordinat != null){
                          kordinat = kordinat.split(",",2);
                          console.log("lat:"+kordinat[0]+" lon:"+kordinat[1]);
                          marker.push(null)
                          marker[marker.length] = new google.maps.Marker({
                            position: {lat:parseFloat(kordinat[0]),lng:parseFloat(kordinat[1])},
                            map: map,
                          });
                          var infowindow = new google.maps.InfoWindow({
                              content: "<b style=\"color:black\">Kode : "+id+"</b><br><b style=\"color:black\">Area : "+nama+"</b>"
                            });
                        marker[marker.length-1].addListener("click", function() {
                              infowindow.open(map, marker[marker.length-1]);
                            });
                        }
                        
                  });
                });
                
              
            }
        </script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4NCxFCTb30FQIwLk9Sg-1FSqtf6mZb34&callback=initMap">
    </script>';
fs_add_assets_footer($script);