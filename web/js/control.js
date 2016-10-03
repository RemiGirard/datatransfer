$(document).ready(function()
{

var trigger = $("#software");
var search = trigger.val();
var dao = 'checksource';
var url = 'DAO/'+dao;
url = url + '/'+search;
var destination = $("#checksource");

trigger.change(function()
{

$.ajax
({
url: url,
method: "GET",

success: function(data)
{
if(data == 0)
{

destination.attr("checked", false);
destination.attr("disabled", true);
}
if(data == 1)
{
destination.attr("disabled", false);
} 

destination.trigger('change');
}

});



});


$("#software").trigger("change");


$("#checksource").change(function() {
	if(this.checked){
	control.setChecksource(1);
	}
	else{
	control.setChecksource(0);
	}

});

$("#control").change(function() {

	control.setChecksum($("#control").val());

});







});
