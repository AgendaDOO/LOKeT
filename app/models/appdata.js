////////////////////////////////////////////////////////////////////////////////////////////
//APPDATA - Used to retrieve data like tipi_kmetije, tipi_kmetovanja
////////////////////////////////////////////////////////////////////////////////////////////
exports.definition = {
    config: {
        url:{
			read:"http://loket.agenda.si/loket/kmetije/action/ajaxShowLastnostiKmetije/controller/Pridelovalec/?type=99"
        },
        "adapter":{
			"type": "restapi",
            "collection_name": "appdata",
        },
        "parentNode": "appdata"
    },
    extendModel: function(Model) {
        _.extend(Model.prototype, {

            _init:false,
			_initting:false,

            isInit:function(){
                if(this._init)
                    return true;
                return false;
            },

            initialize:function(){

                var self = this;

                if(!self._init && !self._initting){

                    self._initting = true;

                    self.fetch({
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