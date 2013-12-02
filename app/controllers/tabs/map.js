var lokacije = false;

function init(){

    lokacije = Alloy.Collections.instance('lokacije');

    //After all locations are gotten from internet, show them on the map!
    lokacije.on("init", function(){

        //For each element in collection works another way (Not with underscore)!!!
        this.each(function(lokacijaModel){

            var lokacija = lokacijaModel.toJSON();

            if(lokacija.latitude && lokacija.longitude){

                var kmetija = MapModule.createAnnotation({

                    //Custom argument that will be used to display new kmetija
                    kmetija_id:lokacija.uid,

                    //Annotation title and subtitle that appear on clicl
                    title:lokacija.name,
                    subtitle:lokacija.form_loc,

                    //Annotation position
                    latitude:lokacija.latitude,
                    longitude:lokacija.longitude,

                    //Annotation style
                    pincolor:Titanium.Map.ANNOTATION_RED,

                    // customView:rightButton,
                    //leftView:leftButton
                });

                mapview.addAnnotation(kmetija);
            }
        });
    });
}

var MapModule = require('ti.map');

var mapview = MapModule.createView({
    userLocation: true,
    mapType:MapModule.NORMAL_TYPE
});

mapview.addEventListener('click', function(e){
    if(e.annotation){
        if(e.clicksource == "subtitle" || e.clicksource == "infoWindow" || e.clicksource == "title"){

            var params = lokacije.get(e.annotation.kmetija_id);

            if(params){
                params = params.toJSON();

                Alloy.createController('maps/singleView', {farmData:params}).getView().open();
            }
        }
    }
});

$.map.add(mapview);

if(Alloy.Globals.httpInit){
    init();
}
else{
    Ti.App.addEventListener('httpInit', function(data){
        init();
    });
}

//Center the map on current location!
Ti.Geolocation.getCurrentPosition(function(e) {
    if (e.error) {
        return;
    }

    mapview.region = {
        latitude : e.coords.latitude,
        longitude : e.coords.longitude,
        latitudeDelta : 0.4,
        longitudeDelta : 0.4
    };
});
