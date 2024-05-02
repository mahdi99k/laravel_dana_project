<script>
	import Input from '../../forms/Input.svelte';
	import SearchSelect from '../../forms/SearchSelect.svelte';
	import { fade } from 'svelte/transition';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../main';
	import MultiSelect from '../../forms/MultiSelect.svelte';
	export let showContactAdd = false;
	let phone, telephone, email, province, city, postal, address, emergency;
	export let USER;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	let error = false;
	function createBtn(node) {
		myBtn = node;
	}
	phone = USER.phone;
	telephone = USER.about.telephone;
	email = USER.email;
	province = USER.about.province;
	city = USER.more.city;
	postal = USER.more.postal;
	address = USER.more.address;
	emergency = USER.more.emergency;
	$: ableClose = false;
	let step = 1;
	let data = [];
	let label = 'استان و شهر محل سکونت';
	let provinces = [];
	let numbers = /^[0-9]+$/;
	$: steps = {
		1: {
			name: 'province',
			data: []
		},
		2: {
			name: 'city',
			data: []
		}
	};
	const handleClickSave = async () => {
		// error = false;
		if (phone == emergency || telephone == emergency) {
			error = 'شماره تلفن اضطراری نباید شماره همراه خودتان یا تلفن منزل باشد.';
		}
		if (!error) {
			loading(myBtn);
			const api_token = getCookie('api_token');
			// let formData = new FormData(e.target);
			let params = { telephone, email, province, city, postal, address, emergency };
			await axios
				.post(`${API_URL}/updateUser`, params, {
					headers: { Authorization: `Bearer ${api_token}` }
				})
				.then(function (response) {
					USER = response.data.data;
				});
			ableClose = false;
			step = 1;
			data = steps[1].data;
			dispatch('handleClick');
		}
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//PROVINCES

	async function getProvinces() {
		await axios.get(`${API_URL}/getProvinces`).then(function (response) {
			console.log(response);
			data = response.data.data;
			steps[step].data = data;
		});
	}
	getProvinces();
	const getCities = async (detail) => {
		console.log(detail, 'der');
		data = [];
		await axios.get(`${API_URL}/getCities/${detail.id}`).then(function (response) {
			data = response.data.data;
			steps[step].data = data;
			province = detail.name;
		});
	};
	async function getData(detail) {
		console.log(step);
		if (step == 1) await getCities(detail);
		else if (step == 2) {
			city = detail.name;
		}
	}
</script>

{#if showContactAdd}
	<div in:fade={{ duration: 200, delay: 200 }} out:fade={{ duration: 200 }}>
		<div class="flex flex-wrap pb-20">
			<!-- <Input required={false} responsive={true} label="تلفن همراه" bind:val={phone}/> -->
			<Input
				required={false}
				number={true}
				length="8"
				max="8"
				responsive={true}
				label="تلفن منزل"
				bind:val={telephone}
				bind:error
			/>
			<Input
				required={false}
				number={true}
				max="11"
				length="11"
				responsive={true}
				label="شماره همراه اضطراری"
				bind:val={emergency}
			/>
			<MultiSelect
				required={false}
				{data}
				{label}
				on:select={({ detail }) => getData(detail)}
				bind:ableClose
				responsive={true}
				bind:step
				endStep="2"
				bind:steps
			/>
			<Input
				required={false}
				email={true}
				bind:error
				responsive={true}
				label="ایمیل"
				bind:val={email}
			/>
			<Input
				required={false}
				persian={true}
				responsive={true}
				label="آدرس"
				bind:val={address}
			/>
			<Input
				required={false}
				responsive={true}
				number={true}
				length="10"
				label="کد پستی"
				bind:val={postal}
				max="10"
				bind:error
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
