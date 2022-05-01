<script lang="ts">
    import {onMount,onDestroy} from "svelte"
	import jQuery from 'jquery'
	import initDt  from 'datatables.net-dt'
	  	
	export let el:any // table element
	export let dtable:any // table object (
  export let className

  export let columns:Array<any>
  export let data:Array<any>
        
  onMount(() => {
      initDt()
		  dtable = jQuery(el).DataTable({
        data,
        columns
      })	
    
     console.log(dtable.data())
	})

   onDestroy(() =>{if(dtable){dtable.destroy()} 	});

</script>
<svelte:head>
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" />
</svelte:head>

<table bind:this={el} class="display cell-border compact" style="width:100%">
  </table>