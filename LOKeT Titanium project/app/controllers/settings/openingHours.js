var args = arguments[0] || {};
var farm = args.customArgument || {};

var timetable = [
		{field:"friday_from", check:"fridayOpen"},
		{field:"friday_to", check:"fridayOpen"},
		{field:"saturday_from", check:"saturdayOpen"},
		{field:"saturday_to", check:"saturdayOpen"},
		{field:"sunday_from", check:"sundayOpen"},
		{field:"sunday_to", check:"sundayOpen"}
	];


var openingHours = farm.get("odpiralniCas") || {};

if(typeof openingHours  == 'string'){
	try{
		openingHours = JSON.parse(openingHours);

		fillTime();
	}
	catch(exception){
		//alert("failed to parse the string back to JSON");
	}
}
else
	fillTime();

function fillTime(){

	_.each(timetable, function(time){
		if(!_.isUndefined(openingHours[time.field])){

			var date = new Date(openingHours[time.field]*1000);

			$[time.field].setValue(date);
			$[time.check].setValue(true);
			$[time.check].fireEvent("change");
		}
		else{
			$[time.check].setValue(false);
			$[time.check].fireEvent("change");
		}
	});
}

function friday(){

	var currentPage = $.scrollableView.currentPage;

	if(currentPage !== 0)
		$.scrollableView.scrollToView(0);
}

function saturday(){

	var currentPage = $.scrollableView.currentPage;

	if(currentPage !== 1)
		$.scrollableView.scrollToView(1);
}

function sunday(){
	var currentPage = $.scrollableView.currentPage;

	if(currentPage !== 2)
		$.scrollableView.scrollToView(2);
}

function scrolled(){

	switch($.scrollableView.currentPage){
		case 0:
			$.bFriday.enabled = false;
			$.bSaturday.enabled = true;
			$.bSunday.enabled = true;
			break;
		case 1:
			$.bFriday.enabled = true;
			$.bSaturday.enabled = false;
			$.bSunday.enabled = true;
			break;
		case 2:
			$.bFriday.enabled = true;
			$.bSaturday.enabled = true;
			$.bSunday.enabled = false;
			break;
	}
}

function savePreferences(){

	var openingHours = {};

	_.each(timetable, function(time){

		if($[time.check].value){
			var currentValue = $[time.field].value;

			if ( Object.prototype.toString.call(currentValue) === "[object Date]" ) {
				// it is a date
				if ( !isNaN( currentValue.getTime() ) ) {  // d.valueOf() could also work
					// date is valid
					openingHours[time.field] = Math.round(currentValue.getTime()/1000);
				}
			}
		}
	});

	farm.save({odpiralniCas:JSON.stringify(openingHours)});
}

function toggleFriday(){

	if($.fridayOpen.value === true)
		$.fridayTime.setVisible(true);
	else
		$.fridayTime.setVisible(false);
}

function toggleSaturday(){

	if($.saturdayOpen.value === true)
		$.saturdayTime.setVisible(true);
	else
		$.saturdayTime.setVisible(false);
}

function toggleSunday(){

	if($.sundayOpen.value === true)
		$.sundayTime.setVisible(true);
	else
		$.sundayTime.setVisible(false);
}

exports.savePreferences = savePreferences;