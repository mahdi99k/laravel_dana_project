<script>
	import Input from '../../forms/Input.svelte';
	import { fade } from 'svelte/transition';
	import { getCookie, API_URL, loading } from '../../../main';
	import axios from 'axios';
	export let showJobAdd = false;
	export let USER;
	let job_title, job_company, job_phone, job_address, job_contract;
	let error = false;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}

	job_title = USER.job.title;
	job_company = USER.job.company;
	job_phone = USER.job.phone;
	job_address = USER.job.address;
	job_contract = USER.job.contract;
	const handleClickSave = async () => {
		if (error) return;
		loading(myBtn);
		const api_token = getCookie('api_token');
		// let formData = new FormData(e.target);
		let params = { job_company, job_title, job_phone, job_address, job_contract };
		await axios
			.post(`${API_URL}/updateUser`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				// console.log(response);
				USER = response.data.data;
			});
		dispatch('handleClick');
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};
</script>

{#if showJobAdd}
	<div in:fade={{ duration: 200, delay: 200 }} out:fade={{ duration: 200 }}>
		<div class="flex flex-wrap pb-20">
			<Input required={false} responsive={true} label="عنوان شغل" bind:val={job_title} />
			<Input required={false} responsive={true} label="نوع قرارداد" bind:val={job_contract} />
			<Input
				required={false}
				responsive={true}
				label="عنوان محل کار"
				bind:val={job_company}
			/>
			<Input required={false} responsive={true} label="آدرس محل کار" bind:val={job_address} />
			<Input
				required={false}
				number={true}
				max="11"
				length="11"
				bind:error
				responsive={true}
				label="تلفن محل کار"
				bind:val={job_phone}
			/>
		</div>
		{#if error}
			<p class="-text--error">{error}</p>
		{/if}
		<div class="flex items-center ms-auto lg:w-5/12 sm:w-8/12 w-full">
			<div class="w-1/2 px-4">
				<button
					class="rounded-xl block w-full border border-button--primary text-lg h-14 text-white"
					on:click={handleClickCancel}>انصراف</button
				>
			</div>
			<div class="w-1/2 px-4">
				<button
					class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
					use:createBtn
					on:click={handleClickSave}>ذخیره</button
				>
			</div>
		</div>
	</div>
{/if}
