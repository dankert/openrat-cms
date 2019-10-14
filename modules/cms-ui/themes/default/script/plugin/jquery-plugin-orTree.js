/**
 * Baum darstellen.
 *
 * Die Controls zum Öffnen/Schließen der Teilbäume werden mit Event-Listener bestückt.
 * Beim Öffnen von Teilbäumen wird der Inhalt vom Server geladen.
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

                // Am Knoten die Klasse wechseln.
                $(node).removeClass('or-navtree-node--is-open').addClass('or-navtree-node--is-closed').find('.tree-icon').removeClass('image-icon--node-open').addClass('image-icon--node-closed');
            }
            else {
                // Pfad ist geschlossen -> öffnen.
                $(treeEl).closest('div.view').addClass('loader');

                var type = $(node).data('type');
                var id = $(node).data('id');
                var extraId = $(node).data('extra');

                var loadBranchUrl = './api/?action=tree&subaction=loadBranch&id=' + id + '&type=' + type + '&output=json';

                // Extra-Id ergänzen.
                if (typeof extraId === 'string') {
                    jQuery.each(jQuery.parseJSON(extraId.replace(/'/g,'"')), function (name, value) {
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

                // Die Inhalte des Zweiges laden.
                $.getJSON(loadBranchUrl, function (json) {

                    // Den neuen Unter-Zweig erzeugen.
                    let ul = $('<ul class="or-navtree-list" />');
                    $(treeEl).append(ul);
                    let output = json['output'];
                    $.each(output['branch'], function (idx, line) {
                        //if (!line.action || line.action == 'folder' || settings.selectable.length == 0 || settings.selectable[0] == '' || jQuery.inArray(line.action, settings.selectable) != -1) {
                            //var img = (line.url!==undefined?'tree_plus':'tree_none');
                            let new_li = $('<li class="or-navtree-node or-navtree-node--is-closed or-draggable or-draggable--type-'+line.type+'" data-id="' + line.internalId + '" data-type="' + line.type + '" data-extra="' + JSON.stringify(line.extraId).replace(/"/g, "\'") + '"><div class="tree or-navtree-node-control"><i class="tree-icon image-icon image-icon--node-closed"></i></div><div class="clickable"><a href="./#/' + line.action + (line.internalId!='0'?'/' + line.internalId:'') + '" class="entry" data-extra="' + JSON.stringify(line.extraId).replace(/"/g, "'") + '" data-id="' + line.internalId + '" data-action="' + line.action + '" data-type="open" title="' + line.description + '"><i class="image-icon image-icon--action-' + line['icon'] + '"></i> ' + line.text + '</a></div></li>');
                            $(ul).append(new_li);

                            $(new_li).orTree(); // Alle Unter-Knoten erhalten auch Event-Listener zum Öffnen/Schließen.

                            // Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
                            $(new_li).find('.clickable').orLinkify();
                            $(new_li).find('.clickable a').click( function(event) {
                                event.preventDefault(); // Links werden per Javascript geöffnet. Beim Öffnen im neuen Tab hat das aber keine Bedeutung.
                            } );
                            registerTreeBranchEvents(ul);
                        //}
                    });
                    $(ul).slideDown('fast'); // Einblenden

                }).fail(function () {
                    // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
                    Openrat.Workbench.notify('','','ERROR','failed to load subtree',[],false);
                }).always(function () {

                    // Die Loader-Animation entfernen.
                    $(treeEl).closest('div.view').removeClass('loader');
                });

                // Am Knoten die Klasse wechseln.
                $(node).addClass('or-navtree-node--is-open').removeClass('or-navtree-node--is-closed').find('.tree-icon').addClass('image-icon--node-open').removeClass('image-icon--node-closed');
            }
        });

    });
};