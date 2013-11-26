var pridelki = Alloy.Collections.instance('pridelki');
var farm = Alloy.Models.instance('farm');
var appData = Alloy.Models.instance('appdata');

if(!Alloy.Globals.hasConnection)
	$.myFarm.url = 'app://html/noInternet.html';

Ti.App.addEventListener("httpInit",function(){
	init();
});

$.profile.addEventListener('focus',function(){
	init();
});

//Init process: We use this so we init the relevant data only when the tab is focused, because otherwise it will make too
//many requests to TYPO3 and might crash both the app and the
var initted = false;

function init(){
	if(Alloy.Globals.hasConnection && !initted){
		restoreView();
		pridelki.customInitialize();
		farm.customInitialize();
		initted = true;
	}
}

function restoreView(){

	if(farm.isInit()){
		var url = Alloy.Globals.config.show.moja_kmetija + farm.get("uid");
		$.myFarm.setUrl(url);
	}
	else{
		setTimeout(restoreView, 2000);
	}
}

function editPreferences(){

	if(farm.isInit() && appData.isInit()){
		var settingsWindow = Alloy.createController('settings/settings', {farm:farm, appData:appData}).getView();
		settingsWindow.open();
	}
}

function editMarket(){

	if(pridelki.isInit() && appData.isInit()){
		var marketWindow = Alloy.createController('market/market', {pridelki:pridelki, appData:appData}).getView();
		marketWindow.open();
	}
}

Ti.App.addEventListener("farmChanged",function(){
	$.myFarm.reload();
});

