<script>
	import { fade, slide } from 'svelte/transition';
	import { createEventDispatcher } from 'svelte';
	import { loading } from '../../main';
	import { backIn } from 'svelte/easing';
	let dispatch = createEventDispatcher();
	let element, angle, searchInput;
	export let data, label, selected;
	export let title;
	export let search = true;
	export let all = true;
	export let required = true;
	export let ableClose = false;
	const allData = data;
	$: arr = data.filter((data) => true);
	export let active = false;
	export let steps;
	export let step = 1;
	$: filterData = [];
	export let endStep;
	$: step = 1;
	let classes = '';
	console.log('ac', active, label);
	export let responsive = false;
	console.log('rrrrrrrrrrrrrr', title);
	let titles = [];
	if (responsive) {
		classes = 'border border-input--border';
	}
	function angleDown(node) {
		angle = node;
	}
	const showContent = () => {
		// angle.style.transform = "rotate(180deg)";
		titles = [];
		// title = label;
		step = 1;
		data = steps[step].data;
		active = !active;
		ableClose = false;
	};
	const searchInputFilter = () => {
		arr = data.filter((data) => {
			if (searchInput) return data.name.toLowerCase().startsWith(searchInput);
			return true;
		});
	};

	const updateName = (id, val, type) => {
		selected = {
			id: id,
			name: val,
			type,
			type
		};
		titles = [...titles, val];
		title = titles.join('-');
		dispatch('select', selected);
		step++;
		console.log(step, 'se', endStep);
		if (step == Number(endStep) + 1) ableClose = true;
	};
	function selectCustom(node) {
		element = node;
		const customSelect = element,
			customSelect_selectBtn = customSelect.querySelector('.select-btn'),
			customSelect_searchInputInp = customSelect.querySelector('input'),
			customSelect_options = customSelect.querySelector('.options'),
			customSelect_optionsLi = customSelect.querySelectorAll('.options li'),
			customSelect_content = customSelect.querySelector('.content');

		window.addEventListener('click', (event) => {
			if (
				![
					customSelect,
					customSelect_selectBtn,
					customSelect_searchInputInp,
					customSelect_options,
					customSelect_content
				].includes(event.target) &&
				ableClose
			) {
				active = false;
			}
		});
	}

	const back = () => {
		console.log('re');
		step--;
		titles.pop();
		console.log(data, 'ww');
		data = steps[step].data;
		title = titles.join(' - ');
		console.log(steps, 'ss', step);
		console.log(titles, 'titles');
		dispatch('back');
	};
</script>

<div
	use:selectCustom
	class="custom-select relative {responsive
		? 'lg:p-5 sm:p-3 p-2 lg:w-1/3 sm:w-1/2 w-full'
		: 'w-full'}"
	class:active
>
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<!-- svelte-ignore a11y-no-static-element-interactions -->
	<div
		class="select-btn h-14 px-3 py-2 rounded-xl bg-table--item flex justify-between items-center cursor-pointer {classes}"
		on:click={showContent}
	>
		<div class="text-sm flex items-center">
			<span>
				{#if !title}
					{step == 1 ? label : step == Number(endStep) + 1 ? title : `${step} از ${endStep}`}
				{:else}
					{title}
				{/if}</span
			>
			{#if required && !selected && !title}
				<span class="-text--error ms-1">*</span>
			{/if}
		</div>
		<i use:angleDown class="text-xs fi fi-rr-angle-down" />
	</div>
	<div
		class="content absolute right-1/2 translate-x-1/2 top-14 p-3 mt-5 bg-table--item2 rounded-xl w-full {active
			? 'opacity-100'
			: 'opacity-0 pointer-events-none'}"
		transition:fade={{ duration: 200 }}
	>
		{#if step > 1}
			<div class="flex p-2 my-2 rounded-lg items-center">
				<button class="me-1 bg-table--item2 rounded-lg p-1" on:click={back}>
					<i class="fi fi-rr-arrow-right" />
				</button>
				<div class="-text--purple text-sm">
					{title}
				</div>
			</div>
		{/if}
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
		<ul class="options mt-3 purple-scrollbar" transition:slide={{ duration: 200 }}>
			{#if data.length > 0}
				{#if arr.length == 0}
					<p>چیزی پیدا نکردیم :/</p>
				{:else}
					<!-- svelte-ignore a11y-click-events-have-key-events -->
					<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
					{#if all}
						<!-- <li on:click={event=> updateName(event) } class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl">همه</li> -->
					{/if}
					{#if title}
						<!-- svelte-ignore a11y-click-events-have-key-events -->
						<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
						<!-- <li on:click={event=> updateName(event , false) } class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl">{title}</li> -->
					{/if}
					{#each arr as d, index}
						{#if d !== 'all'}
							<!-- svelte-ignore a11y-click-events-have-key-events -->
							<!-- svelte-ignore a11y-no-noninteractive-element-interactions -->
							<li
								on:click={(event) => updateName(d.id, d.name, d.type)}
								transition:slide={{ duration: 200 }}
								class="flex items-center cursor-pointer h-12 p-3 text-sm hover:bg-base--gray rounded-xl"
							>
								{d.name}
							</li>
						{/if}
					{/each}
				{/if}
			{:else}
				<div class="text-center w-full"><span class="loading loading-dots loading-lg" /></div>
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
</style>
