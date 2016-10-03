$(document).ready(function()
{


$("#reader").change(function()
{
	
  var reader = $(this).val();
  
  if(reader != 0)
  {
  $.ajax
  ({
  url: 'DAO/plugbitrate/'+reader,
  success: function(data)
  {

reader2.setBitrate(data);
updateReadbitrate();

  } 
  
  });
  }
  else{

  reader2.setBitrate(0);
updateReadbitrate();
  }

});

$("#reader").change();
});
