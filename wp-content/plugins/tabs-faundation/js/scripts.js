jQuery(document).ready(function($){
	$('#gotoPage').change(function() {
	   window.location=$(this).attr('value');
	});

	 $('.add').click(function(){
        $('.select-from option:selected').each( function() {
                $('.select-to').append("<option selected='selected' value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
    });
    $('.remove').click(function(){
        $('.select-to option:selected').each( function() {
            $('.select-from').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
            $(this).remove();
        });
    });
    $('.up').bind('click', function() {
        $('.select-to option:selected').each( function() {
            var newPos = $('.select-to option').index(this) - 1;
            if (newPos > -1) {
                $('.select-to option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
		
    });
    $('.down').bind('click', function() {
        var countOptions = $('.select-to option').size();
        $('.select-to option:selected').each( function() {
            var newPos = $('.select-to option').index(this) + 1;
            if (newPos < countOptions) {
                $('.select-to option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");
                $(this).remove();
            }
        });
    });

 	
	
});

jQuery(document).ajaxSuccess(function(e, xhr, settings) {
	var widget_id_base = 'tabs_widget';
	if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
		
	}
});



