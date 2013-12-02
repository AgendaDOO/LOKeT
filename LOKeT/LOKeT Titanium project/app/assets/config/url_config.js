var domainUrl = "http://loket.agenda.si/";
var urlType = "?type=99";

Alloy.Globals.config = {
    domain      : domainUrl,
    loginUrl    : domainUrl+"?eID=ag_login",
    userUrl     : domainUrl+"loket/kmetije/action/ajaxShowPridelovalec/controller/Pridelovalec/"+urlType,
    appData     : domainUrl+"kmetije/action/ajaxShowLastnostiKmetije/controller/Pridelovalec/"+urlType,

    show        :{

        pridelovalec    : domainUrl+"loket/kmetije/action/ajaxShowPridelovalec/controller/Pridelovalec/"+urlType,
        pridelki        : domainUrl+"loket/kmetije/action/ajaxShowPridelki/controller/Pridelovalec/"+urlType,
        moja_kmetija    : domainUrl+"loket/kmetije/action/showSingle/controller/Kmetija/kmetija/",
        products        : domainUrl+"loket/kmetije/action/list/controller/Produkt/",
        oAplikaciji     : domainUrl+"info",
		kmetije         : domainUrl+"index.php?id=30",
		reg		        : domainUrl+"index.php?id=20",
		slika			: domainUrl+"uploads/tx_agloket/"
    },

    edit        :{

		pridelovalec : domainUrl+"loket/kmetije/action/ajaxEditPridelovalec/controller/Pridelovalec/"+urlType,
		pridelek     : domainUrl+"loket/kmetije/action/ajaxEditPridelek/controller/Pridelovalec/"+urlType,
		kmetija      : domainUrl+"loket/kmetije/action/ajaxEditKmetija/controller/Pridelovalec/"+urlType
    },

    add        :{

		kmetija      : domainUrl+"loket/kmetije/action/ajaxAddKmetija/controller/Pridelovalec/"+urlType,
		pridelek     : domainUrl+"loket/kmetije/action/ajaxAddPridelek/controller/Pridelovalec/"+urlType,
		lokacija     : domainUrl+"loket/kmetije/action/ajaxAddLokacija/controller/Pridelovalec/"+urlType,
		image        : domainUrl+"loket/kmetije/action/ajaxAddImage/controller/Pridelovalec/"+urlType,
		productImage : domainUrl+"loket/kmetije/action/ajaxAddProductImage/controller/Pridelovalec/"+urlType
    },

    del 		:{
        pridelek: domainUrl+"loket/kmetije/action/ajaxAddKmetija/controller/Pridelovalec/"+urlType,
    }
};
