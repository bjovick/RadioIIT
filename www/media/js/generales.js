(function($) {
$(document).ready(function () {
	//pregunta por confirmacion antes de seguir el link
	$('.asegurarse').live('click', function (e) {
		return window.confirm($(this).attr('rel') || 'Estas seguro?');
	});

	//alterna el ensenar o esconder la seccion que el link se refiere
	$('a.alternar').live('click', function () {
		$($(this).attr('href')).slideToggle('normal');
	});

	//agrega html del elemento que este en el href del elemento a
	//lo agrega en el DOM antes del link
	$('a.agregar_set').live('click', function () {
		var $este = $(this),
				clase = '.'+$este.attr('href').substr(1),
				$ultimo = $(clase).last(),
				valor_sel = $ultimo.is('select')
									? $('option:selected', $ultimo).val()
									: '';
				$nuevo_set = $ultimo.clone();

		$ultimo.after($nuevo_set);
		if(valor_sel != '') {
			$('option[value="'+valor_sel+'"]', $nuevo_set).attr('selected', true);
		}
	});

	//elimina el ultimo elemento en la lista de seleccionados
	//la regla de seleccion esta en el href
	//no borra si la lista de seleccionados es un solo elemento
	$('a.eliminar_set').live('click', function () {
		var $este = $(this),
				clase = '.'+$este.attr('href').substr(1),
				$sets = $(clase);

		if($sets.length > 1) { //a borrar el ultimo elemento
			$sets.last().remove();
		}
	});
});
}(jQuery));
