;(function($){
	$(document).ready(function(){
		$( qpprMetaData.appendTo ).append( qpprMetaData.injectMsg );
		var ctval 		= qpprMetaData.secs;
		var metaText 	= '';
		function timerFunc(){
			if($('#qppr_meta_counter').length >= 1){
				metaText = $('#qppr_meta_counter').data('meta-counter-text')
				if( typeof metaText == 'undefined' ) 
					metaText = 'Page will redirect in %1$ seconds' ;
				if( ctval < 1){
					clearTimeout(timerFunc);
				   	$('#qppr_meta_counter').text( metaText.replace( '%1$',ctval) );
					ctval--;
				}else if(ctval >= 1){
				   	$('#qppr_meta_counter').text( metaText.replace( '%1$',ctval) );
					ctval--;
				   	setTimeout(timerFunc, 1000);
				}
			}
		}
		$.timerFuncNew = function(){ timerFunc(); }
		var redirectTrigger = $( qpprMetaData.class ).length > 0 ? qpprMetaData.class : 'body';
		if( $(redirectTrigger ).length > 0 ){
			var tagtype = $( redirectTrigger ).prop('tagName').toLowerCase();
			if( tagtype == 'img' || tagtype == 'script' || tagtype == 'frame' || tagtype == 'iframe'){
				$( redirectTrigger ).load(function() {
					$.timerFuncNew();
					$('head').append('<meta http-equiv="refresh" content="'+qpprMetaData.secs+'; URL='+qpprMetaData.refreshURL+'" />');
				});
			}else{
				$( window ).load(function() {
					$.timerFuncNew();
					$('head').append('<meta http-equiv="refresh" content="'+qpprMetaData.secs+'; URL='+qpprMetaData.refreshURL+'" />');
				});
			}
		}
	});
})(jQuery);