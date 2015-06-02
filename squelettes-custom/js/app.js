$(function(){

    /* Cookiesplease */
    cookiesplease.init({
        message: 'Notre site utilise des cookies. Certains cookies sont nécessaires au fonctionnement du site, tandis que d\'autres nous aident à améliorer l\'expérience utilisateur. En utilisant le site, vous acceptez l\'utilisation des cookies. Pour en apprendre plus au sujet des cookies et pour savoir comment les désactiver, <a href="/?page=cookies">consultez notre déclaration de confidentialité</a>.',
        buttonAcceptText: 'Fermer'
    });

    /* Menu */
    $(document).on('click', '.menu-mobile-toggle', function() {
        $('#menu').toggleClass('active');
    });
    $(document).on('click', '#menu li.expendable', function() {
        $('#menu li.expendable').not(this).removeClass('active');
        $(this).toggleClass('active');
    });

    /* Don't judge me... please. (_content.scss:53 alternative) */
    var to = null;
    function resizeContent() {
        if(to) clearTimeout(to);
        $('#content').delay(100).height('auto');
        $('#content').delay(100).height($('#content').closest('.container').height());
        to = setTimeout(resizeContent, 500);
    }
    if($('#content').length > 0) {
        resizeContent();
    }

    /* Homepage slides */
    $('#slides').slides({
        preload: true,
        preloadImage: '#CHEMIN{img/loading.gif}',
        generatePagination: false,
        play: 5000,
        pause: 0,
        hoverPause: true,
        start: 1
    });

    /* Homepage news */
    function sliderNewsUpdate(elements) {
        $(elements).toggleClass('active');
        var active = $('#slider-news li.active');
        $('#slider-news .disabled').removeClass('disabled');
        if(active.is(':first-child')) {
            $('#slider-news .previous').addClass('disabled');
        }
        if(active.is(':last-child')) {
            $('#slider-news .next').addClass('disabled');
        }
    }
    $('#slider-news').on('click', '.previous:not(.disabled)', function(event) {
        var toToggle = $('#slider-news li.active');
        toToggle = toToggle.add(toToggle.prev('li'));
        sliderNewsUpdate(toToggle);
    });
    $('#slider-news').on('click', '.next:not(.disabled)', function(event) {
        var toToggle = $('#slider-news li.active');
        toToggle = toToggle.add(toToggle.next('li'));
        sliderNewsUpdate(toToggle);
    });
    sliderNewsUpdate($('#slider-news li').first());

    /* Media elements */
    $('video,audio').mediaelementplayer({features: ['playpause', 'progress', 'current', 'duration' /*,'fullscreen'*/]});

});