jQuery(document).ready(function($){
	$('#gotoPage').change(function()
	{
	   window.location=$(this).attr('value');
	});
});