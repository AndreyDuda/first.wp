$(function () {

    var $links = $('.scroll-menu a');

    $links.on('click', function(e) {
        e.preventDefault();

        var link = $(this);
        var $target = $(link.attr('href'));

        if ($target.length > 0) {
            $('html, body').animate({
                scrollTop: $target.offset().top - 70
            }, 700);
        }

    });
});