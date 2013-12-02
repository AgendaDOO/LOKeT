$.about.addEventListener("open", function(evt) {
    var actionBar = $.about.activity.actionBar;

    actionBar.displayHomeAsUp = true;

    actionBar.onHomeIconItemSelected = function() {
        $.about.close();
    };
});



if(Alloy.Globals.hasConnection)
	$.aboutApp.url = Alloy.Globals.config.show.oAplikaciji;
else
	$.aboutApp.url = 'app://html/noInternet.html';

Ti.App.addEventListener("internetRestored",function(){
	$.aboutApp.setUrl(Alloy.Globals.config.show.oAplikaciji);
});

exports.goBack = function(){
	$.aboutApp.goBack();
};
