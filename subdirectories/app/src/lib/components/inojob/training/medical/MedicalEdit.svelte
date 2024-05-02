<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let score;
	let isUploading = false;
	let error = false;
	let type = score.attributes.filter,
		major = score.attributes.data.major,
		year = score.attributes.data.year,
		rank = score.attributes.data.rank,
		description = score.attributes.data.description;
	let types = [
		['آزمون‌های جامع علوم پایه', '1'],
		['آزمون پیش کارورزی پزشکی', '2'],
		['آزمون پذیرش دستیاری (رشته های پزشکی)', '3']
	];
	let types2 = {
		'1': 'آزمون‌های جامع علوم پایه',
		'2': 'آزمون پیش کارورزی پزشکی',
		'3': 'آزمون پذیرش دستیاری (رشته های پزشکی)'
	};
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
			.post(`${API_URL}/updateScore/${score.id}`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				dispatch('handleClick', response.data.data);
				type = '';
				major = '';
				year = '';
				rank = '';
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClickCancel');
	};
	const changeType = (detail) => {
		console.log(detail);
		type = detail[1];
	};
	let file1 = score.attributes.file1;
</script>

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
			title={types2[type]}
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
			title={major}
			all={false}
			responsive={true}
			label="رشته"
		/>
		<SearchSelect
			label="سال"
			title={year}
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
			title={rank}
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
				status={100}
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
