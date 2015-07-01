function initialize() {
  var map_canvas = document.getElementById('map_canvas');
  var map_options = {
    center: new google.maps.LatLng(29.282235,48.083757),
    zoom: 19,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(29.282235,48.083757),
      title:"Kuwait English School"
  });
  var map = new google.maps.Map(map_canvas, map_options)
  marker.setMap(map);
}
$(document).ready(function() {
  if($('#map_canvas').length>0) {
    google.maps.event.addDomListener(window, 'load', initialize);
  }
}); 
