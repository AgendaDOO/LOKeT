////////////////////////////////////////////////////////////////////////////////////////////
//GLOBAL ERROR DISPLAY SETTINGS
////////////////////////////////////////////////////////////////////////////////////////////
//If displayErrors is true, then an error will be output
Alloy.Globals.displayErrors = false;
//If displayErrorsAlert is true then the error will be output in an alert!
Alloy.Globals.displayErrorsAlert = true;


////////////////////////////////////////////////////////////////////////////////////////////
//LANGUAGE
////////////////////////////////////////////////////////////////////////////////////////////
if (!Ti.App.Properties.getString('locale')) {
  Ti.App.Properties.setString('locale','si');
}

Ti.include('lang/'+Titanium.App.Properties.getString('locale')+'.js');

////////////////////////////////////////////////////////////////////////////////////////////
//CONFIG FILES - URL CONFIG, ICON CONFIG
////////////////////////////////////////////////////////////////////////////////////////////
Ti.include('config/url_config.js');
Ti.include('config/icon_config.js');

////////////////////////////////////////////////////////////////////////////////////////////
//FIRST WINDOW OPEN
////////////////////////////////////////////////////////////////////////////////////////////
Alloy.Globals.firstWindowOpen = "tabs/profile";


////////////////////////////////////////////////////////////////////////////////////////////
//Global HELPERS
////////////////////////////////////////////////////////////////////////////////////////////
Alloy.Globals.error = function(errorMessage, JSONobject){

	if(Alloy.Globals.displayErrors){

		var stringifiedJSON = "";

		if(!_.isUndefined(JSONobject)){
			try{
				stringifiedJSON = JSON.stringify(JSONobject);
			}
			catch(e){
				stringifiedJSON = "ERROR PARSING JSONobject "+e;
			}
		}

		if(Alloy.Globals.displayErrorsAlert)
			alert(errorMessage+stringifiedJSON);
		else
			Ti.API.info(errorMessage+stringifiedJSON);
	}
};

//Global function that handles window openings
Alloy.Globals.openSubWindow = function(e){
	if(e.source.controller){
		Alloy.createController(e.source.controller).getView().open();
	} else {
		alert('Err, No Controller Specified');
	}
};

//Empty init for common functions
Alloy.Globals.showLoader = function(){};
Alloy.Globals.hideLoader = function(){};

Alloy.Globals.openDialog = function(dialogTitle, controllerName, buttonNames, customArgument){

	var buttonNames_ = buttonNames || [Alloy.Globals.lang.buttons.save,Alloy.Globals.lang.buttons.cancel];

	var dialog = Titanium.UI.createOptionDialog({
		cancel:1,
		title:dialogTitle,
		buttonNames: buttonNames_
	});

	var dialogController = Alloy.createController(controllerName, {dialog:dialog, customArgument:customArgument});

	dialog.setAndroidView(dialogController.getView());

	eventHandlerFunction = function(e){

		//Check that the SAVE button was clicked
		if (e.index !== e.source.cancel)
			dialogController.savePreferences();
	};

	dialog.addEventListener('click', eventHandlerFunction);

	dialog.show();
};

////////////////////////////////////////////////////////////////////////////////////////////
//HTTP Client
////////////////////////////////////////////////////////////////////////////////////////////
//Init the global httpClient
Alloy.Globals.HttpClient = require('HttpClient');

//Set global string to check wether a user is logged in or not! , After the INIT, it will be set to true
Ti.App.Properties.setBool("isLogin",false);

//Secure check variable if the event is fired before a view is created
Alloy.Globals.httpInit = false;

//Fuction checks for internet connection and if there is one, it then performs a login if existing...
function checkForInternet(firstTime){

	if(Titanium.Network.networkType != Titanium.Network.NETWORK_NONE){

		//If username and password have been set and are ok then do the init!
		if(Ti.App.Properties.hasProperty("username") && Ti.App.Properties.hasProperty("password")){

			var afterInit = function(){
				//Instance Appdata right after login because we will need it if its done!
				Alloy.Models.instance('appdata');
				Ti.App.fireEvent('httpInit');
				Alloy.Globals.httpInit = true;
			};

			Alloy.Globals.HttpClient.init(afterInit);
		}
		else{

			Ti.App.fireEvent('httpInit');
			Alloy.Globals.httpInit = true;
		}

		// if(!firstTime)

		Alloy.Globals.hasConnection = true;
	}
	else{
		if(firstTime)
			alert(Alloy.Globals.lang.error.noInternet);

		setTimeout(function(){checkForInternet(false);}, 2000);
	}
}

Alloy.Globals.hasConnection = false;

checkForInternet(true);





