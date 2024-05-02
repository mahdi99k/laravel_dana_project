<script>
	import { slide } from 'svelte/transition';
	import { loading } from '../../main';
	export let showSecond;
	export let code = [];
	export let expireTime = '';
	export let nowTime = '';
	export let myBtnSecond;
	export let error;
	$: countDownDate = new Date(expireTime).getTime();
	$: now = new Date(nowTime).getTime();
	// $: now = new Date(nowTime).getTime();
	// $: shwoSecond;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	// let time = '';
	$: time = '';
	$: expired = false;
	//INPUTS
	function temp(node) {
		let myInput = node;
		const inputElements = myInput.querySelectorAll('input');

		inputElements.forEach((ele, index) => {
			ele.addEventListener('keydown', (e) => {
				if (e.keyCode === 8 && e.target.value === '') inputElements[Math.max(0, index - 1)].focus();
			});
			ele.addEventListener('input', (e) => {
				const [first, ...rest] = e.target.value;
				const lastInputBox = index === inputElements.length - 1;
				const didInsertContent = first !== undefined;
				if (didInsertContent && !lastInputBox) {
					// continue to input the rest of the string
					inputElements[index + 1].focus();
					inputElements[index + 1].value = rest.join('');
					inputElements[index + 1].dispatchEvent(new Event('input'));
				}
			});
		});
	}

	function timer() {
		// console.log('start');
		now = new Date().getTime();
		var distance = countDownDate - now;
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		if (!expired) {
			time = `${minutes}:${seconds} مانده تا ارسال مجدد کد `;
		}
		if (distance < 0) {
			clearInterval(x);
			expired = true;
			time = `دریافت مجدد کد از طریق پیامک`;
		}
	}
	var x = setInterval(timer, 1000);
	$: text_color = expired ? 'text-score--rang cursor-pointer' : 'text-text--gray';

	const sendAgain = () => {
		if (expired) {
			// loading(myBtnSecond);
			dispatch('sendAgain');
			expired = false;
			x = setInterval(timer, 1000);
			console.log('again');
		}
	};
	function sendCode() {
		code = code.join('');
		console.log(code);
		loading(myBtnSecond);
		dispatch('sendCode');
	}
	function btnLoading(node) {
		myBtnSecond = node;
	}
	const checkLen = () => {
		for(let i =0; i< code.length; i++){
			if(code[i] > 9) code[i] = Number(code[i].toString()[0])
		}
	};
</script>

{#if showSecond}
	<form
		class="flex flex-col w-full"
		in:slide={{ delay: 300, duration: 200 }}
		on:submit|preventDefault={() => {
			sendCode();
		}}
	>
		<img src="img/logo.svg" alt="logo" class="mb-5 w-28" />
		<h2 class="text-xl text-white">کد تایید را وارد کنید</h2>
		<div use:temp class="flex w-full justify-between mt-4 dir-ltr">
			<input
				type="number"
				bind:value={code[0]}
				on:input={checkLen}
				name="code"
				autofocus
				class="border-white border-2 text-3xl text-center bg-transparent rounded-xl h-full code-input w-1/5 aspect-square text-white focus:border-button--primary focus-visible:outline-none"
			/>
			<input
				type="number"
				bind:value={code[1]}
				on:input={checkLen}
				name="code"
				class="border-white border-2 text-3xl text-center bg-transparent rounded-xl h-full code-input w-1/5 aspect-square text-white focus:border-button--primary focus-visible:outline-none"
			/>
			<input
				type="number"
				bind:value={code[2]}
				on:input={checkLen}
				name="code"
				class="border-white border-2 text-3xl text-center bg-transparent rounded-xl h-full code-input w-1/5 aspect-square text-white focus:border-button--primary focus-visible:outline-none"
			/>
			<input
				type="number"
				bind:value={code[3]}
				maxlength="1"
				on:input={checkLen}
				name="code"
				class="border-white border-2 text-3xl text-center bg-transparent rounded-xl h-full code-input w-1/5 aspect-square text-white focus:border-button--primary focus-visible:outline-none"
			/>
		</div>
		<!-- <input type="text" bind:value={code} class="mt-5 input rounded-xl h-14 border-white bg-transparent focus:outline-none w-full text-sm text-white" placeholder="****"> -->
		<button type="button" class="{text_color} my-5" on:click={sendAgain}> {time} </button>
		{#if error != null}
			<span class="-text--error">{error}</span>
		{/if}
		<button type="submit" use:btnLoading class="bg--primary w-full mt-7 rounded-xl h-14 text-white"
			>ارسال کد</button
		>
	</form>
{/if}
