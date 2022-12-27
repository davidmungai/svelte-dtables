<script lang="ts">
	export let rows;
	let searchString;

	$: filter = (searchString: string) => {
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

<div class="relative mt-1">
	<input type="text" placeholder="search for items" />
</div>
