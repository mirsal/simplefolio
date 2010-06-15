$(document).ready(function() {
    var slide = function() {
        var container = $('ol.slideshow');
        container.find('li:first').hide().remove().appendTo(container).fadeIn('slow');
        window.setTimeout(slide, 5000);
    }

    window.setTimeout(slide, 5000);
});
