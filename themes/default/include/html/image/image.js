$(document).on('orViewLoaded orHeaderLoaded',function(event, data) {

	// Convert linked SVG to an inline SVG, because we want to style it...
	$(event.target).find('img.image-icon').svgToInline();
}); 