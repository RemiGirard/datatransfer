function makeknobstorebitrate(){
$("#knobstorebitrate").knob({
	'ticks':"150",
 	'tickColor':"black",
	'tickColorizeValues':false,
	'thickness':".25",
	'width': "100%",
    'min':0,
    'max':6000,
    'fgColor':"#47afff",
    'bgColor':"#1f5d72",
	'angleOffset':-150,
	'angleArc':300,
	'displayInput':false,
	'change' : function (value) {
		value = Math.round(value);
		store3.setBitrate(value);
		project.updateStoretime();
	}
});
};


function makeknobreadbitrate(){
 $("#knobreadbitrate").knob({
 	'ticks':"170",
 	'tickColor':"black",
 	'cursor':false,
	'thickness':".2",
	'width': "100%",
    'min':0,
    'max':6000,
    'angleOffset':-150,
	'angleArc':300,
    'fgColor':"#53b353",
    'bgColor':"#2b422b",
	'tickColorizeValues':true,
	'displayInput':false,
	'change' : function (value) {
		value = Math.round(value);
		read.setBitrate(value);
		project.updateReadtime();
		

	}
});
};


function makeknobformatbitrate() {
$("#knobformatbitrate").knob({
	'ticks':"190",
 	'tickColor':"black",
	'tickColorizeValues':true,
	'skin':"tron",
	'thickness':".1",
	'width': "100%",
    'min':0,
    'max':6000,
    'fgColor':"red",
	'bgColor':"#360c04",
	'angleOffset':-150,
	'angleArc':300,
	'displayInput':false,
	'change' : function (value) {
		value = Math.round(value);
		format.setBitrate(value);
		project.updateSize();

	},
});
};


$(document).ready(function()
{

makeknobreadbitrate();
makeknobstorebitrate();
makeknobformatbitrate();


});
// used in knobipod
  	var aknob;

$(document).ready(function()
{

  $(".custom").change(
  function(){

	var makeknob;
	var bgcolorknob;
	var athingtotrigger;

if($(this).hasClass('customrecord')){
aknob = "#knobformatbitrate";
makeknob = 'makeknobformatbitrate';
bgcolorknob = "#202020";
athingtotrigger = $("#camera").trigger('change');
} else if($(this).hasClass('customread')){
aknob = "#knobreadbitrate";
makeknob = 'makeknobreadbitrate';
bgcolorknob = "#202020";
athingtotrigger = "";
} else if($(this).hasClass('customstore')){
aknob = "#knobstorebitrate";
makeknob = 'makeknobstorebitrate';
bgcolorknob = "#202020";
athingtotrigger = "";
}

    if($(this).val() == 0){
   
    $(aknob).siblings("canvas").remove();
	$(aknob).unwrap().removeAttr("data-readOnly readonly").data("kontroled","").data("readonly",false);
    window[makeknob]();
    $(aknob).val(0);
    $(aknob).trigger('change');
	
    } else {
    
    $(aknob).siblings("canvas").remove();
    $(aknob).unwrap().attr("data-readOnly",true).data("kontroled","").data("readonly",true);
    window[makeknob]();
    
    $(aknob).trigger(
    'configure',
    {
        "bgColor":bgcolorknob
    }
	);
	
    athingtotrigger;
    $(aknob).trigger('change');
    }
    
	$.getJSON();
});

});
