<script>
	import Input from '../../forms/Input.svelte';
	import FileInput from '../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../main';
	import { fade } from 'svelte/transition';
	export let score;
	let isUploading = false;
	let error = false;
	let title = score.attributes.data.title,
		year = score.attributes.data.year,
		rank = score.attributes.data.rank,
		description = score.attributes.data.description;
	import { createEventDispatcher } from 'svelte';
	import SearchSelect from '../../forms/SearchSelect.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (!title || !description) {
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
			year,
			rank,
			description
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'other',
			type: 'other',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/updateScore/${score.id}`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				dispatch('handleClick', response.data.data);
				title = '';year = ""; rank="";
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClickCancel');
	};

	//SEND FILE
	let file1 = score.attributes.file1;
</script>

<form
	on:submit|preventDefault={handleClickSave}
	in:fade={{ duration: 200, delay: 200 }}
	out:fade={{ duration: 200 }}
>
	<div class="flex flex-wrap pb-20">
		<Input bind:val={title} label="عنوان فعالیت" />
		<Input bind:vall={rank} label="رتبه" required={false}/>
			<SearchSelect 
			responsive={true} all={false} search={false} data={YEARS} on:select={({detail}) => {year = detail}} label="سال" required={false} title={year}/>
		<Input bind:val={description} label="توضیحات متقاضی" />
		<div class="w-full px-2 mb-4">
			<FileInput
				name="other_file"
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
