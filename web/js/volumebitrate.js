$(document).ready(function()
{
$("#volume").change(function()
{

  var volume = $(this).val();


  if(volume != "0")
  {
$.ajax
({
url: 'DAO/volumewritebitrate/'+volume,
method: "GET",

success: function(data)
{
if(data){
  volume2.setWritebitrate(data);
  interf.setBitrate(data);
  }
else{
volume2.setWritebitrate(0);
}
updateStorebitrate();
}
});

$.ajax
({
url: 'DAO/volumereadbitrate/'+volume,
method: "GET",

success: function(data)
{
if(data){
  volume2.setReadbitrate(data);
  }
  else{
  volume2.setReadbitrate(0);
}
updateStorebitrate();
}
});
  }
  else{
  volume2.setWritebitrate(0);

  volume2.setReadbitrate(0);

updateStorebitrate();
  }



});
});
