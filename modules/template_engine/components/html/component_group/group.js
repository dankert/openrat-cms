import Workbench from "../../../../cms/ui/themes/default/script/openrat/workbench.js";
import $ from  "../../../../cms/ui/themes/default/script/jquery-global.js";

/**
 * open/close handler for groups.
 */
export default function(element ) {

    Workbench.registerOpenClose( $(element).find('.or-collapsible.or-group') );
};
