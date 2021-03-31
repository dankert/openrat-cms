
import $ from "../jquery-global.js";
import Workbench from "../openrat/workbench.js";
import Notice    from "../openrat/notice.js";

/**
 * Baum darstellen.
 *
 * Die Controls zum Öffnen/Schließen der Teilbäume werden mit Event-Listener bestückt.
 * Beim Öffnen von Teilbäumen wird der Inhalt vom Server geladen.
 */
export default function(options)
{
	// Create some defaults, extending them with any options that were provided
	let settings = $.extend( {
		'openAction' : function(name,action,id) {
		}
	}, options);

	let registerTreeBranchEvents = function (viewEl)
	{
		Workbench.getInstance().registerDraggable(viewEl);
	}


	$(this).each(function (idxx, treeEl)
    {
        // Klick-Funktion zum Öffnen des Zweiges.
        $(treeEl).children('.or-navtree-node-control').click( function ()
        {
            let $node = $(this).parent('.or-navtree-node');

            if ($node.is('.or-navtree-node--is-open')) {
                // Pfad ist offen -> schließen
                $node.children('ul').remove();

                // Am Knoten die Klasse wechseln.
                $node.removeClass('navtree-node--is-open').addClass('navtree-node--is-closed').find('.or-navtree-tree-icon').removeClass('image-icon--node-open').addClass('image-icon--node-closed');
            }
            else {
                // Pfad ist geschlossen -> öffnen.
				$(treeEl).closest('div.or-view').addClass('loader');
                let $link   = $node.find('a');
                //let type    = $link.data('extra-type');
                let id      = $link.data('id');
                let extraId = Workbench.htmlDecode($link.data('extra'));

                let loadBranchUrl = './?action=tree&subaction=branch&id=' + id + '';

                // Extra-Id ergänzen.
                if (typeof extraId === 'string')
					extraId = JSON.parse(extraId);

                if (typeof extraId === 'object') {
                    Object.keys(extraId).forEach( (name)=> {
                        loadBranchUrl = loadBranchUrl + '&' + name + '=' + extraId[name];
                    });
                }
                else {
                    ;
                }

                console.debug( { url:loadBranchUrl } );
                // Die Inhalte des Zweiges laden.
                fetch( loadBranchUrl )
					.then( response => { if (!response.ok) throw "Failed to load tree"; return response } )
					.then( response => response.text() )
					.then( html => {

						// Den neuen Unter-Zweig erzeugen.
						let $ul = $.create('ul' ).addClass('navtree-list');
						$(treeEl).append($ul);

						$ul.html( html );
						$ul.find('li').orTree(settings); // All subnodes are getting event listener for open/close

						/* macht linkify schon
						$(new_li).find('.act-clickable a').click( function(event) {
							event.preventDefault(); // Links werden per Javascript geöffnet. Beim Öffnen im neuen Tab hat das aber keine Bedeutung.
						} );*/
						registerTreeBranchEvents($ul);
						// Die Navigationspunkte sind anklickbar, hier wird der Standardmechanismus benutzt.
						$ul.find('.or-act-clickable').orLinkify( {
							'openAction':settings.openAction
						} );
						//$ul.slideDown('fast'); // Einblenden

                	}).catch( cause => {
						// Ups... aber was können wir hier schon tun, außer hässliche Meldungen anzeigen.
						console.error( {message:'Failed to load subtree',url:loadBranchUrl,cause:cause});
						let notice = new Notice();
						notice.setStatus( 'error' );
						notice.msg = cause;
                	}).finally( () => {
	                    // Die Loader-Animation entfernen.
    	                $(treeEl).closest('div.or-view').removeClass('loader');
        	        });

                // Am Knoten die Klasse wechseln.
                $node.addClass('navtree-node--is-open').removeClass('navtree-node--is-closed').find('.or-navtree-tree-icon').addClass('image-icon--node-open').removeClass('image-icon--node-closed');
            }
        });

    });
};