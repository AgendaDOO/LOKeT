if(Alloy.Globals.hasConnection)
	$.kmetijeList.url = Alloy.Globals.config.show.kmetije;
else
	$.kmetijeList.url = 'app://html/noInternet.html';

Ti.App.addEventListener("internetRestored",function(){
	$.kmetijeList.setUrl(Alloy.Globals.config.show.kmetije);
});

exports.goBack = function(){
	$.kmetijeList.goBack();
};