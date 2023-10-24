						
	$(document).ready(function() {
		$('.post').addClass("hidden-effect").viewportChecker({
			classToAdd: 'visible animated fadeIn', // Class to add to the elements when they are visible
			offset: 300    
		}); 
		$('.post1').addClass("hidden-effect").viewportChecker({
			classToAdd: 'visible animated fadeInRight', // Class to add to the elements when they are visible
			offset: 300    
		}); 
		$('.post2').addClass("hidden-effect").viewportChecker({
			classToAdd: 'visible animated fadeInLeft', // Class to add to the elements when they are visible
			offset: 300    
		}); 
		$('.post3').addClass("hidden-effect").viewportChecker({
			classToAdd: 'visible animated fadeInTop', // Class to add to the elements when they are visible
			offset: 300    
		}); 
		$('.post4').addClass("hidden-effect").viewportChecker({
			classToAdd: 'visible animated fadeInBottom', // Class to add to the elements when they are visible
			offset: 300    
		});   
	}); 
