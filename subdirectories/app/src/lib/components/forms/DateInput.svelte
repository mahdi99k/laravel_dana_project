<script>
	import { onMount } from 'svelte';
	export let label = '';
	export let errorText = 'این فیلد اجباری می‌باشد';
	export let val = '';
	export let error = false;
	export let responsive = true;
	export let name;
	export let required = true;
	let classes = '';
	if (responsive) classes = 'lg:w-1/3 sm:w-1/2 w-full lg:p-5 sm:p-3 p-2';
	else classes = 'lg:w-1/2 w-full lg:p-5 p-2';
	onMount(() => {
		jalaliDatepicker.startWatch({
			maxDate: 'today',
			minDate: 'attr'
		});
	});
</script>

<div class={classes}>
	<div
		class="h-14 px-3 pt-2 pb-0 rounded-xl bg-table--item overflow-hidden border border-input--border relative"
	>
		<input
			type="text"
			data-jdp
			{name}
			data-jdp-min-date="1350/01/01"
			class="w-full bg-transparent h-full outline-none focus:border-none placeholder:text-white text-base"
			bind:value={val}
		/>
		<div class:active={val} class="flex items-center">
			{label}
			{#if required}
				<span class="-text--error ms-1 required-input">*</span>
			{/if}
		</div>
	</div>
</div>
{#if error}
	<p class="-text--error mt-2 ms-1">{errorText}</p>
{/if}

<style>
	.required {
		transform: translateY(-50%);
	}
	input + div {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		font-size: 16px;
		right: 20px;
		transition: 0.2s;
		pointer-events: none;
	}
	input:focus + div {
		color: #d8b4fe;
		font-size: 9px;
		top: 25%;
		right: 10px;
	}
	input:focus + div .required-input {
		display: none;
	}
	input + div.active {
		color: #d8b4fe;
		font-size: 9px;
		top: 25%;
		right: 10px;
	}
	input + div.active .required-input {
		display: none;
	}
</style>
