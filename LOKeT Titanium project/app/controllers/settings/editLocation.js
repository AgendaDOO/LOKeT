var args = arguments[0] || {};
var customArguments = args.customArgument || {};

var farm = customArguments.farm;
var callback = customArguments.callback;

var lokacija = farm.get("lokacija") || {};

if(typeof lokacija  == 'string'){
	try{
		lokacija = JSON.parse(lokacija);

		fillDefaults();
	}
	catch(exception){
		//alert("failed to parse the string back to JSON");
	}
}
else
	fillDefaults();

function fillDefaults(){
	$.street.setValue(lokacija.naslov);
	$.post.setValue(lokacija.posta);
	$.city.setValue(lokacija.kraj);
}

function savePreferences(){
	lokacija.naslov = $.street.value;
	lokacija.posta = $.post.value;
	lokacija.kraj = $.city.value;

	farm.save({lokacija:JSON.stringify(lokacija)});

	callback(lokacija.naslov, lokacija.posta, lokacija.kraj);
}

exports.savePreferences = savePreferences;
