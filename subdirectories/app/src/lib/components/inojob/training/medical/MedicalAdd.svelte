<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showMedicalAdd;
	export let scores;
	export let updated = false;
	let isUploading = false;
	let error = false;
	let type, major, year, rank, description;
	let types = [
		['آزمون‌های جامع علوم پایه', '1'],
		['آزمون پیش کارورزی پزشکی', '2'],
		['آزمون پذیرش دستیاری (رشته های پزشکی)', '3']
	];
	let ranks = [
		'رتبه اول',
		'رتبه دوم',
		'رتبه سوم',
		'رتبه چهارم',
		'رتبه پنجم',
		'رتبه ششم',
		'رتبه هفتم',
		'رتبه هشتم',
		'رتبه نهم',
		'رتبه دهم'
	];
	import { createEventDispatcher } from 'svelte';
	import SearchModal from '../../../modals/SearchModal.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}
	const handleClickSave = async () => {
		error = false;
		if (!type || !major || !year || !rank) {
			error = 'لطفا همه فیلدها را پر کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (!file1) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		loading(myBtn);
		const api_token = getCookie('api_token');

		let data = { major, year, rank, description };
		let params = {
			filter: type,
			cert: 'training',
			type: 'medical',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = [response.data.data, ...scores];
				dispatch('handleClick');
				type = '';
				major = '';
				year = '';
				rank = '';
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};
	const changeType = (detail) => {
		console.log(detail);
		type = detail[1];
	};

	//SEND FILE
	let file1 = false;
</script>

{#if showMedicalAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchSelect
				on:select={({ detail }) => {
					changeType(detail);
				}}
				data={types}
				multi={true}
				search={false}
				all={false}
				responsive={true}
				label="نوع آزمون"
			/>
			<SearchSelect
				on:select={({ detail }) => (major = detail)}
				data={['پزشکی', 'دندان پزشکی', 'داروسازی']}
				search={true}
				all={false}
				responsive={true}
				label="رشته"
			/>
			<SearchSelect
				label="سال"
				on:select={({ detail }) => (year = detail)}
				required={true}
				responsive={true}
				search={true}
				all={false}
				data={YEARS}
			/>
			<SearchSelect
				on:select={({ detail }) => (rank = detail)}
				data={ranks}
				search={false}
				all={false}
				responsive={true}
				label="رتبه"
			/>
			<Input required={false} bind:val={description} label="توضیحات" />
			<div class="w-full px-2 mb-4">
				<FileInput
					name="invention_file"
					bind:isUploading
					label="فایل مورد نظرتان را آپلود کنید"
					size={500}
					url="/scoreUpload"
					sizeLabel="کیلوبایت"
					type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
					on:send={({ detail }) => {
						file1 = detail;
					}}
				/>
			</div>
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
