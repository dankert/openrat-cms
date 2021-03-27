import Workbench from "../../../../cms/ui/themes/default/script/openrat/workbench.js";

/**
 * open/close handler for groups.
 */
export default function(element ) {

    Workbench.registerOpenClose( $(element).find('.or-collapsible.or-group') );
};
