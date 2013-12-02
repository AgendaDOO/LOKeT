var args = arguments[0] || {};
var dialog = args.dialog || false;
var pridelki = args.pridelki || Alloy.Models.instance('pridelki');

var pridelek = false;
var itemIndex = false;
var categoryId = false;
var titleLabel = false;
var units = false;
var deleteMethod = function(){};
var updateMethod = function(){};


$.name.softKeyboardOnFocus = Ti.UI.Android.SOFT_KEYBOARD_HIDE_ON_FOCUS;
        $.name.addEventListener('click',function(e)
        {
            $.name.setSoftKeyboardOnFocus(Ti.UI.Android.SOFT_KEYBOARD_SHOW_ON_FOCUS);
            $.name.focus();
        });



/*
if(args.customArgument){
	pridelek = args.customArgument.pridelek || false;
	itemIndex = args.customArgument.itemIndex || false;
	categoryId = args.customArgument.categoryId || false;
	titleLabel = args.customArgument.titleLabel || false;
	units = args.customArgument.units || false;
	deleteMethod = args.customArgument.deleteMethod || function(){};
	updateMethod = args.customArgument.updateMethod || function(){};
}*/

$.editProduct.addEventListener("open", function(evt) {
    var actionBar = $.editProduct.activity.actionBar;

    actionBar.displayHomeAsUp = true;

    actionBar.onHomeIconItemSelected = function() {
        $.editProduct.close();
    };
});

if(args){
	pridelek = args.pridelek || false;
	itemIndex = args.itemIndex || false;
	categoryId = args.categoryId || false;
	titleLabel = args.titleLabel || false;
	units = args.units || false;
	deleteMethod = args.deleteMethod || function(){};
	updateMethod = args.updateMethod || function(){};
}

var unitColumn = Ti.UI.createPickerColumn();
var rowCounter = 0;
var selectedRow = false;
var selectedEnota = pridelek.get("enotaprodukta");

_.each(units, function(value, index){
	var row = Ti.UI.createPickerRow({
		title: value,
		id:index
	});

	if(selectedEnota == index)
		selectedRow = rowCounter;

	unitColumn.addRow(row);

	rowCounter++;
});

$.unit.columns = [unitColumn];

if(pridelek){

	$.name.value = pridelek.get("naziv");
	$.price.value = pridelek.get("cena");
	$.description.value = pridelek.get("opis");
	$.production.value = pridelek.get("letniPridelek");

	$.unit.setSelectedRow(0,selectedRow);
}

function savePreferences(){

	var newNaziv = $.name.getValue();
	var	enotaprodukta =  $.unit.getSelectedRow(0);
	enotaprodukta = enotaprodukta.id;

	pridelek.save({
		naziv        :newNaziv,
		cena         :$.price.getValue(),
		enotaprodukta:enotaprodukta,
		opis         :$.description.getValue(),
		letniPridelek:$.production.getValue(),
	});

	updateMethod(itemIndex,categoryId,newNaziv);
	$.editProduct.close();
}

function deleteProduct(){
	pridelek.destroy();
	deleteMethod(itemIndex, categoryId);
	$.editProduct.close();
}

function updateBasicsLabel(naziv, opis){
	$.basics.text = naziv + ', ' + opis.substring(0, 20) + "...";
}

/**
 * Open dialog for image upload
 */
function openImageULDialogPridelek(){
	Alloy.Globals.openDialog("Uredi sliko pridelka","market/editProductPhoto",[Alloy.Globals.lang.buttons.back],{pridelekId:pridelek.get("uid"), pridelekSlika:pridelek.get("slike"), callback:updateBasicsLabel});
}

exports.savePreferences = savePreferences;