<script>
	import Input from '../../forms/Input.svelte';
	import SearchSelect from '../../forms/SearchSelect.svelte';
	import MultiSelect from '../../forms/MultiSelect.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../main';
	import { fade } from 'svelte/transition';
	export let showPersonalAdd = false;
	export let USER;
	let first_name,
		last_name,
		father,
		gender,
		birthday,
		melli_code,
		melli_city,
		marital,
		nationality,
		military,
		latin_fName,
		latin_lName,
		melli_number,
		birth_country,
		birth_province,
		birth_city,
		disability,
		showGender;
	let melli_serial = [];
	let error = '';
	import { afterUpdate, createEventDispatcher } from 'svelte';
	import DateInput from '../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}
	first_name = USER.first_name;
	last_name = USER.last_name;
	father = USER.about.father;
	gender = USER.about.gender;
	birthday = USER.birthday;
	melli_city = USER.melli.city;
	melli_code = USER.melli.code;
	melli_number = USER.melli.number;
	melli_serial = USER.melli.serial == null ? [] : USER.melli.serial.split('-');
	marital = USER.about.marital;
	military = USER.about.military;
	nationality = USER.more.nationality;
	latin_fName = USER.more.latin_fName;
	latin_lName = USER.more.latin_lName;
	birth_country = USER.more.birth_country || '';
	birth_province = USER.more.birth_province;
	birth_city = USER.more.birth_city;
	disability = USER.more.disability;
	$: ableClose = false;
	$: ableClose2 = false;
	let step = 1;
	let step2 = 1;
	let data = [];
	let data2 = [];
	let provinces = [];
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
	$: steps2 = {
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
		// if (melli_code) {
		// 	if ((melli_code.length != 10 || !melli_code.match(numbers)) && melli_code != '') {
		// 		error = 'کدملی خود را به درستی وارد کنید';
		// 		return;
		// 	}
		// }
		// if (melli_serial) {
		// 	if (melli_serial.length != 6 && melli_serial != '') {
		// 		error = 'سریال شناسنامه خود را ربه درستی وارد کنید.';
		// 		return;
		// 	}
		// }
		console.log(error);
		if (!error || error == '') {
			loading(myBtn);
			const api_token = getCookie('api_token');
			// let formData = new FormData(e.target);
			let params = {
				first_name,
				last_name,
				father,
				gender,
				birthday,
				melli_code,
				melli_city,
				melli_serial: melli_serial.join('-'),
				marital,
				nationality,
				military,
				latin_fName,
				latin_lName,
				melli_number,
				birth_city,
				birth_province,
				birth_country,
				disability
			};
			await axios
				.post(`${API_URL}/updateUser`, params, {
					headers: { Authorization: `Bearer ${api_token}` }
				})
				.then(function (response) {
					USER = response.data.data;
				})
				.catch((err) => {
					console.log(err);
				});
			ableClose = false;
			step = 1;
			data = steps[1].data;
			ableClose2 = false;
			step2 = 1;
			data2 = steps2[1].data;
			dispatch('handleClick');
		}
	};
	const handleClickCancel = () => {
		ableClose = false;
		step = 1;
		data = steps[1].data;
		dispatch('handleClick');
	};

	async function getProvinces() {
		await axios.get(`${API_URL}/getProvinces`).then(function (response) {
			data = response.data.data;
			data2 = response.data.data;
			steps[step].data = data;
			steps2[step].data = data2;
		});
	}
	getProvinces();
	const getCities = async (detail) => {
		console.log(detail, 'der');
		data = [];
		await axios.get(`${API_URL}/getCities/${detail.id}`).then(function (response) {
			data = response.data.data;
			steps[step].data = data;
		});
	};
	async function getData(detail) {
		console.log(step);
		if (step == 1) await getCities(detail);
		else if (step == 2) {
			melli_city = detail.name;
		}
	}
	const getCities2 = async (detail) => {
		data2 = [];
		birth_province = detail.name;
		await axios.get(`${API_URL}/getCities/${detail.id}`).then(function (response) {
			data2 = response.data.data;
			steps2[step].data = data2;
		});
	};
	async function getData2(detail) {
		if (step2 == 1) await getCities2(detail);
		else if (step2 == 2) {
			birth_city = detail.name;
		}
	}
	let countries = [];
	const getCountries = async () => {
		await axios.get(`${API_URL}/getCountries`).then(function (response) {
			countries = response.data.data;
		});
	};
	getCountries();
</script>

{#if showPersonalAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<Input
				required={false}
				responsive={true}
				label="نام"
				bind:val={first_name}
				ableKey={true}
				persian={true}
			/>
			<Input
				required={false}
				responsive={true}
				label="نام خانوادگی"
				bind:val={last_name}
				persian={true}
			/>
			<Input
				required={false}
				responsive={true}
				label="نام لاتین"
				bind:val={latin_fName}
				ableKey={true}
				english={true}
			/>
			<Input
				required={false}
				responsive={true}
				label="نام خانوادگی لاتین"
				bind:val={latin_lName}
				english={true}
			/>
			<Input
				required={false}
				responsive={true}
				label="نام پدر"
				bind:val={father}
				persian={true}
			/>
			<Input
				required={false}
				responsive={true}
				type="number"
				label="کد ملی"
				bind:error
				length="10"
				max="10"
				number={true}
				bind:val={melli_code}
			/>
			<Input
				required={false}
				responsive={true}
				type="number"
				label="شماره شناسنامه"
				number={true}
				bind:val={melli_number}
			/>
			<div class="flex lg:w-4/12 w-ful lg:p-5 sm:p-3 p-2l">
				<div class="w-6/12">
					<Input
						classes="w-full px-1"
						required={false}
						responsive={false}
						label="سریال شناسنامه"
						bind:val={melli_serial[2]}
						max="6"
						number={true}
					/>
				</div>
				<div class="w-3/12">
					<Input
						classes="w-full px-1"
						required={false}
						responsive={false}
						label="مثال: ب"
						labelSize="10px"
						bind:val={melli_serial[1]}
						persian={true}
						max="1"
					/>
				</div>
				<div class="w-3/12">
					<Input
						classes="w-full px-1"
						required={false}
						responsive={false}
						label="مثال: 12"
						bind:val={melli_serial[0]}
						number={true}
						max="2"
					/>
				</div>
			</div>

			<!-- <Input required={false}  responsive={true} label="تاریخ تولد: 1402/01/01" bind:val={birthday}/> -->
			<DateInput bind:val={birthday} label="تاریخ تولد" responsive={true} required={false} />

			<SearchSelect
				required={false}
				on:select={({ detail }) => {
					gender = detail[1];
					showGender = detail[0];
				}}
				data={[
					['مرد', 1],
					['زن', 2]
				]}
				multi={true}
				search={false}
				all={false}
				responsive={true}
				title={showGender}
				label="جنسیت"
			/>
			{#if gender == 1 || gender == null}
				<SearchSelect
					required={false}
					on:select={({ detail }) => {
						military = detail;
					}}
					data={[
						'معافیت تحصیلی',
						'مشمول سربازی (به غیر از معافیت تحصیلی)',
						'در حال خدمت',
						'پایان خدمت',
						'معافیت دائم'
					]}
					search={false}
					all={false}
					responsive={true}
					title={military}
					label="وضعیت سربازی"
				/>
			{/if}
			<MultiSelect
				required={false}
				title={USER.melli_city}
				{data}
				label="محل صدور شناسنامه"
				on:select={({ detail }) => getData(detail)}
				bind:ableClose
				responsive={true}
				bind:step
				endStep="2"
				bind:steps
			/>
			<SearchSelect
				on:select={({ detail }) => {
					nationality = detail.name;
				}}
				data={countries}
				all={false}
				label="تابعیت"
				responsive={true}
				object={true}
				required={false}
			/>
			<SearchSelect
				required={false}
				on:select={({ detail }) => {
					marital = detail;
				}}
				data={['مجرد', 'متاهل']}
				search={false}
				all={false}
				responsive={true}
				title={marital}
				label="وضعیت تاهل"
			/>
			<SearchSelect
				required={false}
				on:select={({ detail }) => {
					disability = detail.id;
				}}
				data={[
					{ name: 'بله', id: true },
					{ name: 'خیر', id: false }
				]}
				object={true}
				search={false}
				all={false}
				responsive={true}
				title={disability ? 'بله' : disability == false ? 'خیر' : null}
				label="معلولیت"
			/>
			<SearchSelect
				on:select={({ detail }) => {
					birth_country = detail.name;
				}}
				data={countries}
				all={false}
				label="کشور محل تولد"
				responsive={true}
				object={true}
				required={false}
			/>
			{#if birth_country}
				{#if birth_country.includes('ایران')}
					<MultiSelect
						required={false}
						title={USER.birth_city}
						data={data2}
						label="استان و شهر محل تولد"
						on:select={({ detail }) => getData2(detail)}
						bind:ableClose={ableClose2}
						responsive={true}
						bind:step={step2}
						endStep="2"
						bind:steps={steps2}
					/>
				{:else}
					<Input
						required={false}
						responsive={true}
						type="text"
						label="استان محل تولد"
						bind:val={birth_province}
					/>
					<Input
						required={false}
						responsive={true}
						type="text"
						label="شهر محل تولد"
						bind:val={birth_city}
					/>
				{/if}
			{/if}
		</div>
		{#if error}
			<p class="-text--error">{error}</p>
		{/if}
		<div class="flex items-center ms-auto lg:w-5/12 sm:w-8/12 w-full">
			<div class="w-1/2 px-4">
				<button
					type="button"
					class="rounded-xl block w-full border border-button--primary text-lg h-14 text-white"
					on:click={handleClickCancel}>انصراف</button
				>
			</div>
			<div class="w-1/2 px-4">
				<button
					type="submit"
					class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
					use:createBtn>ذخیره</button
				>
			</div>
		</div>
	</form>
{/if}
