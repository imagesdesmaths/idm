function activate_whizbang () {
  $("#whizbang")
    .css({cursor:"pointer"})
    .click(function(){
      $("#navleft").accordion({
        header : 'h2',
        autoheight : false,
        animated : 'slide'
      });

    $("#navleft h2").css({cursor:"pointer"});

    $("#whizbang").slideUp("slow");
    $(".whizbang").slideDown("slow");

    });
}

$(document).ready(activate_whizbang);
