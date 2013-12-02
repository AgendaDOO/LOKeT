function doOpen() {

	//Add a title to the tabgroup. We could also add menu items here if needed
	var activity = $.index.activity;

	if (activity.actionBar) {
		activity.actionBar.title = Alloy.Globals.lang.appTitle;
		activity.actionBar.onHomeIconItemSelected = function(){
		var aboutWindow = Alloy.createController('about/about').getView();
		aboutWindow.open();
		};
	}

	activity.onCreateOptionsMenu = function(e) {

		var login_logout_handler = function(e) {
			Alloy.createController('login/main');
		};

		var loginButton = e.menu.add({
			itemId       : 2,
			order        : 6,
			title        : Alloy.Globals.lang.buttons.login,
			showAsAction : Ti.Android.SHOW_AS_ACTION_ALWAYS,
			icon         : "/images/user.png"
		});

		loginButton.addEventListener("click", login_logout_handler);

		var logoutButton = e.menu.add({
			itemId       : 1,
			order        : 5,
			title        : Alloy.Globals.lang.buttons.logout,
			showAsAction : Ti.Android.SHOW_AS_ACTION_ALWAYS,
			icon         : "/images/logoff.png"
		});

		logoutButton.addEventListener("click", login_logout_handler);

		Ti.App.addEventListener('userLogin', function(data){
			handleLogin(e.menu, true);
		});

		Ti.App.addEventListener('userLogout', function(data){
			handleLogin(e.menu, false);
		});

		// ////////////////////////////////////////////////////////////////////////
		// //Here is the GLOBAL progress indicator, which we will use to show stuff
		// ////////////////////////////////////////////////////////////////////////
		var progressIndicator = Ti.UI.Android.createProgressIndicator({
			message   : Alloy.Globals.lang.mLoadnig,
			location  : Ti.UI.Android.PROGRESS_INDICATOR_STATUS_BAR,
			type      : Ti.UI.Android.PROGRESS_INDICATOR_DETERMINANT,
			cancelable: true,
			min       : 0,
			max       : 10
		});

		Alloy.Globals.showLoader = function(){
			progressIndicator.show();
		};

		Alloy.Globals.hideLoader = function(){
			progressIndicator.hide();
		};
		////////////////////////////////////////////////////////////////////////

		handleLogin(e.menu, Ti.App.Properties.hasProperty("userData"));

		function handleLogin(menu, loggedIn){
			//LoginButton
			loginButton.setVisible(!loggedIn);
			//LogoutButton
			logoutButton.setVisible(loggedIn);

			//User button that shows the currently logged in user
			if(loggedIn){

				//Dont do this if menuItem3 already exists
				// if( !menu.findItem(3) ){

					// var userData = Ti.App.Properties.getObject("userData");

					// var usernameButton = menu.add({
					//	itemId       : 3,
					//	order        : 6,
					//	enabled      : false,
					//	title        : userData.username,
					//	showAsAction : Ti.Android.SHOW_AS_ACTION_ALWAYS
					// });
				// }
				
				//Remove the registration tab
				var removeTab = $.index.tabs[3];

				if(removeTab){
					//IT IS VITAL TO USE ARRAY SPLICE IN THEND!!! This will clear the array key!!!
					$.index.removeTab(removeTab);
					$.index.tabs.splice(3,1);
				}

				//Dont do this if the profile tab already exists
				if( !$.index.tabs[3] ){

					var profileTab = Titanium.UI.createTab({
						window:Alloy.createController('tabs/profile').getView(),
						title:Alloy.Globals.lang.tabs.profile
					});

					$.index.addTab(profileTab);
				}
			}
			else{
				//Remove menu item 3 (The username in the menu)
				// if( menu.findItem(3) )
				//	menu.removeItem(3);

				//Remove the profile tab but only if it exists!
				var removeTab = $.index.tabs[3];

				if(removeTab){
					//IT IS VITAL TO USE ARRAY SPLICE IN THEND!!! This will clear the array key!!!
					$.index.removeTab(removeTab);
					$.index.tabs.splice(3,1);
				}
				
				if( !$.index.tabs[3] ){

					var regTab = Titanium.UI.createTab({
						window:Alloy.createController('tabs/reg').getView(),
						title:Alloy.Globals.lang.tabs.reg
					});

					$.index.addTab(regTab);
				}
			}
		}
	};
}

$.index.addEventListener('android:back',function(){

	var currentTab = $.index.activeTab.index;

	if(currentTab == 1)
		$.products.goBack();
	else if(currentTab == 2)
		$.market.goBack();
	else if(currentTab == 3)
		$.reg.goBack();

	return false;
});

$.index.open();