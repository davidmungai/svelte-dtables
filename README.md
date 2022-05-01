```
<script lang="ts">
  import Dtable from "$lib/Dtable.svelte"
</script>
<Dtable columns={[
    { data: 'name', title:'name' },
    { data: 'position' ,title: 'position'},
    { data: 'salary',title: 'salary' },
    { data: 'office',title: 'office' }
]}
data={[
    {
        "name":       "Tiger Nixon",
        "position":   "System Architect",
        "salary":     "$3,120",
        "start_date": "2011/04/25",
        "office":     "Edinburgh",
        "extn":       "5421"
    },
    {
        "name":       "Garrett Winters",
        "position":   "Director",
        "salary":     "$5,300",
        "start_date": "2011/07/25",
        "office":     "Edinbudddddddddddddrgh",
        "extn":       "8422"
    }
]}
/>
```
