import editor from '../../../../../../template_engine/components/html/component_editor/editor.js';
import group  from '../../../../../../template_engine/components/html/component_group/group.js';
import link   from '../../../../../../template_engine/components/html/component_link/link.js';
import qrcode from '../../../../../../template_engine/components/html/component_qrcode/qrcode.js';
import table  from '../../../../../../template_engine/components/html/component_table/table.js';
import upload from '../../../../../../template_engine/components/html/component_upload/upload.js';
import Callback from "./callback.js";

console.debug('registering component scripts');

Callback.afterViewLoadedHandler.add( editor );
Callback.afterViewLoadedHandler.add( group  );
Callback.afterViewLoadedHandler.add( link   );
Callback.afterViewLoadedHandler.add( qrcode );
Callback.afterViewLoadedHandler.add( table  );
Callback.afterViewLoadedHandler.add( upload );
