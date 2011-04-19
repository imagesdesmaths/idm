var sort_table_serial_init;
function init_sort_table(){
	$('#sort_table').Sortable(
		{
			accept : 			'sortableitem',
			activeclass : 'sortableactive',
			hoverclass : 	'sortablehover',
			helperclass : 'sorthelper',
			/*handle : '.sortableChoixHandle',*/
			/*opacity: 		0.8,*/
			/*fx:				200,*/
			revert:			true,
			tolerance:		'intersect',
			/*containment: 'parent',*/
			onStart : function(){
				sort_table_serial_init = $.SortSerialize($(this).parent().attr("id")).hash;
			},
			onStop : function(){
				serial = $.SortSerialize($(this).parent().attr("id"));
				var url = $(this).parent().siblings('a').attr("rel");
				//alert(serial.hash);
				if (sort_table_serial_init!=serial.hash){
					$(this).parent().siblings('input[name=ordre]').val(serial.hash);
					$(this).parent().parent().find('input[type=submit]').eq(0).each(function(){ this.click(); });
				}
			}
		}
	)
}
onAjaxLoad(init_sort_table);
$(document).ready(function(){
	init_sort_table();
});
