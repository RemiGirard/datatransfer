

// class Speedstep
var Speedstep = function(bitrate,display,display2,knob){
	this.name = name;
	this.display=display;
	this.display2=display2;
	this.writebitrate = 0;
	this.bitrate = bitrate;
	this.readbitrate = 0;
	this.knob = knob;

};

Speedstep.prototype.setBitrate = function(bitrate2){
	this.bitrate = bitrate2;
	$(this.display).html(this.bitrate + "&nbsp;" +"Mbit/s");
	$(this.display2).html(this.bitrate);
};

Speedstep.prototype.setWritebitrate = function(bitrate){
	this.writebitrate = bitrate;
};

Speedstep.prototype.setReadbitrate = function(bitrate){
	this.readbitrate = bitrate;
};

Speedstep.prototype.updateBitrate = function(){
	animknob(this.bitrate,this.knob);
}

var store3 = new Speedstep(0,null,"#storebitrate2",$("#knobstorebitrate"));
var read = new Speedstep(0,null,"#readbitrate2",$("#knobreadbitrate"));
var format = new Speedstep(0,"#formatbitrate","#formatbitrate2",$("#knobformatbitrate"));


//class Speedlimiter
var Speedlimiter = function(display,display2,displaysize){
	this.readbitrate =0;
	this.writebitrate=0;
	this.bitrate = 0;
	this.display=display;
	this.display2=display2;
	this.size=0;
	this.displaysize=displaysize;
};

Speedlimiter.prototype.setReadbitrate = function(bitrate){
	this.readbitrate = bitrate;
	$(this.display).html(bitrate + "&nbsp;" +"Mbit/s");
};

Speedlimiter.prototype.setWritebitrate = function(bitrate){
	this.writebitrate = bitrate;
	$(this.display2).html(bitrate + "&nbsp;" +"Mbit/s");
};

Speedlimiter.prototype.setBitrate = function(bitrate){
	this.bitrate = bitrate;
	$(this.display).html(bitrate + "&nbsp;" +"Mbit/s");
};

Speedlimiter.prototype.setSize = function(size){
	this.size = size;
	$(this.displaysize).html(size + "&nbsp;" +"GB");
};

var interf = new Speedlimiter("#interfacebitrate");
var reader2 = new Speedlimiter("#readerbitrate");
var volume2 = new Speedlimiter("#volumereadbitrate","#volumewritebitrate");
var card2 = new Speedlimiter("#cardreadbitrate","#cardreadbitrate","#cardsize");



// class control
var Control = function(){
	this.checksum = 0;
	this.checksource = 0;
}

Control.prototype.setChecksum = function(checksum){
	this.checksum = checksum;
	project.updateTime();
};

Control.prototype.setChecksource = function(checksource){
	this.checksource = checksource;
	project.updateTime();
};

var control = new Control();


// class Project
var Project = function(size){
	this.size = size;
	this.readtime = 0;
	this.storetime = 0;
	this.transfertime = 0;
	this.hours = 1;
	this.dailyhour = 1;
	this.dayproject = 1;
	this.sizedaily = size/this.dayproject;
};

Project.prototype.setDailyhour = function(dailyhour){
	this.dailyhour = dailyhour;
};

Project.prototype.setDayproject = function(dayproject){
	this.dayproject = dayproject;
};

Project.prototype.updateSize = function(){
	this.size = (format.bitrate / 8) * 3600 * this.dailyhour * this.dayproject;
	this.sizedaily = this.size/this.dayproject;
	$("#volumesizeday").html(format_megabytes(this.size));
	this.updateReadtime();
	this.updateStoretime();
	this.updateTime();
}

Project.prototype.updateReadtime = function(){
	if(read.bitrate){
	this.readtime = ((this.size*8)/3600)/read.bitrate;
	}
	else{
	this.readtime = 0;
	}
	project.updateTime();
}

Project.prototype.updateStoretime = function(){
	if(store3.bitrate){
	this.storetime = ((this.size*8)/3600)/store3.bitrate;
	}
	else{
	this.storetime = 0;
	}
	project.updateTime();
}

Project.prototype.updateTime = function (){
if(read.bitrate,store3.bitrate){
		var copy = Math.max(this.readtime,this.storetime);
		var readtime2 = this.readtime*(control.checksource);
		var storetime2 = this.storetime*(control.checksum);
		var verify = Math.max(readtime2,storetime2);
		this.transfertime = copy + verify;
}
else {	
	this.transfertime = 0;
}
this.transfertimedaily=this.transfertime/this.dayproject;
	 
	var temps = this.transfertime;
	transfertimeh.innerHTML = formatXX(Math.floor(+moment.duration(temps, 'hours').asHours()));
	transfertimem.innerHTML = formatXX(moment.duration(temps, 'hours').minutes());
	transfertimes.innerHTML = formatXX(moment.duration(temps, 'hours').seconds());
}

Project.prototype.updateHours = function(){
var temps = this.dailyhour * this.dayproject;
	hourprojecth.innerHTML = formatXX(Math.floor(+moment.duration(temps, 'hours').asHours()));
	hourprojectm.innerHTML = formatXX(moment.duration(temps, 'hours').minutes());
	this.updateSize();
}

var project = new Project(0);
var dailyproject = new Project(0);


$(document).ready(function () {

project.updateHours();

$(".dailyhourproject").change(function(){
	project.setDailyhour(($(this).val())/60);
	project.updateHours();
});
  
$(".dayproject").change(function(){
	project.setDayproject($(this).val());
	project.updateHours();
});


});



// Megabyte conversion
function format_megabytes($megabytes) {
	var GIGA = 1000;
	var TERA = GIGA * 1000;
    if ($megabytes < GIGA) {
        return (Math.round($megabytes) + "&nbsp;" + "MB");
    }
    if ($megabytes < TERA) {
        return ((Math.round(($megabytes / GIGA)*10)/10) + "&nbsp;" + "GB");
    }
    if ($megabytes < 100*TERA) {
        return ((Math.round(($megabytes / TERA)*100)/100) + "&nbsp;" + "TB");
    }
    else{
    return ((Math.round(($megabytes / TERA)*10)/10) + "&nbsp;" + "TB");
    }
}

//animate quickly knobs to the target value
function animknob(end,knob){
var start= knob.val();
$({value: +start}).animate({value: +end}, {
    duration: 500,
    easing:'swing',
    step: function() 
    {
        knob.val(this.value).trigger('change');
    },
    done: function()
     {
        knob.val(this.value).trigger('change');
    }
})
}

function formatXX(number) {
if(number < 10){
number = ("0" + number).slice(-2);
}
return number;
}



