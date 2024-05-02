<script>
	import SearchModal from '../../../modals/SearchModal.svelte';
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let score;
	let isUploading = false;
	let error = false;
	let major = score.attributes.data.major,
		year = score.attributes.data.year,
		university = score.attributes.data.university,
		description = score.attributes.data.description;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}
	const handleClickSave = async () => {
		error = false;
		if (!major || !year || !university) {
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
		let data = { major, year, university, description };
		let params = {
			filter: null,
			cert: 'training',
			type: 'sample',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/updateScore/${score.id}`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				dispatch('handleClick', response.data.data);
				major = '';
				year = '';
				university = '';
				description = '';
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
		<SearchModal
			on:select={({ detail }) => (major = detail)}
			url="/getMajors"
			label="رشته تحصیلی"
			responsive={true}
			title={major}
		/>
		<SearchModal
			on:select={({ detail }) => (university = detail)}
			url="/getUniversities"
			label="نام دانشگاه"
			responsive={true}
			title={university}
		/>
		<SearchSelect
			title={year}
			label="سال"
			on:select={({ detail }) => (year = detail)}
			required={true}
			responsive={true}
			search={true}
			all={false}
			data={YEARS}
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
