<script>
	import { slide } from 'svelte/transition';
	import { loading } from '../../main';
	export let showThird;
	export let first_name = '';
	export let last_name = '';
	export let melli_code = '';
	export let myBtnThird;
	export let error;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();

	function sendName() {
		loading(myBtnThird);
		if (first_name == '' || last_name == '' || melli_code == '') {
			error = 'لطفا همه فیلد ها را کامل کنید';
			return;
		}
		if (melli_code.length != 10) {
			error = 'کدملی خودرا به درستی وارد کنید';
			return;
		}
		dispatch('sendName');
	}
	function btnLoading(node) {
		myBtnThird = node;
	}
	const letters = /^[\u0600-\u06FF\s]+$/;
	let numbers = /^[\u06F0-\u06F90-9]+$/;
	const checkLetter = () => {
		if (!letters.test(first_name)) first_name = first_name.substring(0, first_name.length - 1);
		if (!letters.test(last_name)) last_name = last_name.substring(0, last_name.length - 1);
		if (!numbers.test(melli_code)) melli_code = melli_code.substring(0, melli_code.length - 1);
	};
</script>

{#if showThird}
	<form
		class="flex flex-col w-full"
		transition:slide={{ duration: 300 }}
		on:submit|preventDefault={() => {
			sendName();
		}}
	>
		<img src="img/logo.svg" alt="logo" class="mb-5 w-28" />
		<h2 class="text-xl text-white">ثبت نام</h2>
		<span class="text-text--gray my-5">مشخصات خود را وارد کنید تا شمارا بیشتر بشناسیم</span>
		<span class="text-base text-white mb-3">نام و نام‌خانوادگی</span>
		<div class="flex justify-between mb-2">
			<div class="w-1/2 pe-2">
				<input
					type="text"
					on:keyup={checkLetter}
					bind:value={first_name}
					class="input rounded-xl h-14 border-white bg-transparent focus:outline-none w-full text-sm text-white"
					placeholder="نام:"
				/>
			</div>
			<div class="w-1/2 ps-2">
				<input
					type="text"
					on:keyup={checkLetter}
					bind:value={last_name}
					class="input rounded-xl h-14 border-white bg-transparent focus:outline-none w-full text-sm text-white"
					placeholder="نام خانوادگی:"
				/>
			</div>
		</div>
		<span class="text-base text-white mb-3 mt-5">کدملی</span>
		<input
			type="text"
			on:keyup={checkLetter}
			bind:value={melli_code}
			class="input rounded-xl h-14 border-white bg-transparent focus:outline-none w-full text-sm text-white"
			placeholder="برای مثال: *****01125"
		/>
		{#if error != null}
			<span class="-text--error">{error}</span>
		{/if}
		<button use:btnLoading class="bg--primary w-full mt-7 rounded-xl h-14 text-white">تایید</button>
	</form>
{/if}
