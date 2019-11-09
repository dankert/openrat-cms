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
Openrat.View = function( action,method,id,params ) {

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

        Openrat.Workbench.afterViewLoaded(element);

        let f = $(element).data('afterViewLoaded');
        if   ( f instanceof Function)
            f(element);
    }


    this.loadView = function() {

        let url = Openrat.View.createUrl( this.action,this.method,this.id,this.params); // URL für das Laden erzeugen.
        let element = this.element;
        let view = this;

        $(this.element).empty().fadeTo(1,0.7).addClass('loader').html('').load(url,function(response, status, xhr) {

            $(element).fadeTo(350,1);

            $(element).removeClass("loader");

            $(element).find('form').each( function() {
                let form = new Openrat.Form();
                form.close = function() {
                    view.close();
                }
                form.initOnElement(this);

            });
            if	( status == "error" )
            {
                // Seite nicht gefunden.
                $(element).html("");

                Openrat.Workbench.notify('','','error','Server Error',['Server Error while requesting url '+url, response]);
                return;
            }

            registerViewEvents( element );

        });

    }




    /**
     * Erzeugt eine URL, um die gewünschte Action vom Server zu laden.
     *
     * @param action
     * @param subaction
     * @param id
     * @param extraid
     * @returns URL
     */
    Openrat.View.createUrl = function(action,subaction,id,extraid={} )
    {
        var url = './';

        url += '?';

        if(action)
            url += '&action='+action;
        if(subaction)
            url += '&subaction='+subaction;
        if(id)
            url += '&id='+id;

        if	( typeof extraid === 'string')
        {
            extraid = extraid.replace(/'/g,'"'); // Replace ' with ".
            var extraObject = jQuery.parseJSON(extraid);
            jQuery.each(extraObject, function(name, value) {
                url = url + '&' + name + '=' + value;
            });
        }
        else if	( typeof extraid === 'object')
        {
            jQuery.each(extraid, function(name, field) {
                url = url + '&' + name + '=' + field;
            });
        }
        else
        {
        }
        return url;
    }


}
