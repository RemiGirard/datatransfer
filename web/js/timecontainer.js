

$(document).ready(function()
{

// Fonction exécutée au redimensionnement
function redimensionnement() {

  var result = document.getElementById('result');
  if("matchMedia" in window) { // Détection
    if(window.matchMedia("(min-width:991px)").matches) {
    
    	$('.timesmartdailyhourproject').val(project.dailyhour*60);
		$('.timelargedailyhourproject').val(project.dailyhour*60);
		$('.timelargedayproject').val(project.dayproject);
		$('.timesmartdayproject').val(project.dayproject);
    
		$('.timelargedailyhourproject').addClass("dailyhourproject");
		$('.timelargeminuteknob').addClass("minuteknob");
		$('.timelargedayproject').addClass("dayproject");
		$('.timelargehourknob').addClass("hourknob");
		
		$('.timesmart').hide();
		
		
		$('.timesmartdailyhourproject').removeClass("dailyhourproject");
		$('.timesmartminuteknob').removeClass("minuteknob");
		$('.timesmartdayproject').removeClass("dayproject");
		$('.timesmarthourknob').removeClass("hourknob");
		
		
    } else {
    
    	$('.timesmartdailyhourproject').val(project.dailyhour*60);
		$('.timelargedailyhourproject').val(project.dailyhour*60);
		$('.timelargedayproject').val(project.dayproject);
		$('.timesmartdayproject').val(project.dayproject);
    
    	$('.timesmartdailyhourproject').addClass("dailyhourproject");
		$('.timesmartminuteknob').addClass("minuteknob");
		$('.timesmartdayproject').addClass("dayproject");
		$('.timesmarthourknob').addClass("hourknob");
		
		
		
		$('.timelargedailyhourproject').removeClass("dailyhourproject");
		$('.timelargeminuteknob').removeClass("minuteknob");
		$('.timelargedayproject').removeClass("dayproject");
		$('.timelargehourknob').removeClass("hourknob");
    
  
		
		
    }
  }
}

// redimensionnement();

// On lie l'événement resize à la fonction
// window.addEventListener('resize', redimensionnement, false);

});
