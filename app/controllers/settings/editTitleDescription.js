var args = arguments[0] || {};
var customArguments = args.customArgument || {};

var farm = customArguments.farm;
var callback = customArguments.callback;

$.name.setValue(farm.get("naziv"));
$.description.setValue(farm.get("opis"));

function focusDescription(){
	$.description.focus();
}

function savePreferences(){

	var newNaziv = $.name.value;
	var newDescription = $.description.value;

	var farmData = {
		naziv:newNaziv,
		opis:newDescription
	};

	farm.save(farmData);

	callback(newNaziv,newDescription);
}
exports.savePreferences = savePreferences;
