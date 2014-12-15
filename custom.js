$(function(){
	$('.form-group input').addClass('form-control');
	
	// Verplicht veld
	var vinkje = '<span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback" title="Verplicht veld" style="color: red"></i></span>';
	$('input').each(function(){
		if (!$(this).parent().is('div.input-group')) {
			$(this).filter('[required]').wrap('<div class="input-group">');
		}			
	});
	$('input[required]').after(vinkje);
	
	// Target blank
	$('a[href^="http://"], a[href^="https://"]').attr('target','_blank');
	
	// Debug info
	$('#debugInfo').before('<div class="pull-right"><button type="button" class="btn btn-primary btn-xs btn_sh">Verberg info</button></div>');
	$('#main').on('click', '.btn_sh', function(){
		if($('#debugInfo').is(':visible')) {
			$('#debugInfo').slideUp();
			$(this).text('Toon info');
		} else {
			$('#debugInfo').slideDown();
			$(this).text('Verberg info');
		}
	});													
})