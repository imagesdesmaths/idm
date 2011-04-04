/**
 * jQuery Checkbox Tree
 *
 * @author Valerio Galano <valerio.galano@gmail.com>
 *
 * @see http://checkboxtree.googlecode.com
 *
 * @version 0.3.2
 */
(function($){

    var checkboxTree = 0;

    $.fn.checkboxTree = function(options) {

        // build main options before element iteration
        var options = $.extend({
            checkChildren: true,
            checkParents: true,
            collapsable: true,
            collapseAllButton: '',
            collapsed: false,
            collapseDuration: 500,
            collapseEffect: 'blind',
            collapseImage: '',
            container: 'checkboxTree'+'['+ checkboxTree++ +']',
            cssClass: 'checkboxTree',
            expandAllButton: '',
            expandDuration: 500,
            expandEffect: 'blind',
            expandImage: '',
            leafImage: ''
        }, options);

        options.collapseAnchor = (options.collapseImage.length > 0) ? '<img src="'+options.collapseImage+'" />' : '-';
        options.expandAnchor = (options.expandImage.length > 0) ? '<img src="'+options.expandImage+'" />' : '+';
        options.leafAnchor = (options.leafImage.length > 0) ? '<img src="'+options.leafImage+'" />' : '';

        // build collapse all button
        if (options.collapseAllButton.length > 0) {

            $collapseAllButton = $('<a/>', {
                'class': options.cssClass+' all',
                id:      options.container+'collapseAll',
                href:    'javascript:void(0);',
                html:    options.collapseAllButton,
                click:   function(){
                    $('[class*=' + options.container + '] span').each(function(){
                        if ($(this).hasClass("expanded")) {
                            collapse($(this), options);
                        }
                    });
                }
            });

            this.parent().prepend($collapseAllButton);
        }

        // build expand all button
        if (options.expandAllButton.length > 0) {

            $expandAllButton = $('<a/>', {
                'class': options.cssClass+' all',
                id:      options.container+'expandAll',
                href:    'javascript:void(0);',
                html:    options.expandAllButton,
                click:   function(){
                    $('[class*=' + options.container + '] span').each(function(){
                        if ($(this).hasClass("collapsed")) {
                            expand($(this), options);
                        }
                    });
                }
            });

            this.parent().prepend($expandAllButton);
        }

        // setup tree
        $("li", this).each(function() {

            if (options.collapsable) {

                var $a;

                if ($(this).is(":has(ul)")) {
                    if (options.collapsed) {
                        $(this).find("ul").hide();
                        $a = $('<span></span>').html(options.expandAnchor).addClass("collapsed");
                    } else {
                        $a = $('<span></span>').html(options.collapseAnchor).addClass("expanded");
                    }
                } else {
                     $a = $('<span></span>').html(options.leafAnchor).addClass("leaf");
                }

                $(this).prepend($a);
            }

        });

        // handle single expand/collapse
        this.find('span').bind("click", function(e, a){

            if ($(this).hasClass("leaf") == undefined) {
                return;
            }

            if ($(this).hasClass("collapsed")) {
                expand($(this), options);
            } else {
                collapse($(this), options);
            }
        });

        // handle tree select/unselect
        this.find(':checkbox').bind("click", function(e, a) {

            if (options.checkChildren) {
                toggleChildren($(this));
            }

            if (options.checkParents && $(this).is(":checked")) {
                checkParents($(this), options);
            }
        });

        // add container class
        this.addClass(options.container);

        // add css class
        this.addClass(options.cssClass);

        return this;
    };


    /**
     * Recursively check parents of passed checkbox
     */
    this.checkParents = function(checkbox, options)
    {
        var parentCheckbox = checkbox.parents("li:first").parents("li:first").find(" :checkbox:first");

        if (!parentCheckbox.is(":checked")) {
            parentCheckbox.attr("checked","checked").change();
        }

        if (parentCheckbox.parents('[class*=' + options.container + ']').attr('class') != undefined) {
            checkParents(parentCheckbox, options);
        }
    }

    /**
     * Collapse tree element
     */
    this.collapse = function(img, options)
    {
        var listItem = img.parents("li:first");

        if ($.ui !== undefined) {
            listItem.children("ul").hide(options.collapseEffect, {}, options.collapseDuration);
        } else {
            listItem.children("ul").hide(options.collapseDuration);
        }

        listItem.children("span").html(options.expandAnchor).addClass("collapsed").removeClass("expanded");
    }

    /**
     * Expand tree element
     */
    this.expand = function(img, options)
    {
        var listItem = img.parents("li:first");

        if ($.ui !== undefined) {
            listItem.children("ul").show(options.expandEffect, {}, options.expandDuration);
        } else {
            listItem.children("ul").show(options.expandDuration);
        }

        listItem.children("span").html(options.collapseAnchor).addClass("expanded").removeClass("collapsed");
    }

    /**
     * Check/uncheck children of passed checkbox
     */
    this.toggleChildren = function(checkbox)
    {
        checkbox.parents('li:first').find('li :checkbox').attr('checked',checkbox.attr('checked') ? 'checked' : '').change();
    }

})(jQuery);
