var args = arguments[0] || {};
var dialog = args.dialog || false;
var pridelki = args.customArgument || {};

var appData = Alloy.Models.instance('appdata');
var selectedSezona = -1;
var selectedKategorija = -1;
var selectedKategorijaView = false;
var selectedProducts = [];

function get2ColumnData(theArray, callback, color_1, color_2, subselect, addCheckBox){

	var kat_row, c_data, c_iterator, c_color_1;

	c_data = [];
	c_iterator = 0;
	c_color = 0;
	c_color_1 = false;

	_.each(theArray,function(value, index){

		var viewOptions = {
			top:0,
			layout:"horizontal",
			left:"50%",
			height: Ti.UI.Size,
			width:"50%"
		};

		if(c_color === 0 || c_color_1){
			viewOptions.defaultColor = color_1;
			viewOptions.backgroundColor = color_1;
		}
		else{
			viewOptions.defaultColor = color_2;
			viewOptions.backgroundColor = color_2;
		}

		if(c_color >= 2){
			c_color = 1; //If second time, change color!
			c_color_1 = !c_color_1;
		}
		else
			c_color++;

		if(c_iterator%2 === 0 || _.isUndefined(kat_row) ){

			viewOptions.left = 0;

			kat_row = Ti.UI.createTableViewRow();

			c_data.push(kat_row);
		}

		var kat_view = Ti.UI.createView(viewOptions);

		var kat_label = Ti.UI.createLabel({
			top:15,
			bottom:15,
			left:15,
			right:15,
			text:( !_.isUndefined(subselect) ) ? value[subselect] : (value)
		});

		if(addCheckBox){

			var kat_view_1 = Ti.UI.createView({width:"80%"});
			var kat_view_2 = Ti.UI.createView({width:"20%"});

			kat_view_1.add(kat_label);

			var kat_checkbox = Ti.UI.createSwitch({
				style: Ti.UI.Android.SWITCH_STYLE_CHECKBOX,
				width:Ti.UI.SIZE,
				height:Ti.UI.SIZE,
				top:0,
				value:false
			});
			kat_view_2.add(kat_checkbox);

			kat_checkbox.addEventListener('click',function(e){
				callback(value, kat_view, this);
			});

			kat_view.add(kat_view_1);
			kat_view.add(kat_view_2);
		}
		else{
			kat_view.addEventListener('click',function(e){
				callback(index, this);
			});
			kat_view.add(kat_label);
		}

		kat_row.add(kat_view);

		c_iterator++;
	});

	return c_data;
}

function getKategorijeData(){

	var kategorije = appData.get("kategorije");
	var color_1 = "#BDECB6";
	var color_2 = "#BDECD6";

	return get2ColumnData(kategorije, selectKategorija, color_1, color_2);
}

$.kategorijeList.setData( getKategorijeData() );


function setSelectedButton(selectedIndex){
	_.each({1:"winter",2:"spring",3:"summer",4:"autumn","-1":"all"}, function(value, index){
		if(selectedIndex == index)
			$[value].enabled = false;
		else
			$[value].enabled = true;
	});
}

function selectSezona(e){

	setSelectedButton(e.source.index);

	$.scrollableView.scrollToView(1);
}

function selectKategorija(newKategorija, viewObject){

	if(selectedKategorijaView)
		selectedKategorijaView.setBackgroundColor(selectedKategorijaView.defaultColor);

	viewObject.setBackgroundColor("#57A639");
	selectedKategorija = newKategorija;
	selectedKategorijaView = viewObject;

	var vrste = [];
	_.each(appData.get("vrste"), function(vrsta,index){

		if(vrsta.kategorija == newKategorija)
			if(selectedSezona == -1 || _.contains(vrsta.sezone, selectedSezona))
				vrste.push({id:index, name:vrsta.name});

		return false;
	});

	$.vrsteList.setData( get2ColumnData(vrste, selectVrsta, "#BDECB6", "#BDECD6", "name", true) );

	$.scrollableView.scrollToView(2);
}

function selectVrsta(selectedVrsta, selectedView, selectedCheckbox){

	if(selectedCheckbox.value === true){

		selectedView.setBackgroundColor("#57A639");
		selectedProducts.push(selectedVrsta);
	}
	else{
		selectedView.setBackgroundColor(selectedView.defaultColor);

		var index = selectedProducts.indexOf(selectedVrsta);

		if (index > -1)
			selectedProducts.splice(index, 1);
	}

	if(selectedProducts.length>0)
		$.bSave.enabled = true;
	else
		$.bSave.enabled = false;
}

function goBack(){
	var currentPage = $.scrollableView.currentPage-1;

	if(currentPage >= 0)
		$.scrollableView.scrollToView(currentPage);
}

function scrolled(){
	if($.scrollableView.currentPage > 0)
		$.bBack.enabled = true;
	else
		$.bBack.enabled = false;
}

function cancel(){
	dialog.hide();
}


function savePreferences(){

	_.each(selectedProducts, function(izdelek){
		pridelki.create({naziv:izdelek.name, vrstaprodukta:izdelek.id, naZalogi:true});
	});

	cancel();
}

exports.savePreferences = savePreferences;