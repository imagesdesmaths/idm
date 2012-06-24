/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/*!
 * jquery.qtip. The jQuery tooltip plugin
 *
 * Copyright (c) 2009 Craig Thompson
 * http://craigsworks.com
 *
 * Licensed under MIT
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Launch  : February 2009
 * Version : 1.0.0-rc3
 * Released: Tuesday 12th May, 2009 - 00:00
 * Debug: jquery.qtip.debug.js
 */
(function($)
{
	jQuery.fn.qtip_activate = function() {
	  return this.each(function() {
			var c=jQuery(this).attr('class');
			var ptarget = 'rightTop';
			var ptooltip = 'leftTop';
			var reg=new RegExp('target_[^\\s]+',"");
			var f=c.match(reg);
			if (f) { ptarget = f[0].substr(7);}
			reg=new RegExp('tooltip_[^\\s]+',"");
			f=c.match(reg);
			if (f) { ptooltip = f[0].substr(8);}

			var content = jQuery(this).siblings('.qTipContent');
			if (content.length)
				jQuery(this).qtip({
					content: {
						text: content
					},
					hide: {
						fixed: true
					},
					style: {
						tip: true,
						name: 'light' // Inherit from preset style
						/*width: { max:220}*/
					},
					position: {
					 corner: {target: ptarget, tooltip: ptooltip}
					}
				});
			jQuery(this).addClass('qTipDone');
		});
	}

	jQuery(function() {
		jQuery('.qTip').qtip_activate();
	});

	// ... et a chaque fois que le DOM change
	onAjaxLoad(function() {
		if (jQuery){
			jQuery('.qTip',this).qtip_activate();
		}
	});

})(jQuery);
