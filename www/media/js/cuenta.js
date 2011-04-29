(function($) {
$(document).ready(function () {
	//mostrar o esconder las secciones de administracion
	//default a que esten siempre escondidos
	$('#dashboard>li>h4+section,#dashboard li>h6+section').hide();
	//usa el evento especificado en generales.js como a.alternar
});
}(jQuery));
