<script>
	import { onMount } from 'svelte';
	import { fade } from 'svelte/transition';
	export let showModal = false;
	const close = () => {
		showModal= false;
	}
	
	
</script>
<!-- svelte-ignore a11y-no-static-element-interactions -->
{#if showModal}
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<div transition:fade={{duration:200}} class="bg-black bg-opacity-30 fixed top-0 start-0 h-screen w-screen z-40" on:click|self={close}>
		<div class="bg-base--gray rounded-xl p-6 pt-3 fixed bottom-0 w-full start-0 m-0 modal-content">
			<div class="relative w-full h-full">
				<div class="absolute top-1 h-1 rounded-xl bg-input-border w-3/12 start-1/2 translate-x-1/2 z-30 bg-input--border"></div>
					<div class="h-full w-full overflow-auto pt-10 modal-body" on:click={close}>
						<slot />
					</div>
				<button class="bg--primary rounded-xl h-12 w-full grid place-items-center mt-5" on:click={close}>انصراف</button>
			</div>
		</div>
	</div>
{/if}

<style>
.modal-content{
	animation: bottom 0.3s ease-out forwards;
	max-height: 700px; 
}
.modal-body{
	max-height: 600px;
}
@keyframes bottom {
	0%{
		bottom: -1000px;
	}
	100%{
		bottom: 0;
	}
}
</style>