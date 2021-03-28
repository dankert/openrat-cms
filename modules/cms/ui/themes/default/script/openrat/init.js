
import Workbench from "./workbench.js";

// Startup the workbench
//
// Because this module is loaded with 'defer', the event 'domInteractive' is already fired and the DOM is parsed and ready.
// So we do not need to wait for DOMContentLoaded here.

Workbench.getInstance().initialize(); // Startup the Workbench


