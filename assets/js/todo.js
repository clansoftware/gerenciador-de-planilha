/** */
function add_more_list_email() {
	var html_modelo = "<div class='row'>"+$('#list_email').children().html()+"</div>";
	$('#list_email').append(html_modelo);
}

function add_more_list_sms() {
	var html_modelo = "<div class='row'>"+$('#list_sms').children().html()+"</div>";
	$('#list_sms').append(html_modelo);
}

function add_more_list_db() {
	var html_modelo = "<div class='row'>"+$('#list_db').html()+"</div>";
	$('#list_db').append(html_modelo);
}

function add_more_list_pag() {
	var html_modelo = "<div class='row'>"+$('#list_pag').children().html()+"</div>";
	$('#list_pag').append(html_modelo);
}

function add_more_list_user() {
	var html_modelo = "<div class='row'>"+$('#list_user').html()+"</div>";
	$('#list_user').append(html_modelo);
}

function remove_this(elem) {
	elem.parent().parent().parent().remove();
}