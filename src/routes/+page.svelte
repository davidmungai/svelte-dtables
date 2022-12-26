<script>
	import { Table } from 'svelte-dtable';
	import data from './data.ts';
	let columns = ['name', 'position', 'salary', 'start_date', 'office', 'extn'];
</script>

<div>
	<Table rows={data} {columns} />
</div>
