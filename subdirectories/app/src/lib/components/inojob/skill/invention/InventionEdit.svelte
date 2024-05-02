<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, closeLoading, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let updated = false;
	let isUploading = false;
	let error = false;
	export let score;
	let title = score.attributes.data.title,
		level = score.attributes.data.level,
		number = score.attributes.data.number,
		patent_data = score.attributes.data.patent_data,
		year = score.attributes.data.year,
		participation = score.attributes.data.participation;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (!title || !level || !number || !patent_data || !year || !participation) {
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
		let data = {
			title,
			level,
			number,
			patent_data,
			year,
			participation
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'skill',
			type: 'invention',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/updateScore/${score.id}`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				dispatch('handleClick', response.data.data);
				title = '';
				level = '';
				number = '';
				patent_data = '';
				year = '';
				participation = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClickCancel');
	};

	let file1 = score.attributes.file1;
</script>

<form
	on:submit|preventDefault={handleClickSave}
	in:fade={{ duration: 200, delay: 200 }}
	out:fade={{ duration: 200 }}
>
	<div class="flex flex-wrap pb-20">
		<Input bind:val={title} label="عنوان اختراع" />
		<SearchSelect
			on:select={({ detail }) => (level = detail)}
			data={['سطح 1', 'سطح 2', 'سطح 3']}
			label="سطح اختراع"
			search={false}
			title={level}
			all={false}
			responsive={true}
		/>
		<Input bind:val={number} label="شماره ثبت اختراع" />
		<DateInput bind:val={patent_data} label="تاریخ ثبت اختراع" />
		<SearchSelect
			label="سال برگزیدگی"
			on:select={({ detail }) => (year = detail)}
			required={true}
			title={year}
			responsive={true}
			search={true}
			all={false}
			data={YEARS}
		/>
		<Input bind:val={participation} label="سهم مشارکت(درصد)" />
		<div class="w-full px-2 mb-4">
			<FileInput
				name="invention_file"
				bind:isUploading
				label="فایل مورد نظر را آپلود کنید"
				size={500}
				status={100}
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
