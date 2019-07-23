function show_hide_filed(e) {
	if( e.find(':selected').val()!='ses' ) {
		e.parent().parent().find('.mail').removeClass('d-none');
		e.parent().parent().find('.ses').addClass('d-none');
	} else { // AWS SES service email send
		e.parent().parent().find('.ses').removeClass('d-none');
		e.parent().parent().find('.mail').addClass('d-none');
	}
}

$(document).ready(function() {
	// var aws_regions_op = [
	// 	'oregon' => 'email-smtp.us-west-2.amazonaws.com',
	// 	'virginia' => 'email-smtp.us-east-1.amazonaws.com',
	// 	'irland' => 'email-smtp.eu-west-1.amazonaws.com'
	// 	];


});