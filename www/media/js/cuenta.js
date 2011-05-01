(function($) {
$(document).ready(function () {
	//mostrar o esconder las secciones de administracion
	//default a que esten siempre escondidos
	$('#dashboard>li>h4+section').hide();
	//ensenar el que este en la url
	if (window.location.hash != ""
		 && window.location.hash.match(/^\#[a-zA-Z0-9_-]+/)) {
		$(window.location.hash).show();
	}
	
	//usa el evento especificado en generales.js como a.alternar
});
}(jQuery));
