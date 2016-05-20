jQuery(document).ready(function() {
    if($(".idm_readmore").length){
	$(".article-full").children(".details").prepend('<div class="idm_readmore_control" style="float:right"><a class="idm_readmore_classic" href="#readmore">Tout afficher</a><a class="idm_readmore_compact" href="#readmore">Tout réduire</a></div><br>');
	$(".idm_readmore_compact").hide();
	$(".idm_readmore_less").hide();
	$(".idm_readmore_text").css('height',80).css('overflow','hidden');

	jQuery('.idm_readmore_classic').click(function( ){
	    $(".idm_readmore_text").css('height','auto').css('overflow','visible');
	    $(".idm_readmore_more").hide();
	    $(".idm_readmore_less").hide();
	    $(".idm_readmore_classic").hide();
	    $(".idm_readmore_compact").show();
	});
	jQuery('.idm_readmore_compact').click(function( ){
	    $(".idm_readmore_text").css('height',80).css('overflow','hidden');
	    $(".idm_readmore_more").show();
	    $(".idm_readmore_classic").show();
	    $(".idm_readmore_compact").hide();
	});
	jQuery('.idm_readmore_more').click(function( ){
	    $(this).closest('.idm_readmore').children('.idm_readmore_text').css('height','auto').css('overflow','visible');
	    $(this).closest('.idm_readmore').children('.idm_readmore_more').hide();
	    $(this).closest('.idm_readmore').children('.idm_readmore_less').show();
	});
	jQuery('.idm_readmore_less').click(function( ){
	    $(this).closest('.idm_readmore').children('.idm_readmore_text').css('height',80).css('overflow','hidden');
	    $(this).closest('.idm_readmore').children('.idm_readmore_more').show();
	    $(this).closest('.idm_readmore').children('.idm_readmore_less').hide();
	    $(this).closest('.idm_readmore').children('.idm_readmore_more').show();
	    $(this).closest('.idm_readmore').children('.idm_readmore_text').focus()
	});
	
    }
});
