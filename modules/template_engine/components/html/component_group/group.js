/**
 * open/close handler for groups.
 */
Workbench.afterViewLoadedHandler.add(  function(element ) {

    Workbench.registerOpenClose( $(element).find('.or-collapsible.or-group') );
});
