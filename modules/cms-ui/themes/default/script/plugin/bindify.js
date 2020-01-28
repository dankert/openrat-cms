/*! GPL */
/* bindify JQuery databinding plugin*/
(function ( $ ) {

    $.fn.bindify = function( data={},options={} ) {

        let settings = $.extend({
            prefix: 'binding',
            updateModel: true,
            updateDOM: true,
            updateCallback: $.Callbacks(),
            debug: false,
            updateEvent: 'input',
            onUpdate: function(data) {},
        }, options );

        let el = this;

        let updateDOM = function() {

            setTimeout( function() {bind(el,data)} , 0 );
        }

        settings.updateCallback.add( updateDOM );

        let prefix = settings.prefix + '-';

        // Enable writing back data from the DOM to the model.
        if   ( settings.updateModel)
            $(el).find('[data-'+prefix+'value]').each( function() {
                // Change listener for writing back the input to the model
                // First, remove any other listeners
                $(this).off(settings.updateEvent);
                // Now create the listener for new input values.
                $(this).on(settings.updateEvent, function() {

                    if   ( settings.debug )
                        console.log("Input event fired: "+this.value);

                    assign(data,$(this).data(prefix+'value'),this.value);
                    settings.onUpdate(data);
                    settings.updateCallback.fire();
                } );
            });



        let assign = function(obj, prop, value) {
            if (typeof prop === "string")
                prop = prop.split(".");

            if (prop.length > 1) {
                var e = prop.shift();
                assign(obj[e] =
                        Object.prototype.toString.call(obj[e]) === "[object Object]"
                            ? obj[e]
                            : {},
                    prop,
                    value);
            } else
                obj[prop[0]] = value;
        }

        let getData = function( key,data ) {
            function index(obj,i) {
                return obj[i]
            }
            return key.split('.').reduce(index, data);
        }

        // Lets do the data bind to a DOM element.
        // This function is called recursively for all DOM children.
        let bind = function( element,data) {

            // Value binding for input elements
            // input values are written back to the data model
            let dataValue = element.data(prefix+'value');
            if   ( dataValue ) {
                element.val( getData( dataValue, data ) );
                // A change listener is already created.
            }

            // Binding for the node content.
            let dataText = element.data(prefix+'text');
            if   ( dataText )
                element.text( getData( dataText, data ) );

            // Binding for the attributes.
            let dataAttributes = element.data(prefix+'attributes');
            if   ( dataAttributes ) {
                // JQuery is parsing the JSON automatically
                Object.keys(dataAttributes).forEach(function (key) {
                    element.attr(key, getData(dataAttributes[key],data))
                },this);
            }

            // Binding for a list
            let dataList = element.data(prefix+'list');
            if   ( dataList ) {
                let eachData = getData( dataList, data );

                let children     = $(element).children();
                let firstChild   = children.first();
                let isLength     = children.length;
                let shouldLength = eachData.length;
                if   ( isLength > 0 )
                {
                    if   ( settings.debug )
                        console.log("List "+dataList+" has "+isLength+ " entrys, should have "+shouldLength);

                    // Add children to force the correct children count
                    for( let i=isLength+1; i<=shouldLength; i++ )
                        firstChild.clone().appendTo( element );
                    // Remove children to force the correct children count
                    for( let i=shouldLength+1; i<=isLength; i++ )
                        element.children().last().remove();

                    let children     = $(element).children();
                    let key = dataList;
                    let dataVar = element.data(prefix+'var');
                    if   ( dataVar )
                        key = dataVar;

                    for( let i=0; i<eachData.length; i++) {
                        let childData = {};
                        childData[key] = eachData[i];
                        let computedDataForChild = Object.assign({},data,childData);
                        bind( children.eq(i),computedDataForChild );
                    };

                }
            }
            else{
                $(element).children().each( function() {
                    bind($(this),data );
                });
            }
        };

        // Initial Binding
        settings.updateCallback.fire();

        // JQuery should stay chainable.
        return this;
    };

}( jQuery ));
