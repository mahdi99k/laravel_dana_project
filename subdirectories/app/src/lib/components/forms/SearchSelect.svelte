<script>
	import { fade, slide, fly } from 'svelte/transition';
	import { createEventDispatcher } from 'svelte';
	import { loading } from '../../main';
	export let object = false;
	let dispatch = createEventDispatcher();
	let element, angle, searchInput;
	export let data, label, selected;
	export let title;
	export let search = true;
	export let all = true;
	export let multi = false;
	export let required = true;
	export let showLabel = true;
	export const not_select = true;
	const allData = data;
	$: arr = data.filter((data) => true);
	$: active = false;
	$: filterData = [];
	let classes = '';
	export let responsive = false;
	if (responsive) {
		classes = 'border border-input--border';
	}
	function angleDown(node) {
		angle = node;
	}
	const showContent = () => {
		// angle.style.transform = "rotate(180deg)";
		active = !active;
	};
	const searchInputFilter = () => {
		arr = data.filter((data) => {
			if (object) {
				if (searchInput) return data.name.toLowerCase().startsWith(searchInput);
			} else {
				if (searchInput) return data.toLowerCase().startsWith(searchInput);
			}
			return true;
		});
	};
	// title = label == null ? title : label;
	const updateName = (el, type = true, val = null) => {
		switch (el.target.innerHTML) {
			case 'همه':
				selected = '';
				break;
			case 'کارشناسی و بالاتر':
				selected = 'bachelor';
				break;
			case 'کارشناسی ارشد و بالاتر':
				selected = 'master';
				break;
			case 'دکتری و بالاتر':
				selected = 'doctor';
				break;
			case 'انتخاب نشده':
				selected = null;
				break;
			default:
				if (type) {
					selected = el.target.innerHTML;
				} else {
					selected = '';
				}
		}
		if (multi) selected = [el.target.innerHTML, val];
		if (object) selected = { name: el.target.innerHTML, id: val };
		if (el.target.innerHTML != 'همه') {
			title = el.target.innerHTML;
		} else {
			title = label;
		}
		active = !active;
		dispatch('select', selected);
	};
	function selectCustom(node) {
		element = node;
		const customSelect = element,
			customSelect_selectBtn = customSelect.querySelector('.select-btn'),
			customSelect_searchInputInp = customSelect.querySelector('input'),
			customSelect_options = customSelect.querySelector('.options'),
			customSelect_content = customSelect.querySelector('.content');

		window.addEventListener('click', (event) => {
			if (
				![
					customSelect,
					customSelect_selectBtn,
					customSelect_searchInputInp,
					customSelect_content
				].includes(event.target)
			) {
				active = false;
			}
		});
	}
</script>

<div
	use:selectCustom
	class="custom-select {responsive ? 'lg:p-5 sm:p-3 p-2 lg:w-1/3 sm:w-1/2 w-full' : 'w-full p-2'}"
	class:active
>
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<!-- svelte-ignore a11y-no-static-element-interactions -->
	<div
		class="select-btn h-14 px-3 py-2 rounded-xl bg-table--item flex justify-between items-center cursor-pointer relative {classes}"
		on:click={showContent}
	>
		{#if title}
			<span
				transition:fly={{ x: 10, duration: 200 }}
				class="labelBefore absolute -text--purple top-1 right-2">{label}</span
			>
		{/if}
		<div class="text-sm flex items-center">
			<span>{title || label}</span>
			{#if required && !selected && !title}
				<span class="-text--error ms-1">*</span>
			{/if}
		</div>
		<i use:angleDown class="text-xs fi fi-rr-angle-down" />
	</div>
	<div
		class="content absolute p-3 mt-5 bg-table--item2 rounded-xl w-full {active
			? 'opacity-100'
			: 'opacity-0 pointer-events-none'}"
		transition:slide={{ duration: 200 }}
	>
		{#if search}
			<div class="searchInput">
				<i class="uil uil-searchInput" />
				<input
					class=" border border-input--border bg-table--title rounded-xl w-full h-12 focus:border-white outline-none p-3 text-sm"
					spellcheck="false"
					bind:value={searchInput}
					on:keyup={searchInputFilter}
					type="text"
					placeholder="جستجو"
				/>
			</div>
		{/if}
		<ul class="options mt-3 purple-scrollbar">
			{#if data.length > 0}
				{#if arr.length == 0}
					<p>چیزی پیدا نکردیم :/</p>
				{:else}
					{#if showLabel}
						<!-- svelte-ignore a11y-click-events-have-key-events -->
						<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
						<!-- <li
							on:click={(event) => updateName(event, false)}
							class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
						>
							{label == null ? title : label}
						</li> -->
					{/if}
					<!-- svelte-ignore a11y-click-events-have-key-events -->
					<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
					{#if not_select}
						<li
							on:click={(event) => updateName(event)}
							class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
						>
							انتخاب نشده
						</li>
					{/if}
					{#if all}
						<li
							on:click={(event) => updateName(event)}
							class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
						>
							همه
						</li>
					{/if}
					<!-- {#if title} -->
					<!-- svelte-ignore a11y-click-events-have-key-events -->
					<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
					<!-- {/if} -->
					{#each arr as d, index}
						{#if d !== 'all'}
							<!-- svelte-ignore a11y-click-events-have-key-events -->
							<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
							{#if multi}
								<li
									on:click={(event) => updateName(event, false, d[1])}
									class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
								>
									{d[0]}
								</li>
							{:else if object}
								<li
									on:click={(event) => updateName(event, false, d.id)}
									class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
								>
									{d.name}
								</li>
							{:else}
								<li
									on:click={(event) => updateName(event)}
									class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
								>
									{d}
								</li>
							{/if}
						{/if}
					{/each}
				{/if}
			{:else}
				<div class="text-center w-full">
					<span class="loading loading-dots loading-lg" />
				</div>
			{/if}
		</ul>
	</div>
</div>

<style>
	/* Custom Select */

	.custom-select .select-btn * {
		pointer-events: none;
	}
	.custom-select .select-btn i {
		transform: rotate(0);
		transition: transform 0.1s ease-in;
	}
	.custom-select.active .select-btn i {
		transform: rotate(180deg);
		transition: transform 0.1s ease-in;
	}
	.custom-select .content {
		min-width: 300px;
		z-index: 99;
		transition: opacity 0.2s ease-in-out;
	}
	.custom-select .content .searchInput input::placeholder {
		color: #bfbfbf;
	}
	.custom-select .content .options {
		max-height: 186px;
		overflow-y: auto;
	}

	.labelBefore {
		font-size: 9px;
	}
	@media screen and (max-width: 1024px) {
		.custom-select {
			position: static;
		}
		.custom-select .content {
			bottom: 0;
			left: 0;
			width: 100vw;
			z-index: 50;
			position: fixed;
			padding: 30px;
		}
	}

	@media screen and (min-width: 1024px) {
		.custom-select {
			position: relative;
		}
		.custom-select .content {
			bottom: unset;
			top: 56px;
			left: 50%;
			transform: translateX(-50%);
		}
	}
</style>
