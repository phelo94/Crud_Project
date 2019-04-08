function loadMap(){
    
     map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 52.2461, lng: 7.1252},
          zoom: 8
        });
}