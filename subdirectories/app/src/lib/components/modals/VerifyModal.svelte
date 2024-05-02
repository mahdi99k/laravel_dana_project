<script>
	import { createEventDispatcher } from 'svelte';
	import { fade, scale } from 'svelte/transition';
	const dispatch = createEventDispatcher();
	export let showModal = false;
	export let successLabel = 'تایید';
	export let cancelLabel = 'لغو';

	const sendSuccess = (e) => {
		e.target.innerHTML = '<span class="loading loading-dots loading-md"></span>';
		dispatch('success');
	};
</script>

{#if showModal}
	<!-- svelte-ignore a11y-no-static-element-interactions -->
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<div
		class="w-screen h-screen top-0 right-0 bg-black bg-opacity-60 fixed flex items-center justify-center p-2"
		on:click|self={() => (showModal = false)}
		transition:fade={{ duration: 200 }}
	>
		<div
			class="p-6 relative rounded-lg bg-base--gray md:w-fit w-full min-w-60p"
			transition:scale={{ duration: 200, delay: 100 }}
		>
			<button
				class="bg-score--low h-10 w-10 rounded-lg mb-4 absolute top-4 right-4"
				on:click={() => (showModal = false)}
			>
				<i class="fi fi-rr-cross-small" />
			</button>
			<div class="w-[80%] text-center pt-3 mx-auto">
				<slot />
			</div>
			<div class="mt-6 flex items-stretch w-full flex-wrap">
				<div class="lg:w-6/12 w-full lg:pe-1">
					<button
						class="h-12 w-full bg-button--primary rounded-lg flex items-center justify-center lg:mb-0 mb-2"
						on:click={(e) => sendSuccess(e)}
					>
						{successLabel}
					</button>
				</div>
				<div class="lg:w-6/12 w-full lg:ps-1">
					<button
						class="h-12 w-full -bg--error rounded-lg flex items-center justify-center"
						on:click={() => (showModal = false)}
					>
						{cancelLabel}
					</button>
				</div>
			</div>
		</div>
	</div>
{/if}
