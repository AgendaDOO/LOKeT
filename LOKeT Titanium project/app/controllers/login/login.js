var args = arguments[0] || {};
var dialog = args.dialog || false;

function focusPassword(){
	$.tPassword.focus();
}

function login(){
	var username = $.tUsername.getValue();
	var password = $.tPassword.getValue();

	Alloy.Globals.HttpClient.login(username, password);

	if(dialog)
		dialog.hide();
}

exports.savePreferences = login;