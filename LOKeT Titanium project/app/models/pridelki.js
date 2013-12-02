exports.definition = {
    config: {
        url_param:"tx_agloket_loket[pridelek]",
        url:{
			read:"http://loket.agenda.si/loket/kmetije/action/ajaxShowPridelki/controller/Pridelovalec/?type=99",
            create:"http://loket.agenda.si/loket/kmetije/action/ajaxAddPridelek/controller/Pridelovalec/?type=99",
			update:"http://loket.agenda.si/loket/kmetije/action/ajaxEditPridelek/controller/Pridelovalec/?type=99",
			"delete":"http://loket.agenda.si/loket/kmetije/action/ajaxDeletePridelek/controller/Pridelovalec/?type=99"
        },
        //"debug": 1,
        "adapter":{
			"type": "restapi",
            "collection_name": "pridelki",
			"idAttribute": "uid"
        },
        "parentNode": "pridelki" //your root node
    },
    extendModel: function(Model) {
        _.extend(Model.prototype, {

            errorMessages:{
                required:" ne sme biti prazen!"
            },

            validates: {
                required: ["naziv", "vrstaprodukta"]
            }
        });

        return Model;
    },
    extendCollection: function(Collection) {
        _.extend(Collection.prototype, {

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
        return Collection;
    }
};