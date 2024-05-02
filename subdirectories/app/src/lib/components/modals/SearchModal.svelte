<script>
	import { scale, fade } from 'svelte/transition';
	import { createEventDispatcher } from 'svelte';
	import axios from 'axios';
	import { API_URL } from '../../main';
	let dispatch = createEventDispatcher();

	export let showModal = false;
	export let searchValue = '';
	export let url = '';
	export let query = '';
	export let label;
	export let title;
	export let sendAll = false;
	export let responsive = false;
	export let required = true;
	let isPending = true;
	let data = [];
	let classes = '';
	let selected = false;
	if (responsive) {
		classes = 'border border-input--border ';
	}
	let last_page, current_page;
	let page = 1;
	const close = () => {
		showModal = false;
	};
	const sendValue = (data) => {
		if (sendAll) label = data.name;
		else label = data;
		close();
		selected = true;
		dispatch('select', data);
	};
	async function getData() {
		isPending = true;
		setTimeout(async () => {
			await axios
				.get(`${API_URL}${url}?${query}&page=${page}&name=${searchValue}`)
				.then(function (response) {
					data = response.data.data;
					current_page = response.data.meta.current_page;
					last_page = response.data.meta.last_page;
					isPending = false;
				});
		}, 600);
	}
</script>

<div class={responsive ? 'lg:p-5 sm:p-3 p-2 lg:w-1/3 sm:w-1/2 w-full' : ''}>
	<div
		class="select-btn h-14 px-3 py-2 rounded-xl bg-table--item flex justify-between items-center cursor-pointer {classes}"
		on:click={() => {
			showModal = true;
			getData();
		}}
	>
		<div class="text-sm flex items-center">
			<span>{title || label}</span>
			{#if required && !selected && !title}
				<span class="-text--error ms-1">*</span>
			{/if}
		</div>
		<div class="bg-button--socondary rounded-lg w-7 h-7 grid place-items-center">
			<i class="text-xs fi fi-rr-plus" />
		</div>
	</div>
</div>
{#if showModal}
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<!-- svelte-ignore a11y-no-static-element-interactions -->
	<div
		transition:fade={{ duration: 200 }}
		class="fixed flex items-center justify-center bg-black bg-opacity-30 h-screen w-screen z-40 top-0 right-0"
		on:click|self={close}
	>
		<div
			class="bg-base--gray rounded-xl lg:w-8/12 lg:h-5/6 w-full h-full p-5"
			transition:scale={{ duration: 200 }}
		>
			<button class="bg-score--low h-10 w-10 rounded-lg mb-4" on:click={close}>
				<i class="fi fi-rr-cross-small" />
			</button>
			<input
				type="text"
				class="w-full border border-input--border outline-none h-12 p-3 text-white bg-transparent rounded-lg mb-2"
				on:keyup={() => {
					page = 1;
					getData();
				}}
				bind:value={searchValue}
				placeholder="جستجو"
			/>

			{#if isPending}
				<div class="purple-scrollbar modal-container overflow-y-auto h-4/5 animate-pulse">
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
					<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
				</div>
			{:else}
				<div class="purple-scrollbar modal-container overflow-y-auto h-5/6">
					{#each data as d}
						{#if sendAll}
							<div
								on:click={() => sendValue(d)}
								class="cursor-pointer rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full"
							>
								{d.name}
							</div>
						{:else}
							<!-- svelte-ignore a11y-click-events-have-key-events -->
							<!-- svelte-ignore a11y-no-static-element-interactions -->
							<div
								on:click={() => sendValue(d.name)}
								class="cursor-pointer rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full"
							>
								{d.name}
							</div>
						{/if}
					{/each}
					<div class="lg:w-5/12 sm:w-8/12 w-full flex bg-table--item rounded-lg h-14 mx-auto my-2">
						<button
							on:click={() => {
								page++;
								getData();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}"><i class="fi fi-rr-angle-right" /></button
						>
						<button
							on:click={() => {
								page = last_page;
								getData();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}"
							>{last_page || ''}
						</button>
						<button class="cursor-pointer rounded-lg grid place-items-center w-1/6">...</button>
						<button
							on:click={() => {
								page++;
								getData();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}">{current_page + 1 || ''}</button
						>
						<button class="cursor-pointer rounded-lg grid place-items-center w-1/6 bg-table--purple"
							>{current_page || ''}</button
						>
						<button
							on:click={() => {
								page--;
								getData();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page == 1
								? 'text-text--gray pointer-events-none'
								: ''}"><i class="fi fi-rr-angle-left" /></button
						>
					</div>
				</div>
			{/if}
		</div>
	</div>
{/if}

<style>
	.modal-container > div:nth-child(odd) {
		background-color: #393939;
	}
	.modal-container > div:nth-child(even) {
		background-color: #4c4c4c;
	}
</style>
