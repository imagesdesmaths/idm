function deactivate_whizbang () {
  $.cookie('whizbang',null);
  $("#whizbang").show();
  $("#whizpanel").hide();

  $("#navleft > *").show();
}

function activate_whizbang () {
  $.cookie('whizbang',1)
  $("#whizbang").hide();
  $("#whizpanel").show();

  $("#navleft").accordion({header : 'h2', autoheight : false, animated : 'slide'});
}

function prepare_whizbang () {
  $(".whizbang").css({cursor:"pointer"});
  $("#whizbang").click(activate_whizbang);
  $("#whizoff").click(deactivate_whizbang);
}

$(document).ready(prepare_whizbang);

if ($.cookie('whizbang')) $(document).ready(activate_whizbang);
