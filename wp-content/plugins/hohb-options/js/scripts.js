jQuery(document).ready(function($){
    $('.my-color-field').wpColorPicker();
	
	$("#tabs").tabs();
	
	var tabCookieName = "mytabs";
		$("#tabs").tabs({
		active : ($.cookie(tabCookieName) || 0),
		activate : function( event, ui ) {
			var newIndex = ui.newTab.parent().children().index(ui.newTab);
			$.cookie(tabCookieName, newIndex, { expires: 1 });
		}
	});
	
	var submitButton = $('#submit');              // Variable to cache button element
	var progressBar = $('#progress');               // Variable to cache progress bar element
	var progressBarMeter = $('#progress .meter');   // Variable to cache meter element
	var alertBox = $('.alert-box');                 // Variable to cache meter element
	var closeButton = $('.close');                   // Variable to cache close button element
	 
	$(submitButton).click(function() { // Initiates the send interaction
    $(this).fadeOut(500); // Fades out submit button when it's clicked
    setTimeout(function() { // Delays the next effect
                 $(alertBox).fadeIn(500); // Fades in success alert
    }, 500);
});
});