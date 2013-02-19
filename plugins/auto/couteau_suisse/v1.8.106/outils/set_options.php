<?php
function set_options_header_prive($flux) {
	return $flux. <<<JAVASCRIPT
<script type="text/javascript"><!--
// des que le DOM est pret...
if (window.jQuery) jQuery(document).ready(function(){
 if (jQuery('a.icone26').length) {
	jQuery("#displayfond").hide();
	jQuery("a.icone26[@href*=set_options]").hide();
 }
});
//--></script>
JAVASCRIPT;
}
?>