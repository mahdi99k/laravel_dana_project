<script>
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import Input from '../../../forms/Input.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showEntranceAdd;
	export let updated = false;
	export let scores;
	let isUploading = false;
	let error = false;
	let is_file1 = false;
	let major, year, rank, area_rank, area;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}
	const handleClickSave = async () => {
		error = false;
		if (!major || !year || !rank) {
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
		let data = { major, year, rank, area_rank, area };
		let params = {
			filter: null,
			cert: 'training',
			type: 'entrance',
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
				major = '';
				year = '';
				rank = '';
				area_rank = '';
				area = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};
	//SEND FILE
	let file1 = false;
</script>

{#if showEntranceAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchSelect
				on:select={({ detail }) => (major = detail)}
				data={['علوم انسانی', 'زبان‌های خارجه', 'ریاضی و فنی', 'علوم تجربی', 'هنر']}
				search={true}
				all={false}
				responsive={true}
				label="گروه آزمایشی"
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
			<Input bind:val={rank} label="رتبه کشوری" />
			<SearchSelect
				required={false}
				on:select={({ detail }) => (area = detail)}
				data={['یک', 'دو', 'سه']}
				search={false}
				all={false}
				responsive={true}
				label="منطقه"
			/>
			<Input required={false} bind:val={area_rank} label="رتبه منطقه" />
			<div class="lg:w-5/12 sm:w-6/12 w-full px-2 mb-4">
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
