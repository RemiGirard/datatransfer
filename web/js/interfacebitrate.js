$(document).ready(function()
{

$("#interface").change(function()
{

var theinterface = $(this).val();
  
  if(theinterface != 0)
  {
	$.ajax
	({
	url: 'DAO/plugbitrate/'+theinterface,
	success: function(data)
		{
		interf.setBitrate(+data);
		updateStorebitrate();
		}
	});
  }
  else{
interf.setBitrate(0);
// interfacebitrate = 0;

  }
});
});
