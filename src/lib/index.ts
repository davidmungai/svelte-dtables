import jQuery from 'jquery';
import initDt from 'datatables.net-dt';

interface initProps {
	tableId: string;
	columns?: any;
	data?: any;
	endpointUrl?: any;
}

export default class SvelteDatatable implements initProps {
	tableId: string;
	columns?: any;
	data?: any;
	url?: any;
	public dtable: any;
	public initProps: any;
	public dtColumns: any;
	public dtRows: any;
	constructor(initProps: initProps) {
		initDt();
		this.tableId = initProps.tableId;

		if (initProps.columns && initProps.data) {
			this.dtable = jQuery(`#${this.tableId}`).DataTable({
				data: initProps.data,
				columns: initProps.columns
			});
		}

		if (initProps.endpointUrl) {
			this.dtable = jQuery(`#${this.tableId}`).DataTable({
				columns: initProps.columns,
				ajax: initProps.endpointUrl
			});
		}
	}
}
