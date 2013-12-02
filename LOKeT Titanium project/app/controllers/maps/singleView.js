var args = arguments[0] || {};
var farmData = args.farmData || {};

var url =  Alloy.Globals.config.show.moja_kmetija + farmData.uid;

/**
 * Event listener for "back button"
 */
$.singleView.addEventListener("open", function(evt) {

	var self = this;

    var actionBar = self.activity.actionBar;

    actionBar.displayHomeAsUp = true;

    actionBar.onHomeIconItemSelected = function() {
        self.close();
    };

    $.singleView.setTitle(farmData.name);
	$.kmetija.setUrl(url);
});

function openMaps(){

	var navIntent = Titanium.Android.createIntent({
		action: Titanium.Android.ACTION_VIEW,
		data:'geo:'+farmData.latitude+','+farmData.longitude+'+?q='+farmData.enc_loc
	});

	Ti.Android.currentActivity.startActivity(navIntent);
}