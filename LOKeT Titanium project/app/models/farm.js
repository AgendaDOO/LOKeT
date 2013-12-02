exports.definition = {
    config: {
        url_param:"tx_agloket_loket[kmetija]",
        url:{
			read:"http://loket.agenda.si/loket/kmetije/action/ajaxShowKmetija/controller/Pridelovalec/?type=99",
            create:"http://loket.agenda.si/loket/kmetije/action/ajaxAddKmetija/controller/Pridelovalec/?type=99",
			update:"http://loket.agenda.si/loket/kmetije/action/ajaxEditKmetija/controller/Pridelovalec/?type=99"
        },
        "adapter":{
			"type": "restapi",
            "collection_name": "farm",
			"idAttribute": "uid"
        },
        "parentNode": "kmetija"
    },
    extendModel: function(Model) {
        _.extend(Model.prototype, {

			errorMessages:{
                required:" ne sme biti prazen!"
            },

            validates: {
                required: ["naziv"]
            },

            _init:false,
			_initting:false,

            isInit:function(){
                if(this._init)
                    return true;
                return false;
            },

            customInitialize:function(){
                if(!this._init && !this._initting){

                    this._initting = true;

                    var self = this;

                    this.fetch({
                        success:function(){
                            self._init = true;
                            self._initting = false;
                            self.trigger("initialize");
                        },
                        error:function(){
                            self._init = false;
                            self._initting = false;
                        }
                    });
                }
            }
        });

        return Model;
    },
    extendCollection: function(Collection) {
        _.extend(Collection.prototype, {});
        return Collection;
    }
};