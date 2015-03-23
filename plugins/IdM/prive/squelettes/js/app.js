$(function() {

    /* Override jQuery's :contains() selector */
    /**/
    // < 1.8
    jQuery.expr[':'].contains = function(a, i, m) {
      return jQuery(a).text().toUpperCase()
          .indexOf(m[3].toUpperCase()) >= 0;
    };
    /*/
    // >= 1.8
    $.expr[":"].contains = $.expr.createPseudo(function(arg) {
        return function( elem ) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });
    /**/


    /* Dashboard: open panels when clicking on title */
    $(document).on('click', '.closable .readmore', function() {
        if($(this).hasClass('close-all')) {
            $('.closable').removeClass('open');
        }
        var new_text = $(this).data('alt-text');
        $(this).closest('.closable').addClass('open');
        $(this).toggleClass('readmore readless').data('alt-text', $(this).html()).html(new_text);
    });
    $(document).on('click', '.closable .readless', function() {
        var new_text = $(this).data('alt-text');
        $(this).closest('.closable').removeClass('open');
        $(this).toggleClass('readmore readless').data('alt-text', $(this).html()).html(new_text);
    });

    /* Sort tables */
    $('table.sortable').tablesorter();

    /* Open/Close modals */
    $(document).on('click', '[data-modal-open]', function(event) {
        event.preventDefault();
        var modal = $(this).data('modal-open');
        $(modal).addClass('modal-open').append('<div class="mask"></div>');
    });
    $(document).on('click', '[data-modal-close], .modal-open.mask-clickable>.mask', function(event) {
        event.preventDefault();
        if($(this).is('.mask')) {
            var modal = $(this).parent();
        } else {
            var modal = $(this).data('modal-close');
        }
        $(modal).removeClass('modal-open').find('.mask').detach();
    });

    /* Submit form on button click */
    $(document).on('click', '.submit-form', function(event) {
        event.preventDefault();
        var form = $(this).closest('form');
        form.submit();
    });

    /* Empty form on button click */
    $(document).on('click', '.empty-form', function(event) {
        event.preventDefault();
        var form = $(this).closest('form');
        form.find('input[type="text"]').val('');
        form.find('input[type="checkbox"]').removeAttr('checked');
        form.find('option').removeAttr('selected');
        form.submit();
    });
    /* Prevent form submit on enter */
    $(document).on('keypress', 'form.no-auto-submit', function(event) {
        return event.keyCode != 13;
    });

    /* Make relecteur tooltip to follow mouse moves */
    $(document).on('mousemove', '.relecteur [data-filter="texte"]', function(e){
        $(this).find('.tooltip').css({
           left:  e.pageX - $(this).closest('.ajaxbloc').offset().left,
           top:   e.pageY - $(this).closest('.ajaxbloc').offset().top + 50
        });
    });

});