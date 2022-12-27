<script>
	import { Table } from 'svelte-dtable';
	let columns = ['name', 'position', 'salary', 'start_date', 'office', 'extn'];
	let data = [
		{
			name: 'tiger nixon',
			position: 'Architect',
			salary: '$30',
			start_date: '2011/01/25',
			office: 'Edinburgh',
			extn: 1
		},
		{
			name: 'Tiger Nixon',
			position: 'System Engineer',
			salary: '$31',
			start_date: '2011/08/25',
			office: 'Edinburgh',
			extn: 2
		},
		{
			name: 'Tiger Nixon',
			position: 'freelancer',
			salary: '$32',
			start_date: '2011/03/25',
			office: 'Edinburgh',
			extn: 3
		},
		{
			name: 'Tiger Nixon',
			position: 'dancer',
			salary: '$33',
			start_date: '2011/04/25',
			office: 'Edinburgh',
			extn: 4
		}
	];
</script>

<div>
	<Table rows={data} {columns} />
</div>
