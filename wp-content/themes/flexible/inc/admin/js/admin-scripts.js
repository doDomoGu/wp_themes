jQuery(document).ready(function($){
	"use strict";

	/*$('#customize-control-flexible_slider_label1').click(function(){
		$('#customize-control-flexible_slide_caption1').toggle();
	});
*/
	//js for hide/show metabox in related page
	$('#page_template').change(function() {
      $('#flexible_page_icon').toggle($(this).val() == 'templates/flexible-services.php');
   	}).change();

});