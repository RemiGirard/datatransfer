$(document).ready(function()
{
$("#knobformatbitrate").val(0);
$("#knobformatbitrate").trigger('change');
oldformatbitrate = 0;
format.setBitrate(0);
$("#framerate").change(function()
{

var camera = +$("#camera").val();
var media = +$("#media").val();
var codec = +$("#codec").val();
var resolution = +$("#resolution").val();
var framerate = +$("#framerate").val(); 

var old = $("#framerate").val();

if(camera != 0 && media != 0 && codec != 0 && resolution != 0  && framerate != 0){

$.ajax
({
url: 'DAO/formatbitrate/'+camera+'/'+media+'/'+codec+'/'+resolution,
method: "GET",

success: function(data)
{

  format.setBitrate(+data);
  format.updateBitrate(+data);
  project.updateSize();
 
}
});

}else{

  format.setBitrate(0);
  format.updateBitrate(0);
  project.updateSize();

 
}

});
});

