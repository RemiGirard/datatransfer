var manufacturer = $("#manufacturer");
var camera = $("#camera");
var media = $("#media");
var codec = $("#codec");
var resolution = $("#resolution");
var framerate = $("#framerate");
var sampling = $("#sampling");
var card = $("#card");
var software = $("#software");
var control2 = $("#control");


$(document).ready(function()
{
UpdateSelect(manufacturer,camera,'cameras',[manufacturer],SetSelect);
UpdateSelect(camera,media,'medias',[camera],SetSelect);
UpdateSelect(media,codec,'codecs',[camera,media],SetSelect);
UpdateSelect(codec,resolution,'resolutions',[camera,media,codec],SetSelect);
UpdateSelect(resolution,framerate,'framerates',[camera,media,codec,resolution],SetSelect);
UpdateSelect(framerate,sampling,'sampling',[camera,media,codec,resolution],SetSelect);
UpdateSelect(media,card,'cards',[media],SetSelect);
UpdateSelect(software,control2,'control',[software],SetSelect);

});

function UpdateSelect(trigger,destination,dao,search,SetData){
var data;
trigger.change(function()
{
var valid = 1;
url = 'DAO/'+dao;
for(var i= 0; i < search.length; i++){		
	element=search[i].val();
	if(!element){valid=0}
	url = url + '/'+element;
}

var old = destination.val();
var id = $(this).val();
if(id && id != 0 && valid){

$.ajax({
url: url, 
method: "GET",
success :

function(data){
	SetData(data,destination,old);
}
   
})

// .fail(function(req, textStatus, errorThrown) {
// 	alert('Ooops, something happened: ' + textStatus + ' and ' + errorThrown + ' and2 ' + req.status + ' and3 ' + req.responseText);
// });	

}else{
destination.html("");
destination.trigger('change');
}


});

return data;

}
// end Update select

//start setselect
function SetSelect(data,destination,old){
		destination.html(data);
		if (+old != "0"){
		destination.val(old);
		}
		
		destination.trigger('change');
}



