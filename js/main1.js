(function($) {

    
  $('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
	$(":submit").removeAttr("disabled");
    $('#confirm_password').html('confirm_password').css('border', '1px solid #099904');	
  } else  {
    $('#confirm_password').html('confirm_password').css('border', '2px solid #ff0000');
	 $(":submit").attr("disabled", true);
  }
});

$( '#confirm_password' ).focusout(function() {
	 if ($('#password').val() == $('#confirm_password').val()) {
	 $('#confirm_password').html('confirm_password').css('border', '1px solid #ebebeb');
	 }
	});



})(jQuery);