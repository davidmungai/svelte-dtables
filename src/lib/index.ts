
	import jQuery from 'jquery'
	import initDt  from 'datatables.net-dt'


    interface   initProps {
        id:string;
        props:any;
    }

export default   function injectDatatableAction(node: any,initProps: initProps, ) {

    const    Dtable = new SvelteDatatable(initProps.id, {...initProps.props}, node);
    return {
        destroy() {
            
          document.getElementById("datatable_wrapper").remove()
        },

    };
}

class SvelteDatatable
{
    public  id:string;
    public dtable:any;
    public initProps:any;
    constructor(identifier:string,initProps:any,node:any) 
    {
        initDt();

        this.id = identifier
        this.initProps=initProps.props
        this.dtable= jQuery(`#${this.id}`).DataTable(this.initProps);
        console.log(">><ddd><",node)

    }  
}