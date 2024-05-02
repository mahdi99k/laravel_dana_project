<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let score;
	let isUploading = false;

	let error = false;
	let type = score.attributes.data.type,
		assoc = score.attributes.data.assoc,
		start_date = score.attributes.data.start_date,
		end_date = score.attributes.data.end_date;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (!type || !assoc || !start_date || !end_date) {
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
			type,
			assoc,
			start_date,
			end_date
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'culture',
			type: 'professional',
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
				assoc = '';
				start_date = '';
				end_date = '';
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
		<SearchSelect
			on:select={({ detail }) => (type = detail)}
			data={['پیوسته', 'افتخاری', 'وابسته', 'دانشجویی']}
			label="نوع عضویت"
			title={type}
			search={false}
			all={false}
			responsive={true}
		/>

		<Input bind:val={assoc} label="نام انجمن" />
		<DateInput bind:val={start_date} label="تاريخ شروع عضویت" />
		<DateInput bind:val={end_date} label="تاريخ پایان عضویت" />
		<div class="w-full px-2 mb-4">
			<FileInput
				name="professional_file"
				bind:isUploading
				label="گواهی"
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
