var args = arguments[0] || {};
var pridelki = args.pridelki || Alloy.Models.instance('pridelki');
var appData = args.appData || Alloy.Models.instance('appData');

//This var will look for a change so it knows if there is a need to update the webview or not!
var changed = false;

function doOpen(e){

	var activity = $.market.activity;
    var actionBar = activity.actionBar;

    if(actionBar){

		actionBar.displayHomeAsUp = true;

		actionBar.onHomeIconItemSelected = function(){
			e.source.close();
		};

		activity.onCreateOptionsMenu = function(e){

			var menu = e.menu;
			var addNewProduct = menu.add({
				itemId       : 1,
				title        : "Dodaj pridelke",
				showAsAction : Ti.Android.SHOW_AS_ACTION_ALWAYS
				//icon         : Ti.Android.R.drawable.ic_media_pause
			});

			addNewProduct.addEventListener("click", newPridelek);
		};

		activity.invalidateOptionsMenu();
    }

	if(pridelki.isInit()){
		populatePridelki(pridelki);
	}
	else{
		pridelki.on("initialize",function(){
			populatePridelki(pridelki);
		});
	}
}

// Create a custom template that displays an image on the left,
// then a title next to it with a subtitle below it.
var productTemplate = {
	properties: {
		height:"50sp"
	},
	childTemplates: [
        // {                            // Image justified left
        //     type: 'Ti.UI.ImageView', // Use an image view for the image
        //     bindId: 'pic',           // Maps to a custom pic property of the item data
        //     properties: {            // Sets the image view  properties
        //         width: '50dp', height: '50dp', left: 0
        //     }
        // },
        {                            // Title
            type: 'Ti.UI.Label',     // Use a label for the title
            bindId: 'naziv',          // Maps to a custom info property of the item data
            properties: {            // Sets the label properties
                // color: 'black',
                // font: { fontFamily:'Arial', fontSize: '20dp', fontWeight:'bold' },
                left: '10dp',
                height:"100%",
                width:"70%"
            },
			events:{
				click:editPridelek
			}
        },
        {
			type: 'Ti.UI.Switch',
			bindId:"zaloga",
			properties: {
				style:Ti.UI.Android.SWITCH_STYLE_CHECKBOX,
				title:"Zaloga",
				height:"100%",
				width:"40%"
			},
			events:{
				click:changeZaloga
			}
        }
    ]
};

var listView = Ti.UI.createListView({
	// Maps productTemplate dictionary to 'template' string
	templates: { 'template': productTemplate },
	// Use 'template', that is, the productTemplate dict created earlier
	// for all items as long as the template property is not defined for an item.
	defaultItemTemplate: 'template'
});

var productTypes, productCategoryNames, productCategories;

function populatePridelki(products){

	productCategories = {};

	productTypes = appData.get("vrste");

	productCategoryNames = appData.get("kategorije");

	products.each(function(product){
		addProductToListView(product);
	});

	listView.setSections(_.map(productCategories, function(cat){return cat;}));

	$.market.add(listView);
}

function editPridelek(event){

	var product = pridelki.get(event.itemId);

	if(product){

		if(!_.isUndefined(productTypes[product.get("vrstaprodukta")])){

			var productCategory = productTypes[product.get("vrstaprodukta")].kategorija;

			var params = {
				pridelek    :product,
				titleLabel  :{},
				itemIndex   :event.itemIndex,
				categoryId  :productCategory,
				units       :appData.get("enote"),
				deleteMethod:removePridelekFromList,
				updateMethod:editPridelekInList
			};
			
			
			var editProductWindow = Alloy.createController('market/editPridelek', {pridelek:product,titleLabel:{}, itemIndex: event.itemIndex, categoryId:productCategory, units:appData.get("enote"), deleteMethod:removePridelekFromList, updateMethod:editPridelekInList, appData:appData}).getView();
			editProductWindow.open();
			
		 	//Alloy.Globals.openDialog(Alloy.Globals.lang.market.editProduct+product.get("naziv"), 'market/editPridelek', false, params);  
		}
	}
}

function removePridelekFromList(itemIndex, categoryId){
	productCategories[categoryId].deleteItemsAt(itemIndex, 1);

	changed = true;
}

function editPridelekInList(itemIndex, categoryId, newValue){

	var itemAt = productCategories[categoryId].getItemAt(itemIndex);

	itemAt.naziv.text = newValue;

	productCategories[categoryId].updateItemAt(itemIndex, itemAt);

	changed = true;
}

function newPridelek(){
	Alloy.Globals.openDialog(Alloy.Globals.lang.market.addProducts, 'market/newPridelek', [], pridelki);

	changed = true;
}

function changeZaloga(event){
	var product = pridelki.get(event.itemId);
	product.save({naZalogi:event.source.value});

	changed = true;
}

pridelki.on("sync", function(product){

	addProductToListView(product, true);
	changed = true;
});

//Adds a product to the list view
function addProductToListView(product, updateListView){
	var productType = product.get("vrstaprodukta");

	//Security check if something went wrong!
	if(!_.isNull(productType)){
		productCategory = productTypes[productType].kategorija;

		//If current category is not yet listed as SECTION in the list view, then add the section to the array first!
		if( _.isUndefined(productCategories[productCategory]) )
			productCategories[productCategory] = Ti.UI.createListSection({headerTitle:productCategoryNames[productCategory]});

		productCategories[productCategory].appendItems([
			{
				naziv: { text: product.get("naziv") },
				zaloga:{
					value: product.get("naZalogi"),
					id:product.get("uid")
				},
				properties : {
					itemId:product.get("uid")
				}
			}
		]);

		if(updateListView)
			listView.setSections(_.map(productCategories, function(cat){return cat;}));
	}

}

$.market.addEventListener("close", function(evt) {
	if(changed)
		Ti.App.fireEvent('farmChanged');
});

$.market.open();