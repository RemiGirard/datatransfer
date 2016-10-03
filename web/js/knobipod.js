// Create the ipod knob to define the time
// use in bottomdisplay.js

function createiknob(){
 // ipod	
 	
            var v, up=0,down=0,i=$(".dailyhourproject").val()
                ,$ival = $(".dailyhourproject")
                ,incr = function() { i=$(".dailyhourproject").val();i++; $ival.val(i); $(".dailyhourproject").trigger('change'); }
                ,decr = function() { i=$(".dailyhourproject").val();i--; $ival.val(i); $(".dailyhourproject").trigger('change'); };
            $(".minuteknob").knob(
                                {
                                min : 0
                                , max : 300
                                , stopper : false
                                , change : function () {
                                                if(v > this.cv){
                                                    if(up){
                                                    	if($ival.val() > 1){
                                                        decr();
                                                        }
                                                        up=0;
                                                    }else{up=1;down=0;}
                                                } else {
                                                    if(v < this.cv){
                                                        if(down){
                                                            incr();
                                                            down=0;
                                                        }else{down=1;up=0;}
                                                    }
                                                }
                                                v = this.cv;
                                            }
                                });
              
              
            var v, up=0,down=0,i=$(".dayproject").val()
                ,$ival1 = $(".dayproject")
                ,incr1 = function() { i=$(".dayproject").val();i++; $ival1.val(i); $(".dayproject").trigger('change'); }
                ,decr1 = function() { i=$(".dayproject").val();i--; $ival1.val(i); $(".dayproject").trigger('change'); };
            $(".hourknob").knob(
                                {
                                min : 0
                                , max : 20
                                , stopper : false
                                , change : function () {
                                                if(v > this.cv){
                                                    if(up){
                                                    	if($ival1.val() > 1){
                                                        decr1();
                                                        }
                                                        up=0;
                                                    }else{up=1;down=0;}
                                                } else {
                                                    if(v < this.cv){
                                                        if(down){
                                                            incr1();
                                                            down=0;
                                                        }else{down=1;up=0;}
                                                    }
                                                }
                                                v = this.cv;
                                            }
                                });
                                
}  




// $(document).ready(function()
// {
// 
// createiknob();
//             
// });
//  