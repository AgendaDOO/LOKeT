var _ = require('alloy')._;

var _HttpClient = Ti.Network.createHTTPClient({

	// function called when the response data is available
	onload : function(e) {},

	// function called when an error occurs, including a timeout
	onerror : function(e) {

		Alloy.Globals.error(e.error);
	},
	timeout : 10000  // in milliseconds
});

//Inits the client with login credentials saved
function init(callback){
	login(Ti.App.Properties.getString("username"),Ti.App.Properties.getString("password"), callback);
}

function login(username, password, callback){

	_HttpClient.open("POST", Alloy.Globals.config.loginUrl);

	_HttpClient.onload = function(){

		try{
			response = JSON.parse(this.responseText);

			if(!response.success){
				alert(Alloy.Globals.lang.aFailedLogin);
			}
			else{

				Ti.App.Properties.setString("username", username);
				Ti.App.Properties.setString("password", password);
				Ti.App.Properties.setObject("userData",response.userData);

				Ti.App.fireEvent('userLogin');

				//If there is a callback pass it as an argument to the next function
				if(callback)
					callback();
			}
		}
		catch(err){
			Alloy.Globals.error(err);
		}
	};

	_HttpClient.send({
		username:username,
		password:password
	});
}

function logout(){

	//Clear cookies for domain
	_HttpClient.clearCookies(Alloy.Globals.config.domain);

	//Remove stored data
	Ti.App.Properties.removeProperty("userData");
	Ti.App.Properties.removeProperty("username");
	Ti.App.Properties.removeProperty("password");

	Ti.App.fireEvent('userLogout');
}

function setOnload(onLoadHandler){
	_HttpClient.onload = onLoadHandler;
}

function postData(url, data, successCallback, type){

	if(type != "GET")
		type = "POST";

	_HttpClient.onload = function(){

		Alloy.Globals.error(this.responseText);

		try{
			response = JSON.parse(this.responseText);

			if(response.error){
				alert(response.error);
			}
			else{

				if(successCallback)
					successCallback(response);
			}
		}
		catch(err){
			Alloy.Globals.error(err);
		}

		//Dismiss the loader
		Alloy.Globals.hideLoader();
	};

	_HttpClient.open(type, url);

	_HttpClient.send(data);

	Alloy.Globals.showLoader();
}

exports.init = init;
exports.login = login;
exports.logout = logout;
exports.postData = postData;
exports.setOnload = setOnload;
exports.setOnload = setOnload;
exports.HttpClientObject = _HttpClient;