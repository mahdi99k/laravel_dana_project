<script>
	import { slide } from 'svelte/transition';

	export let showContent = false;
</script>

<!-- svelte-ignore a11y-no-static-element-interactions -->
<div class="bg-base--gray rounded-lg">
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<div
		class="w-full rounded-lg bg-table--title lg:p-5 p-2 flex justify-between items-center cursor-pointer my-4"
		on:click={() => {
			showContent = !showContent;
			console.log(showContent);
		}}
	>
		<div class="w-auto lg:text-lg text-base">
			<slot name="header" />
		</div>
		<div class="rounded-lg h-12 w-12 grid place-items-center bg-button--primary">
			{#if showContent} - {:else} + {/if}
		</div>
	</div>
	{#if showContent}
		<div transition:slide={{ duration: 300 }} class="p-3">
			<slot name="body" />
		</div>
	{/if}
</div>
