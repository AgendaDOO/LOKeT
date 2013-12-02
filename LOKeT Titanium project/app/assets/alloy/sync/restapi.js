var DEBUG = false;

function S4() {
	return ((1 + Math.random()) * 65536 | 0).toString(16).substring(1);
}

function guid() {
	return S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4() + S4() + S4();
}

function InitAdapter(config) {
	return {};
}

function apiCall(_options, _callback) {
	if (Ti.Network.online) {
		var xhr = Ti.Network.createHTTPClient({
			timeout : _options.timeout || 10000
		});

		//Prepare the request
		xhr.open(_options.type, _options.url);

		xhr.onload = function() {
			var responseJSON, success = true, error;

			try {
				responseJSON = JSON.parse(xhr.responseText);
			} catch (e) {
				Alloy.Globals.error('[REST API] apiCall ERROR: ' + e.message);
				success = false;
				error = e.message;
			}

			_callback({
				success : success,
				status : success ? (xhr.status == 200 ? "ok" : xhr.status) : 'error',
				code : xhr.status,
				data : error,
				responseText : xhr.responseText || null,
				responseJSON : responseJSON || null
			});
		};

		//Handle error
		xhr.onerror = function(e) {
			var responseJSON;

			try {
				responseJSON = JSON.parse(xhr.responseText);
			}
			catch(exception){

			}

			_callback({
				success : false,
				status : "error",
				code : xhr.status,
				data : e.error,
				responseText : xhr.responseText,
				responseJSON : responseJSON || null
			});
			Alloy.Globals.error('[REST API] apiCall ERROR: ' + xhr.responseText + '\n[REST API] apiCall ERROR CODE: ' + xhr.status);

			// alert("Povezava do interneta ne deluje!");
		};

		if (_options.beforeSend) {
			_options.beforeSend(xhr);
		}

		xhr.send(_options.data || null);
	} else {
		// Offline
		_callback({
			success : false,
			status : "offline",
			responseText : null
		});
	}
}

function Sync(method, model, opts) {

	model.idAttribute = model.config.adapter.idAttribute || "id";
	var parentNode = model.config.parentNode;

	// REST - CRUD
	var methodMap = {
		'create' : 'POST',
		'read'   : 'GET',
		'update' : 'POST',
		'delete' : 'POST'
	};

	var type = methodMap[method];
	var params = _.extend({}, opts);
	params.type = type;

	//set default headers
	params.headers = params.headers || {};

	// Send our own custom headers
	if (model.config.hasOwnProperty("headers")) {
		for (var header in model.config.headers) {
			params.headers[header] = model.config.headers[header];
		}
	}

	// We need to ensure that we have a url for the desired method.
	if (!model.config.url[method]) {
		Alloy.Globals.error("[REST API] ERROR: NO URL FOR METHOD "+method);
		return;
	}

	params.url = model.config.url[method];

	//json data transfers
	params.headers['Content-Type'] = 'application/json';

	logger( "REST METHOD", method);

	switch(method) {
		case 'read':
			if (model.get(model.idAttribute)) {
				params.url = params.url + '/' + model[model.idAttribute];
			}

			if (params.urlparams) {// build url with parameters
				params.url = encodeData(params.urlparams, params.url);
			}

			logger("read options", params);

			apiCall(params, function(_response) {

				if(_response.success){

						if (_response.responseJSON.success) {

						var data = parseJSON(_response, parentNode);
						var values = [];
						model.length = 0;
						for (var i in data) {
							var item = {};
							item = data[i];
							if (item[model.idAttribute] === undefined) {
								item[model.idAttribute] = guid();
							}
							values.push(item);
							model.length++;
						}
						params.success((model.length === 1) ? values[0] : values, _response.responseText);
						model.trigger("fetch");
					}
					else if(_response.responseJSON.error){
						params.error(_response.responseJSON, _response.responseText);

						alert(_response.responseJSON.error);
					}

				}
				else {
					params.error(_response.responseJSON, _response.responseText);

					Alloy.Globals.error('[REST API] READ ERROR: ',_response);
				}
			});
			break;

		case 'create' :

			params.data = prepareData(model);

			logger( "create options", params);

			apiCall(params, function(_response) {

				if (_response.success) {
					var data = parseJSON(_response, parentNode);

					//Rest API should return a new model id.
					if (_.isUndefined(data[model.idAttribute])){
						//if not - create one
						data[model.idAttribute] = guid();
					}
					params.success(data, JSON.stringify(data));
					// fire event
					model.trigger("fetch");
				} else {
					params.error(_response.responseJSON, _response.responseText);

					Alloy.Globals.error('[REST API] CREATE ERROR: ',_response);
				}
			});
			break;

		case 'update' :

			if (!model.get(model.idAttribute)) {
				params.error(null, "MISSING MODEL ID");
				Alloy.Globals.error("[REST API] ERROR: MISSING MODEL ID");
				return;
			}

			if (params.urlparams) {
				params.url = encodeData(params.urlparams, params.url);
			}


			params.data = prepareData(model);

			logger( "update options", params);

			apiCall(params, function(_response) {
				if (_response.success) {
					// var data = parseJSON(_response, parentNode);
					params.success(data, JSON.stringify(data));
					model.trigger("fetch");
				} else {
					params.error(_response.responseJSON, _response.responseText);

					Alloy.Globals.error('[REST API] UPDATE ERROR: ',_response);
				}
			});
			break;

		case 'delete' :
			if (!model.get(model.idAttribute)) {
				params.error(null, "MISSING MODEL ID");
				Alloy.Globals.error("[REST API] ERROR: MISSING MODEL ID");
				return;
			}

			params.data = prepareDataUid(model);

			logger( "delete options", params);

			apiCall(params, function(_response) {
				if (_response.success) {
					params.success(null, _response.responseText);
					model.trigger("fetch");
				} else {
					params.error(_response.responseJSON, _response.responseText);

					Alloy.Globals.error('[REST API] DELETE ERROR: ',_response);
				}
			});
			break;
	}
}

/////////////////////////////////////////////
// HELPERS
/////////////////////////////////////////////

function logger(message, data) {
	if(DEBUG)
		Alloy.Globals.error(message +': '+ JSON.stringify(data));
}

function parseJSON(_response, parentNode) {
	var data = _response.responseJSON;
	if (!_.isUndefined(parentNode)) {
		data = _.isFunction(parentNode) ? parentNode(data) : traverseProperties(data, parentNode);
	}
	logger( "server response", data);
	return data;
}

function traverseProperties(object, string) {
	var explodedString = string.split('.');
	for ( i = 0, l = explodedString.length; i < l; i++) {
		object = object[explodedString[i]];
	}
	return object;
}

function encodeData(obj, url) {
	var str = [];
	for (var p in obj) {
		str.push(Ti.Network.encodeURIComponent(p) + "=" + Ti.Network.encodeURIComponent(obj[p]));
	}

	if (_.indexOf(url, "?") == -1) {
		return url + "?" + str.join("&");
	} else {
		return url + "&" + str.join("&");
	}
}

///IMPORTANT!!! If url_parameter is supplied, then we assume that model is not a backbone model but a JSON object!!!
function prepareData(model){

	var newData = {};
	var param = model.config.url_param;

	_.each(model.toJSON(), function(value,index){

		if(!_.isObject(value))
			newData[param+'['+index+']'] = value;
	});

	return newData;
}

function prepareDataUid(model){
	var newData = {};
	var param = model.config.url_param;
	newData[param+'['+model.idAttribute+']'] = model.get(model.idAttribute);
	return newData;
}

//we need underscore
var _ = require("alloy/underscore")._;

//until this issue is fixed: https://jira.appcelerator.org/browse/TIMOB-11752
var Alloy = require("alloy"), Backbone = Alloy.Backbone;

module.exports.sync = Sync;

/////////////////////////////////////////////
// VALIDATOR
/////////////////////////////////////////////

//This function handles model validation. If there is error then an error object is returned. Otherwise nothing
//It incorporates different validator options
function Validate(model, changedAttributes) {

	var validators = {
        required: function(fields) {
            _.each(fields, function(field) {

                if(_.isEmpty(attributes[field]) === true){

                    if(!_.isNumber(attributes[field]) || attributes[field] === 0){

                         if (_.isUndefined(errors[field]))
                            errors[field] = [];

                        errors[field].push(model.errorMessages.required);
                    }
                }
            });
        }
    };

    var errors = {};
    var attributes = _.clone(model.attributes);

    _.extend(attributes, changedAttributes);

    _.each(model.validates, function(value, rule){
        validators[rule](value);
    });

    return errors;
}
//Applies the validation on the Model.
function modelValidate(changedAttributes) {

    this.errors = Validate(this, changedAttributes);

    if (!_.isEmpty(this.errors)){
        this.handleErrors();

        return this.errors;
    }
}
//In the event of an error tis function displays an error alert if validation fails
function handleErrors(){

    var totalErrorMessage = "";

    _.each(this.errors, function(error, errorId){
        _.each(error, function(errorMessage){
            totalErrorMessage = errorId+" "+errorMessage+"\n";
        });
    });

    if(!_.isEmpty(totalErrorMessage))
        alert(totalErrorMessage);
}

module.exports.beforeModelCreate = function(config, name) {
	config = config || {};
	InitAdapter(config);
	return config;
};

module.exports.afterModelCreate = function(Model, name) {
	Model = Model || {};
	Model.prototype.config.Model = Model;
	Model.prototype.idAttribute = Model.prototype.config.adapter.idAttribute;

	//Add validation methods right here
	Model.prototype.errors = {};
	Model.prototype.validate = modelValidate;
	Model.prototype.handleErrors = handleErrors;

	return Model;
};
