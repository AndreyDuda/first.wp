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

    $('.reviews-box').owlCarousel({
        loop:true,
        margin: 30,
        responsiveClass: true,
        response: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    });

    $('.flat-app-btn').on('click', function(){
        var data = {
            action: 'flatapp',
            flat_id: $('input[name=id_flat]').val(),
            phone: $('input[name=phone]').val()
        };

        $.post(window.wp.ajax_url, data, function(res){
            if(res.success){
                /*alert('Ура');*/
            }
            else{
                /*alert(res.err);*/
            }
        }, 'json');
    });
});