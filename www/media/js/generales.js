(function($) {
$(document).ready(function () {
	//pregunta por confirmacion antes de seguir el link
	$('a.asegurarse').click(function (e) {
		var res = confirm($(this).attr('rel') || 'Estas seguro?');
		if (res) {
			return true;
		} else {
			return false;
		}
	});

	//alterna el ensenar o esconder la seccion que el link se refiere
	$('a.alternar').live('click', function () {
		$($(this).attr('href')).slideToggle('normal');
	});
});
}(jQuery));
