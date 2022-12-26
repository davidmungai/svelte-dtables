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
	import data from './data.ts';
	let columns = ['name', 'position', 'salary', 'start_date', 'office', 'extn'];
</script>

<div>
	<Table rows={data} {columns} />
</div>
```

## Contributing

Pull requests are welcome [svelte-dtable](https://github.com/davidmungai/svelte-dtables). For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
