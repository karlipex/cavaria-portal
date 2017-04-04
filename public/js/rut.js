function ruty(){
$(document).ready(function(){
	$('#check').hide();
	 $('#rut').Rut({
	  on_error: function(){$('#check').show();$('#ingr').removeClass('avail')},
         on_success: function(){$('#check').hide();$('#ingr').addClass('avail')},
	  format_on: 'keyup'
	});
});	

$(document).ready(function(){
	$('#check').hide();
	 $('#r_rut').Rut({
	  on_error: function(){$('#check').show();},
         on_success: function(){$('#check').hide();},
	  format_on: 'keyup'
	});

});	
}