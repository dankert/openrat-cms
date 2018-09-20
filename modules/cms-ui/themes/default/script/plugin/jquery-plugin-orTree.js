/**
 * Baum darstellen.
 */
jQuery.fn.orTree = function ()
{
    $(this).each(function (idxx, treeEl)
    {
        // Klick-Funktion zum Öffnen des Zweiges.
        $(treeEl).children('.or-navtree-node-control').click( function ()
        {
            var node = $(this).parent('.or-navtree-node');

            if ($(node).is('.or-navtree-node--is-open')) {
                // Pfad ist offen -> schließen
                $(node).children('ul').slideUp('fast').remove();

                $(node).removeClass('or-navtree-node--is-open').addClass('or-navtree-node--is-closed').find('.arrow').removeClass('arrow-down').addClass('arrow-right');
            }
            else {
                // Pfad ist geschlossen -> öffnen.
                $(treeEl).closest('div.content').addClass('loader');

                var type = $(node).data('type');
                var id = $(node).data('id');
                var extraId = $(node).data('extra');

                var loadBranchUrl = './api/?action=tree&subaction=loadBranch&id=' + id + '&type=' + type + '&output=json';

                // Extra-Id ergänzen.
                if (typeof extraId === 'string') {
                    jQuery.each(jQuery.parseJSON(extraId), function (name, value) {
                        loadBranchUrl = loadBranchUrl + '&' + name + '=' + value;
                    });
                }
                else if (typeof extraId === 'object') {
                    jQuery.each(extraId, function (name, field) {
                        loadBranchUrl = loadBranchUrl + '&' + name + '=' + field;
                    });
                }
                else {
                    ;
                }

                $.getJSON(loadBranchUrl, function (json) {

                    $(treeEl).append('<ul class="or-navtree-list"/>');
                    var ul = $(treeEl).children('ul').first();
                    var output = json['output'];
                    $.each(output['branch'], function (idx, line) {
                        //if (!line.action || line.action == 'folder' || settings.selectable.length == 0 || settings.selectable[0] == '' || jQuery.inArray(line.action, settings.selectable) != -1) {
                            //var img = (line.url!==undefined?'tree_plus':'tree_none');
                            var new_li = $('<li class="or-navtree-node or-navtree-node--is-closed" data-id="' + line.internalId + '" data-type="' + line.type + '"><div class="tree or-navtree-node-control"><div class="arrow arrow-right"></div></div><div class="clickable"><a href="./?action=' + line.action + '&id=' + line.internalId + '" class="entry" data-extra="' + JSON.stringify(line.extraId).replace(/"/g, "'") + '" data-id="' + line.internalId + '" data-action="' + line.action + '" data-type="open" title="' + line.description + '"><img src="modules/cms-ui/themes/default/images/icon_' + line['icon'] + '.png" />' + line.text + '</a></div></li>');
                            $(ul).append(new_li);
                            //var new_li = $(ul).children('li').last();
                            //$(new_li).children('div').unbind('click');
                            $(new_li).orTree();

                            $(new_li).find('.clickable').orLinkify();
                            $(new_li).find('.clickable a').click( function(event) {
                                event.preventDefault();
                            } );
                        //}
                    });
                    //$(ul).children('li:last-child').addClass('last');
                    $(ul).slideDown('fast'); // Einblenden

                }).fail(function () {
                    //
                }).always(function () {
                    $(treeEl).closest('div.content').removeClass('loader');
                });

                $(node).addClass('or-navtree-node--is-open').removeClass('or-navtree-node--is-closed').find('.arrow').addClass('arrow-down').removeClass('arrow-right');
            }
        });

    });
};