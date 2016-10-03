function CompareAndColor(first,second,firstdestination,seconddestination,color){

	if(+first != 0 && +second != 0){
		  firstdestination.css('color',color);
		  seconddestination.css('color',color);

		  if(+first <= +second)
		  {
		  seconddestination.css('color','#888');
		  return +first;

		  }

		  if(+second <= +first)
		  {
		 firstdestination.css('color','#888');
		  return +second;
		  }
	}else{
	  return 0;
	}
}


function updateStorebitrate(){


var result = CompareAndColor(interf.bitrate,volume2.writebitrate,$("#interfacebitrate"),$("#volumewritebitrate"),'#47afff');
store3.setBitrate(result);

var result = CompareAndColor(volume.readbitrate,interf.bitrate,$(),$(),null);
store3.setReadbitrate(result);


store3.updateBitrate();
project.updateStoretime();
project.updateTime();



}

function updateReadbitrate(){

var result = CompareAndColor(card2.readbitrate,reader2.bitrate,$("#cardreadbitrate"),$("#readerbitrate"),'#53b353');
read.setBitrate(result);


read.updateBitrate();
project.updateReadtime();
project.updateTime();

}
