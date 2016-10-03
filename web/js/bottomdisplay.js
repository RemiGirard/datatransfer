$(document).ready(function()
{

createiknob();

$(".title").click( function() {

var data = $(this).data("associate");
var action;

switch(data){
        case "record":
            data = $(".record");
    	//	color = "red";
          
            break;
        case "transfer":
            data = $(".transfer");
        //	color = "green";
           
            break;
        case "store":
            data = $(".store");
        //	color = "#47afff";
         
            break;
        case "time":
        	data = $(".timesmart");
    	//  color = "red";
            action = createiknob();
            break;
    }
   
   
   
	$(".record").addClass("hidden");
	$(".transfer").addClass("hidden");
	$(".store").addClass("hidden");
	$(".timesmart").addClass("hidden");

data.removeClass("hidden");

	$(".minuteknob").siblings("canvas").remove();
    $(".hourknob").siblings("canvas").remove();
    $(".minuteknob").unwrap().removeAttr("data-readOnly readonly").data("kontroled","").data("readonly",false);
    $(".hourknob").unwrap().removeAttr("data-readOnly readonly").data("kontroled","").data("readonly",false);
    
    

   
    
    window['createiknob']();
    $(".hourknob").trigger('change');
    $(".minuteknob").trigger('change');

//$(".titlebar").css('border-bottom-color', color);

});



});

function removeiknob(){
$(aknob).siblings(".dailyhourproject").remove();
$(aknob).siblings(".dayproject").remove();
}