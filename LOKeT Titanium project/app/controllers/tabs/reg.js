if(Alloy.Globals.hasConnection)
	$.regView.url = Alloy.Globals.config.show.reg;
else
	$.regView.url = 'app://html/noInternet.html';

Ti.App.addEventListener("internetRestored",function(){
	$.regView.setUrl(Alloy.Globals.config.show.reg);
});

exports.goBack = function(){
	$.regView.goBack();
};