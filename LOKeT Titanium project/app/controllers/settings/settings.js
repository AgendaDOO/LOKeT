var args = arguments[0] || {};
var farm = args.farm || Alloy.Models.instance('farm');
var appData = args.appData || Alloy.Models.instance('appData');


/**
 * Event listener for "back button"
 */
$.settings.addEventListener("open", function(evt) {

    var actionBar = $.settings.activity.actionBar;

    actionBar.displayHomeAsUp = true;

    actionBar.onHomeIconItemSelected = function() {
        $.settings.close();
    };

    prefill();
});


function prefill(){

	var tempFarm = farm.toJSON();

	updateBasicsLabel(tempFarm.naziv, tempFarm.opis);
	updateLocationLabel(tempFarm.lokacija.naslov, tempFarm.lokacija.posta, tempFarm.lokacija.kraj);

	updateTypeLabel(tempFarm.tipkmetije);
	updateTypePLabel(tempFarm.tippridelave);
	updateTypeKLabel(tempFarm.tipkmetovanja);

	updateSizeLabel(tempFarm.velikostkmetije);
}

function updateBasicsLabel(naziv, opis){
	$.basics.text = naziv + ', ' + opis.substring(0, 20) + "...";
}

function updateLocationLabel(naslov, posta, kraj){
	$.location.text = naslov + ', ' + posta + ', '+ kraj;
}

function updateTypeLabel(type){
	$.type.text = appData.get("tipi_kmetije")[type];
}

function updateTypeKLabel(type){
	$.typeK.text = appData.get("tipi_kmetovanja")[type];
}

function updateTypePLabel(type){
	$.typeP.text = appData.get("tipi_pridelave")[type];
}

function updateSizeLabel(size){
	$.size.text = appData.get("velikosti_kmetije")[size];
}


/*
 * Return array with all properties
 */
function getDataArray(propertyKey){

	var data = appData.get(propertyKey);
	var farmData = [];
	_.each(data, function(value,index){
		farmData.push(value);
	});

	return farmData;
}

/*
 * Return object with all properties
 */
function getDataObject(propertyKey){

	var data = appData.get(propertyKey);
	var farmData = {};
	_.each(data, function(value,index){
		farmData[index] = value;
	});

	return farmData;
}

/*
 * Open general dialog
 */
function openBasicsDialog(){
	Alloy.Globals.openDialog(Alloy.Globals.lang.settings.editBasics,"settings/editTitleDescription",false,{farm:farm, callback:updateBasicsLabel});
}

/**
 *
 */
function openLocationDialog(){
	Alloy.Globals.openDialog(Alloy.Globals.lang.settings.editLocation,"settings/editLocation",undefined,{farm:farm, callback:updateLocationLabel});
}

/**
 * Open dialog for image upload
 */
function openImageULDialog(){
	Alloy.Globals.openDialog(Alloy.Globals.lang.settings.editImage,"settings/editPhoto",[Alloy.Globals.lang.buttons.back],{farm:farm, callback:updateBasicsLabel});
}

/**
 * Open dialog for open time config
 */
function openTimeDialog(){
	Alloy.Globals.openDialog(Alloy.Globals.lang.settings.openingHours, "settings/openingHours",undefined,farm);
}


/**
 *
 */
function setFarmType(){
	createOptionViewDialog("tipi_kmetije", returnParsedFarmSettingID("tipi_kmetije","tipkmetije"), Alloy.Globals.lang.settings.type, "tipkmetije", updateTypeLabel);
}

/**
 *
 */
function setFarmingType(){
	createOptionViewDialog("tipi_kmetovanja", returnParsedFarmSettingID("tipi_kmetovanja","tipkmetovanja"), Alloy.Globals.lang.settings.typeK, "tipkmetovanja", updateTypeKLabel);
}

/**
 *
 */
function setProductionType(){
	createOptionViewDialog("tipi_pridelave", returnParsedFarmSettingID("tipi_pridelave","tippridelave"), Alloy.Globals.lang.settings.typeP, "tippridelave", updateTypePLabel);
}

/**
 *
 */
function setSize(){
	createOptionViewDialog("velikosti_kmetije", returnParsedFarmSettingID("velikosti_kmetije","velikostkmetije"), Alloy.Globals.lang.settings.size, "velikostkmetije", updateSizeLabel);
}



/**
 *
 */
function createOptionViewDialog(farmPropertyKey, selectedDataIndex, dialogTitle, farmProperty, callback){

	var data = getDataArray(farmPropertyKey);

	var opts = {
		cancel: 2,
		options: data,
		selectedIndex: selectedDataIndex,
		destructive: 0,
		title: dialogTitle,
		buttonNames : [Alloy.Globals.lang.buttons.cancel]
	};

	var dialog = Ti.UI.createOptionDialog(opts);

	saveFarmData(dialog, farmProperty, farmPropertyKey, callback);

	dialog.show();
}

/**
 *
 * @param {Object} dialog = current dialog window
 * @param {Object} farmProperty = property to send over POST and save
 * @param {Object}
 * @param {function} the callback function to execute at the end
 */
function saveFarmData(dialog, selectedFarmProperty, farmPropertyKey, callback){

	dialog.addEventListener('click',function(e)
	{
		var propertyValue = e.source.options[e.index];

		var id = getSelectedOptionID(propertyValue, selectedFarmProperty, farmPropertyKey);

		var postObj = {};

		postObj[selectedFarmProperty] = id;

		farm.save(postObj);

		callback(id);
	});
}

/**
 * Option dialog returns title, get proper ID
 * @param {Object} selectedOption - title, string
 * @param {Object} attributeType - tipi_kmetije, tipi_kmetovanja, tipi_pridelave
 */

function getSelectedOptionID(selectedOption,selectedFarmProperty,farmPropertyKey){
	var options = getDataObject(farmPropertyKey);
	var selectedIndex = 0;
	_.each(options, function(attr,index){
		if(attr==selectedOption){
			selectedIndex = index;
			//return false;
		}
	});
	return selectedIndex;
}

/**
 *
 * @param {Object} farmPropertyKey
 * @param {Object} farmProperty
 */
function returnParsedFarmSettingID(farmPropertyKey,farmPropertyValue){
	var optionsObj = getDataObject(farmPropertyKey);
	var optionsArray = getDataArray(farmPropertyKey);
	var value = farm.get(farmPropertyValue);

	var farmPropertyValueTitle = optionsObj[value];

	_.each(optionsArray, function(attr,index){
		if(attr==farmPropertyValueTitle){
			selectedIndex = index;
			//alert(index);
		}
	});

	return selectedIndex;
}

$.settings.addEventListener("close", function(evt) {
	Ti.App.fireEvent('farmChanged');
});