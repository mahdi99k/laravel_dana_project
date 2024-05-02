<script>
	import Input from '../../forms/Input.svelte';
	import FileInput from '../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, closeLoading, getCookie, loading } from '../../../main';
	import { fade } from 'svelte/transition';
	export let showOtherAdd;
	let isUploading = false;
	let error = false;
	export let scores;
	let title, year , rank , description;
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
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = [response.data.data, ...scores];
				dispatch('handleClick');
				title = '';yaer="";rank="";
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;
</script>

{#if showOtherAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
	<p class="text-justify mb-3">منظور از گزینۀ »سا یر فعالیت های برجسته آموزشی، پژوهش ی، فناورانه و فرهنگی «، موارد برجسته ای همچون 
		کسب جوایز معتبر بین المللی ، همکار ی با نهادهای مل ی با اثرگذاری کشوری و مطالبی از این قبیل م ی باشد که 
		در صورت تا یید اعتبار آن توسط کارگروه امتیازدهی خواهد شد.</p>
		<div class="flex flex-wrap pb-20">
			<Input bind:val={title} label="عنوان فعالیت" />
			<Input bind:vall={rank} label="رتبه" required={false}/>
			<SearchSelect 
			responsive={true} all={false} search={false} data={YEARS} on:select={({detail}) => {year = detail}} label="سال" required={false}/>
			<Input bind:val={description} label="توضیحات متقاضی" />
			<div class="w-full px-2 mb-4">
				<FileInput
					name="other_file"
					bind:isUploading
					label="فایل مورد نظر را آپلود کنید"
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
