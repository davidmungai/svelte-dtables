# svelte-dtable

svelte-dtable is a svelte datatables library

## DO NOT USE in prod as it is still in beta

## Installation

Use the package manager [npm](https://www.npmjs.com/) to install svelte-dtable.

```bash
npm i svelte-dtable
```
## Examples

find documentation at [npm](https://svelte-dtable.netlify.app/) to install svelte-dtable.

```bash
npm i svelte-dtable
```


## Usage

```javascript

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
	<Table rows={data} columns={columns} />
</div>
```

## Contributing

Pull requests are welcome [svelte-dtable](https://github.com/davidmungai/svelte-dtables). For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
