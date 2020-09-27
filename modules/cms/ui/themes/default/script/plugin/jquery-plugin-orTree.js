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
            let $node = $(this).parent('.or-navtree-node');

            if ($node.is('.or-navtree-node--is-open')) {
                // Pfad ist offen -> schließen
                $node.children('ul').slideUp('fast').remove();

                // Am Knoten die Klasse wechseln.
                $node.removeClass('or-navtree-node--is-open').addClass('or-navtree-node--is-closed').find('.tree-icon').removeClass('image-icon--node-open').addClass('image-icon--node-closed');
            }
            else {
                // Pfad ist geschlossen -> öffnen.
                $(treeEl).closest('div.view').addClass('loader');

                let $link   = $node.find('a');
                //let type    = $link.data('extra-type');
                let id      = $link.data('id');
                let extraId = $link.data('extra');

                let loadBranchUrl = './?action=tree&subaction=branch&id=' + id + '';

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
                $.get(loadBranchUrl).done( function (html) {

                    // Den neuen Unter-Zweig erzeugen.
                    let $ul = $('<ul class="or-navtree-list" />');
                    $(treeEl).append($ul);

                    $ul.append( html );
                    $ul.find('li').orTree(); // All subnodes are getting event listener for open/close

					// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
					$ul.find('.clickable').orLinkify();
					/* macht linkify schon
					$(new_li).find('.clickable a').click( function(event) {
						event.preventDefault(); // Links werden per Javascript geöffnet. Beim Öffnen im neuen Tab hat das aber keine Bedeutung.
					} );*/
					registerTreeBranchEvents($ul);
                    $ul.slideDown('fast'); // Einblenden

                }).fail(function () {
                    // Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
                    Openrat.Workbench.notify('','','ERROR','Failed to load subtree',[],false);
                }).always(function () {

                    // Die Loader-Animation entfernen.
                    $(treeEl).closest('div.view').removeClass('loader');
                });

                // Am Knoten die Klasse wechseln.
                $node.addClass('or-navtree-node--is-open').removeClass('or-navtree-node--is-closed').find('.tree-icon').addClass('image-icon--node-open').removeClass('image-icon--node-closed');
            }
        });

    });
};