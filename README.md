# Datables ported into svelte

# still in beta

Porting datatable to svelte

```
<script lang="ts">
	import injectDatatableAction from '$lib';
	let initProps = { id: 'datatable', props: {} };
</script>

<table id="datatable" use:injectDatatableAction={initProps} class="display" style="width:100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Office</th>
			<th>Age</th>
			<th>Start date</th>
			<th>Salary</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tiger Nixon</td>
			<td>System Architect</td>
			<td>Edinburgh</td>
			<td>61</td>
			<td>2011/04/25</td>
			<td>$320,800</td>
		</tr>
		<tr>
			<td>Garrett Winters</td>
			<td>Accountant</td>
			<td>Tokyo</td>
			<td>63</td>
			<td>2011/07/25</td>
			<td>$170,750</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th>Name</th>
			<th>Position</th>
			<th>Office</th>
			<th>Age</th>
			<th>Start date</th>
			<th>Salary</th>
		</tr>
	</tfoot>
</table>

```
