<script>
	export let status;
    import {createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	const deleteThis = (event) => {
		event.target.innerHTML = '<span class="loading loading-dots loading-xs"></span>';
        dispatch('deleteThis');
        event.target.innerHTML = 'حذف';
	};
	const editThis = () => {
        console.log('res');
        dispatch('editThis');
	};
</script>
{#if status == undefined}
<div class="flex">
	<button
		on:click={() => {
			editThis();
		}}
		class="btn me-2 text-white text-lg rounded-xl xl:w-2/12 w-6/12 ms-auto block h-14 gtid place-items-center bg-button--socondary border-none hover:bg-table--item"
	>
		ویرایش
	</button>
	<button
		on:click={(event) => {
			deleteThis(event);
		}}
		class="btn text-white text-lg rounded-xl xl:w-2/12 w-6/12 block h-14 gtid place-items-center bg-button--socondary border-none hover:bg-table--item"
	>
		حذف
	</button>
</div>
{:else if status == 0 || status == 3}
<div class="flex">
	<button
		on:click={() => {
			editThis();
		}}
		class="btn me-2 text-white text-lg rounded-xl xl:w-2/12 w-6/12 ms-auto block h-14 gtid place-items-center bg-button--socondary border-none hover:bg-table--item"
	>
		ویرایش
	</button>
	<button
		on:click={(event) => {
			deleteThis(event);
		}}
		class="btn text-white text-lg rounded-xl xl:w-2/12 w-6/12 block h-14 gtid place-items-center bg-button--socondary border-none hover:bg-table--item"
	>
		حذف
	</button>
</div>
{/if}
