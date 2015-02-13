
$("input#nombre-representante-filter").keypress(function(e) {
	$.post( 
		MyAjax.url, 
		{ action : 'buscar_representantes_por_nombre' , nombre : $(this).val() }, 
		function(response) {
      		//$('#posts_container').hide().html(response).fadeIn();
      		console.log(response);
    	}
    );
});