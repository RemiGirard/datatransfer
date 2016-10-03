$(document).ready(function()
{

$("#card").change(function()
{
  var card = +$("#card").val();
  
  if(card != 0)
  {
  $.ajax
  ({
  url: 'DAO/cardwritebitrate/'+card,
  type: "GET",
  success: function(data)
  {
    card2.setReadbitrate(data);
    card2.setWritebitrate(data);
    updateReadbitrate();
  } 
  }); 
  
  
  
  $.ajax
  ({
  url: 'DAO/cardcapacity/'+card,
  type: "GET",
  success: function(data)
  {

  card2.setSize(data);
  } 
  });
  
  
  }
  else{

  card2.setReadbitrate(0);
    card2.setWritebitrate(0);
    updateReadbitrate();
    card2.setSize(0 );
  };
 



});

});
