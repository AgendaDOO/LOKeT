var args = arguments[0] || {};
var customArguments = args.customArgument || {};

var farm = customArguments.farm;
var callback = customArguments.callback;

var ImageCache = require('ImageCache');

var image;

var imageParams = {
	defaultImage:'/images/default_image.png',
	width:400,
	height:300,
	top:0,
	bottom:20,
	borderColor:"#333",
	borderWidth:"1sp"
};

if(!_.isUndefined(farm.get("slika"))){
	image = Ti.UI.createImageView(
		_.extend(imageParams, {
			image:Alloy.Globals.config.show.slika + farm.get("slika")
		})
	);
}
else{
	image = Ti.UI.createImageView(
		_.extend(imageParams, {
			image:'/images/default_image.png'
		})
	);
}

$.settingsEditPhoto.add(image);

function uploadImage(){

	Ti.Media.openPhotoGallery({

		mediaTypes:[Ti.Media.MEDIA_TYPE_PHOTO],

		success:function(event){
			$.imageButton.hide();
			$.progressbar.show();
			$.progressbar.message = "Nalagam sliko ...";

			if(event.mediaType == Ti.Media.MEDIA_TYPE_PHOTO)
				UploadPhotoToServer(event.media);
		}
   });
}

function UploadPhotoToServer(image){

    if (Ti.Network.online === true){

		var xhr = Ti.Network.createHTTPClient({
			timeout : 5000,  // in milliseconds

			// function called when the response data is available
			onload : function(e) {

				var response = JSON.parse(this.responseText);

				if(response.thumb)
					drawResponse(response.thumb);

				$.progressbar.hide();
			},
			// function called when an error occurs, including a timeout
			onerror : function(e) {
				alert('Prišlo je do napake!');

				$.settingsEditPhoto.hide();
				$.progressbar.hide();
			},
			onsendstream : function(e){
				$.progressbar.value = e.progress;
			}
		});

		try{
			xhr.setRequestHeader("ContentType", "image/jpeg");
			xhr.setRequestHeader('enctype', 'multipart/form-data');
			xhr.open('POST',Alloy.Globals.config.add.image);
			xhr.send({'tx_agloket_loket[image]':image});
		}catch(e){
			alert("Prišlo je do napake pri nalaganju slike!");
		}
    }
    else
		alert('Da lahko naložite sliko, potrebujete internetno povezavo!');
}

function drawResponse(imageUrl){

	$.settingsEditPhoto.removeAllChildren();

	var label = Ti.UI.createLabel({
		color: '#000',
		font: { fontSize:"18sp" },
		text: 'Vaša slika je shranjena!',
		textAlign: Ti.UI.TEXT_ALIGNMENT_CENTER,
		top: 20,
		bottom: 20,
		width: Ti.UI.SIZE, height: Ti.UI.SIZE
	});

	var image = Ti.UI.createImageView(
		_.extend(imageParams, {
			image:imageUrl
		})
	);

	$.settingsEditPhoto.add(label);
	$.settingsEditPhoto.add(image);
}

function savePreferences(){}
exports.savePreferences = savePreferences;