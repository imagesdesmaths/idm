/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


;(function ($) {

	$.modalbox = function (data, options) {
		if ($.isFunction(options.onClose)){
			var onClosefunc = options.onClose;
			options.onClose = function(dialog){
				$.modal.close();
				onClosefunc.apply($.modal, [dialog])
			}
		}
		return $.modal(data, options);
	};

	$.modalboxload = function (url, options) {
		$.ajax({
			url: url,
			dataType: "html",
			success: function(c){
				$.modalbox(c,options);
			}
		});
	};

	$.modalboxclose = function () {
		$.modal.close();
	};

})(jQuery);