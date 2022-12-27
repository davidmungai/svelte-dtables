<script lang="ts">
	import { onMount } from 'svelte';
	import Search from './Search.svelte';
	export let columns;
	export let rows;
	let data = {
		displayData: [],
		originalData: [...rows],
		filterData: []
	};
	data.displayData = data.originalData;
	let table;
	$: rowValues = rows;
	onMount(async () => {
		// Load the external plugin library
		//const pluginLibrary = await import('path/to/plugin-library');
		// Register the plugin with the table
		//table.registerPlugin(pluginLibrary.default);
	});

	let searchTerm = '';

	function filterValuesCallback(value) {
		return Object.values(value).join().includes(searchTerm);
	}

	function myfilter(
		array,
		callback = (value) => {
			return Object.values(value).join().toLowerCase().includes(searchTerm.toLowerCase());
		}
	) {
		return array.filter(callback);
	}

	function searchTable(event) {
		searchTerm = event.target.value;

		if (searchTerm.length == 0) {
			rows = rowValues;
		}
		data.displayData = myfilter([...data.originalData]);
	}
	// holds table sort state.  initialized to reflect table sorted by id column ascending.
	let sortBy = { col: columns[0], ascending: true };

	$: sort = (column: string) => {
		if (sortBy.col == column) {
			sortBy.ascending = !sortBy.ascending;
		} else {
			sortBy.col = column;
			sortBy.ascending = true;
		}

		// Modifier to sorting function for ascending or descending
		let sortModifier = sortBy.ascending ? 1 : -1;

		let sort = (a, b) =>
			a[column] < b[column] ? -1 * sortModifier : a[column] > b[column] ? 1 * sortModifier : 0;

		rows = rows.sort(sort);
	};
</script>

<div>
	<div>
		<input type="text" placeholder="Search..." on:input={searchTable} />
	</div>

	<table bind:this={table}>
		<thead>
			<tr>
				{#each columns as column}
					<th on:click={sort(column)}> {column}</th>
				{/each}
			</tr>
		</thead>
		{#each data.displayData as rowObject}
			<tr>
				{#each Object.values(rowObject) as values}
					<td> {values}</td>
				{/each}
			</tr>
		{/each}
		<tbody />
	</table>
</div>

<style>
	th {
		cursor: pointer;
	}
</style>
