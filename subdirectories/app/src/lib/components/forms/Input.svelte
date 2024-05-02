<script>
	export let label = '';
	export let errorText = 'این فیلد اجباری می‌باشد';
	export let val = '';
	export let error = false;
	export let responsive = true;
	export let name;
	export let required = true;
	export let persian = false;
	export let number = false;
	export let max;
	export let length;
	export let classes;
	export let english;
	export let email;
	export let labelSize = '16px';
	if (!classes) classes = 'lg:w-1/2 w-full lg:p-5 p-2';
	if (responsive) classes = 'lg:w-1/3 sm:w-1/2 w-full lg:p-5 sm:p-3 p-2';
	const letters = /^[\u0600-\u06FF\s]+$/;
	// const letters =/[آ-ی۰-۹\+\-,،\s]/;
	let numbers = /^[\u06F0-\u06F90-9]+$/;
	let englishLetter = /[a-zA-Z]/;
	const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	const checkPersian = () => {
		if (persian) {
			if (!letters.test(val)) val = val.substring(0, val.length - 1);
		} else if (number) {
			if (!numbers.test(val)) val = val.substring(0, val.length - 1);
		} else if (english) {
			if (!englishLetter.test(val)) val = val.substring(0, val.length - 1);
		} else if (email) {
			if (!emailRegex.test(val)) error = `ایمیل خود را به درستی وارد کنید \n`;
			else error = false;
		}
		if (max) {
			if (val.length > max) val = val.substring(0, max);
		}
		if (length) {
			if (val.length != length) error = `${label} را به درستی وارد کنید \n`;
			else error = false;
		}
		if (val.length == 0) error = false;
	};
</script>

<div class={classes}>
	<div
		class="h-14 px-3 pt-2 pb-0 rounded-xl bg-table--item overflow-hidden border border-input--border relative"
	>
		<input
			on:keyup={checkPersian}
			type="text"
			class="w-full bg-transparent h-full outline-none focus:border-none placeholder:text-white text-base"
			bind:value={val}
		/>
		<div class:active={val} class="flex items-center" style="--labelSize:{labelSize}">
			{label}
			{#if required}
				<span class="-text--error ms-1 required-input">*</span>
			{/if}
		</div>
	</div>
</div>

<!-- {#if error}
	<p class="-text--error mt-2 ms-1">{errorText}</p>
{/if} -->

<style>
	:root {
		--labelSize: '16px';
	}
	.required {
		transform: translateY(-50%);
	}
	input + div {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		font-size: var(--labelSize);
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
