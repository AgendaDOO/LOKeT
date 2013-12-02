if(Alloy.Globals.hasConnection)
	$.productsView.url = Alloy.Globals.config.show.products;
else
	$.productsView.url = 'app://html/noInternet.html';

Ti.App.addEventListener("internetRestored",function(){
	$.productsView.setUrl(Alloy.Globals.config.show.products);
});

exports.goBack = function(){
	$.productsView.goBack();
};