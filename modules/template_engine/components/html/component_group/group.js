/**
 * open/close handler for groups.
 */
Openrat.Workbench.afterViewLoadedHandler.add(  function(element ) {

    Openrat.Workbench.registerOpenClose( $(element).find('.or-group.or-toggle-open-close') );
});
