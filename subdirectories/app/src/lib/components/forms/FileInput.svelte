<script>
	import { fade } from 'svelte/transition';
	import { createEventDispatcher } from 'svelte';
	import { getCookie, API_URL } from '../../main';
	import axios from 'axios';
	let dispatch = createEventDispatcher();
	export let status = 0;
	export let label;
	export let type;
	export let size;
	export let sizeLabel;
	export let error = '';
	export let name = '';
	export let url;
	export let file_name = 'file';
	export let isUploading = false;
	let fileInputDetails = '';
	function fileInput(node) {
		fileInputDetails = node;
	}
	const changeFile = async () => {
		error = '';
		let file = fileInputDetails.files[0];
		if (file.size > size * 1024) error = 'سایز فایل انتخابی بیشتر از حد مجاز است';
		let file_ext = file.name.split('.').pop().toLowerCase();
		if (!type.includes(file_ext)) error = 'فرمت فایل انتخابی صحیح نمی‌باشد';

		if (error == '') {
			status = 10;
			isUploading = true;
			let formData = new FormData();
			const api_token = getCookie('api_token');
			formData.append(file_name, file);
			formData.append('name', name);
			await axios
				.post(`${API_URL}${url}`, formData, {
					headers: { Authorization: `Bearer ${api_token}`, 'Content-Type': 'multipart/form-data' },
					onUploadProgress: function (progressEvent) {
						let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
						if (percentCompleted < 100) status = percentCompleted;
						else status = 99;
					}
				})
				.then(function (response) {
					if (status == 99) {
						if (response.data.status == 'success') {
							isUploading = false;
							status = 100;
							dispatch('send', response.data.data);
						}
					}
				});
		}

		console.log('status', status);
	};
</script>

<div class="bg-input--gray border border-input--border p-5 rounded-xl flex flex-col">
	<span>{label}</span>
	<label
		for="file-{name}"
		class="border border-dashed flex flex-col mt-3 p-3 justify-center items-center rounded-xl cursor-pointer relative"
	>
		{#if isUploading && status > 0 && status < 100}
			<div class="absolute success-bg h-full top-0 end-0" style="width:{status}%" />
		{/if}

		{#if status == 100}
			<div
				in:fade={{ duration: 200, delay: 200 }}
				out:fade={{ duration: 200 }}
				class="rounded-full w-12 h-12 grid place-items-center p-1 border border-file--border"
			>
				<img src="/img/inojob/tick.svg" alt="tick icon" class="h-5 w-5" />
			</div>
			<span class="text-sm text-text--gray my-2">مدرک معتبر مرتبط آپلود شد</span>
			<div class="flex items-center">
				<i class="fi fi-rr-edit -text--purple" />
				<span class="ms-1 -text--purple">ویرایش</span>
			</div>
		{:else}
			<div
				in:fade={{ duration: 200, delay: 200 }}
				out:fade={{ duration: 200 }}
				class="rounded-full w-12 h-12 grid place-items-center p-1 border border-file--border"
			>
				<i class="fi fi-rr-cloud-upload text-base--icon" />
			</div>
			<span class="my-2">نوع فایل: {type.join(' , ')}</span>
			<span class="text-sm text-text--gray">حداکثر اندازه فایل: {size} {sizeLabel}</span>
		{/if}
	</label>
	{#if error != ''}
		<span class="-text--error">{error}</span>
	{/if}
	<input use:fileInput type="file" class="hidden" id="file-{name}" on:change={changeFile} />
</div>

<style>
	:root {
		--width: 0;
	}
	.border-dashed {
		border-color: #cecece;
	}
	.success-bg {
		background-color: rgba(34, 197, 148, 0.1);
		transition: 0.2s;
	}
</style>
