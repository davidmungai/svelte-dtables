<script lang="ts">
	import SvelteDatatable from 'svelte-dtable';
	import { onMount, beforeUpdate } from 'svelte';
	import data from './data';

	onMount(async () => {
		new SvelteDatatable({
			tableId: 'example',
			columns: [
				{ data: 'name', title: 'Name' },
				{ data: 'position', title: 'Position' },
				{ data: 'office', title: 'Office' },
				{ data: 'extn', title: 'Extension' },
				{ data: 'start_date', title: 'Position' },
				{ data: 'salary', title: 'Salary' }
			],
			endpointUrl: 'https://datatables.net/examples/ajax/data/objects.txt?_=1651824124178'
		});
		new SvelteDatatable({
			tableId: 'example2',
			columns: [
				{ data: 'name', title: 'name' },
				{ data: 'position', title: 'position' },
				{ data: 'salary', title: 'salary' },
				{ data: 'office', title: 'office' },
				{
					data: null,
					defaultContent: `<button>View</button>`,
					title: 'action'
				}
			],
			data
		});
	});
</script>

<svelte:head>

<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</svelte:head>

<div>
	<h1>loading via ajax</h1>
	<table id="example" class="display" />
</div>
<div>
	<h1>loading via columns</h1>
	<table id="example2" class="display" />
</div>
