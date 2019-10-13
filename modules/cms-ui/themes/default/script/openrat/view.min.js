/**
 * View.
 * Eine View ist ein HTML-Fragment, in das eine Action geladen wird.
 * Das Erzeugen der View, das Laden vom Server sowie das Schließen sind hier gekapselt.
 *
 * @param action
 * @param method
 * @param id
 * @param params
 * @constructor
 */
function View( action,method,id,params ) {

    this.action = action;
    this.method = method;
    this.id = id;
    this.params = params;

    this.before = function() {};

    this.start = function( element ) {
        this.before();
        this.element = element;
        this.loadView();
    }

    this.afterLoad = function() {

    }

    this.close = function() {
    }


    function registerViewEvents(element) {

        registerMenuEvents( element );
        registerSearch    ( element );
        registerTree      ( element );
        afterViewLoaded   ( element );

    }


    this.loadView = function() {

        let url = createUrl( this.action,this.method,this.id,this.params,true); // URL für das Laden erzeugen.
        let element = this.element;
        let view = this;

        $(this.element).empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {

            $(element).fadeTo(350,1);

            $(element).removeClass("loader");

            $(element).find('form').each( function() {
                let form = new Form();
                form.close = function() {
                    view.close();
                }
                form.initOnElement(this);

            });
            if	( status == "error" )
            {
                // Seite nicht gefunden.
                $(element).html("");

                notify('','','error','Server Error',['Server Error while requesting url '+url, response]);
                return;
            }

            registerViewEvents( element );

        });

    }

}
