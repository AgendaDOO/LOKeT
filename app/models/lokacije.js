exports.definition = {
    config: {
        url_param:"tx_agloket_loket[lokacija]",
        url:{
			read:"http://loket.agenda.si/loket/kmetije/action/ajaxShowLokacije/controller/Kmetija/?type=99"
        },
        "adapter":{
			"type": "restapi",
			"collection_name": "lokacije",
			"idAttribute": "uid"
        },
        "parentNode": "lokacije" //your root node
    },
    extendModel: function(Model) {
        _.extend(Model.prototype, {});

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

            initialize:function(){

                var self = this;

                if(!self._init && !self._initting){

                    self._initting = true;

                    self.fetch({
                        success:function(collection, response, options){
                            self._init = true;
                            self._initting = false;
                            self.trigger("init");
                        },
                        error:function(){
                            self._init = false;
                            self._initting = false;
                            //If there was an error of any kind, then retry after some time
                            // setTimeout(function(){
                            //     self.initialize();
                            // }, 3000);
                        }
                    });
                }
            }
        });
        return Collection;
    }
};