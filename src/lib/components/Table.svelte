<script lang="ts">
	import Search from './Search.svelte';
	export let columns;
	export let rows;
	console.log(rows);
</script>

<div>
	<div><Search /></div>
	<table>
		<thead>
			<tr>
				{#each columns as column}
					<th> {column}</th>
				{/each}
			</tr>
		</thead>
		{#each rows as rowObject}
			<tr>
				{#each Object.values(rowObject) as values}
					<td> {values}</td>
				{/each}
			</tr>
		{/each}
		<tbody />
	</table>
</div>
