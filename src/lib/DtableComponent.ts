
	import jQuery from 'jquery'
	import initDt  from 'datatables.net-dt'


    interface   initProps {
        id:string;
        props:any;
    }

export default   function injectDatatableAction(initProps: initProps, node: HTMLElement) {
    const    Dtable = new SvelteDatatable(initProps.id, {...initProps.props}, node);
    return {
        destroy() {
            
           
        },

    };
}

class SvelteDatatable
{
    public  id:string;
    public dtable:any;
    public initProps:any;
    constructor(identifier:string,initProps:any,node:HTMLElement) 
    {
        initDt();

        this.id = identifier
        this.dtable= jQuery(`#${this.id}`).DataTable(this.initProps);
        console.log(">><><",node)

    }

    

    
}