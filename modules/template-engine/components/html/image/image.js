$(document).on('orViewLoaded orHeaderLoaded',function(event, data) {

	// Convert linked SVG to an inline SVG, because we want to style it...

    // Elements to inject
    var mySVGsToInject = document.querySelectorAll('img.image-icon');

    // Do the injection
    SVGInjector(mySVGsToInject);
}); 