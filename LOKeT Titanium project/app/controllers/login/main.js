var hasBeenLoggedIn = Ti.App.Properties.hasProperty("userData");

//Show login window
if( !hasBeenLoggedIn )
	Alloy.Globals.openDialog(Alloy.Globals.lang.wLogin, 'login/login', [Alloy.Globals.lang.bLogin,Alloy.Globals.lang.bClose]);
//Show logout window
else{

	var dialog = Titanium.UI.createOptionDialog({
		persistent:true,
		cancel: 1,
		buttonNames: [Alloy.Globals.lang.bLogout,Alloy.Globals.lang.bClose],
		message: Alloy.Globals.lang.mLogout,
		title: Alloy.Globals.lang.wLogout
	});

	dialog.addEventListener('click', function(e){
		if (e.index !== e.source.cancel)
			Alloy.Globals.HttpClient.logout();
	});

	dialog.show();
}