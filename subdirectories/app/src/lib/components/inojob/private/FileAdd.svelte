<script>
	import { fade } from 'svelte/transition';
	import axios from 'axios';
	import { afterUpdate, createEventDispatcher, onMount } from 'svelte';
	import FileInput from '../../forms/FileInput.svelte';
	import { API_URL, getCookie } from '../../../main';
	let dispatch = createEventDispatcher();
	let isUploading = false;
	export let USER;
	$: status = {
		id_card1: 0,
		id_card2: 0,
		id_card3: 0,
		military_card: 0,
		personal_card: 0,
		melli_card: 0,
		disability_card: 0
	};
	onMount(() => {
		if (USER.image.id_card1 && !isUploading) status.id_card1 = 100;
		if (USER.image.id_card2 && !isUploading) status.id_card2 = 100;
		if (USER.image.id_card3 && !isUploading) status.id_card3 = 100;
		if (USER.image.military_card && !isUploading) status.military_card = 100;
		if (USER.image.personal_card && !isUploading) status.personal_card = 100;
		if (USER.image.melli_card && !isUploading) status.melli_card = 100;
		if (USER.image.disability_card && !isUploading) status.disability_card = 100;
	});

	const handleClick = (detail, type) => {
		console.log('this', status[type], detail);
		isUploading = true;
		status[type] = 0;
		const api_token = getCookie('api_token');
		let formData = new FormData();
		formData.append('file', detail);
		formData.append('name', type);
		axios
			.post(`${API_URL}/userUpload`, formData, {
				headers: {
					'Content-Type': 'multipart/form-data',
					Authorization: `Bearer ${api_token}`
				},
				onUploadProgress: function (progressEvent) {
					let percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
					status[type] = percentCompleted;
				}
			})
			.then(function (response) {
				isUploading = false;
			});
	};
</script>

<div in:fade={{ duration: 200, delay: 200 }} out:fade={{ duration: 200 }}>
	<div class="flex w-full flex-wrap">
		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="id_card1"
				bind:isUploading
				label="تصویر صفحه اول شناسنامه"
				size={500}
				status={status.id_card1}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
		</div>
		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="id_card2"
				bind:isUploading
				label="تصویر صفحه وضعیت تاهل شناسنامه"
				size={500}
				status={status.id_card2}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
		</div>
		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="id_card3"
				bind:isUploading
				label="تصویر صفحه توضیحات شناسنامه"
				size={500}
				status={status.id_card3}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
		</div>
		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="military_card"
				bind:isUploading
				label="کارت پایان خدمت"
				size={500}
				status={status.military_card}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
		</div>
		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="melli_card"
				bind:isUploading
				label="کارت ملی"
				size={500}
				status={status.melli_card}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
		</div>

		<div class="lg:w-4/12 sm:w-6/12 w-full px-2 mb-4">
			<FileInput
				name="personal_card"
				bind:isUploading
				label="تصویر پرسنلی"
				size={500}
				status={status.personal_card}
				sizeLabel="کیلوبایت"
				url="/userUpload"
				type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
				on:send={({ detail }) => {}}
			/>
			{#if USER.more.disability}
				<FileInput
					name="disability_card"
					bind:isUploading
					label="کارت بهزیستی"
					size={500}
					status={status.disability}
					sizeLabel="کیلوبایت"
					url="/userUpload"
					type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
					on:send={({ detail }) => {}}
				/>
			{/if}
		</div>
	</div>
</div>

<style>
</style>
