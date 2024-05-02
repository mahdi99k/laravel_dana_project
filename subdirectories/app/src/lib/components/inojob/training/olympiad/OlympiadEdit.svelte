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
	let type = score.attributes.data.type,
		major = score.attributes.data.major,
		level = score.attributes.data.level,
		year = score.attributes.data.year,
		ministry = score.attributes.data.ministry,
		rank = score.attributes.data.rank,
		description = score.attributes.data.description;
	let types = [
		['دانش آموزی', 'school'],
		['دانشجویی', 'uni']
	];
	let types2 = {
		uni: 'دانشجویی',
		school: 'دانش آموزی'
	};
	let majors = [
		{
			name: 'آمار',
			type: 'uni'
		},
		{
			name: 'الهیات و معارف',
			type: 'uni'
		},
		{
			name: 'پزشکی',
			type: 'uni'
		},
		{
			name: 'حقوق',
			type: 'uni'
		},
		{
			name: 'ریاضی',
			type: 'all'
		},
		{
			name: 'زبان و ادبیات فارسی',
			type: 'uni'
		},
		{
			name: 'زیست شناسی',
			type: 'all'
		},
		{
			name: 'شیمی',
			type: 'all'
		},
		{
			name: 'طراحی صنعتی',
			type: 'uni'
		},
		{
			name: 'علوم اقتصادی',
			type: 'uni'
		},
		{
			name: 'علوم تربیتی',
			type: 'uni'
		},
		{
			name: 'علوم جغرافیایی',
			type: 'uni'
		},
		{
			name: 'علوم زمین',
			type: 'uni'
		},
		{
			name: 'فیزیک',
			type: 'all'
		},
		{
			name: 'مهندسی شیمی',
			type: 'uni'
		},
		{
			name: 'مهندسی مواد و متالورژی',
			type: 'uni'
		},
		{
			name: 'مهندسی برق',
			type: 'uni'
		},
		{
			name: 'مهندسی کامپیوتر',
			type: 'uni'
		},
		{
			name: 'مهندسی عمران',
			type: 'uni'
		},
		{
			name: 'زراعت و اصلاح نباتات',
			type: 'uni'
		},
		{
			name: 'مهندسی صنایع',
			type: 'uni'
		},
		{
			name: 'مهندسی مکانیک',
			type: 'uni'
		},
		{
			name: 'روانشناسی',
			type: 'uni'
		},
		{
			name: 'مدیریت نظام سلامت',
			type: 'uni'
		},
		{
			name: 'کارآفرینی',
			type: 'uni'
		},
		{
			name: 'سلول های بنیادی و مهندسی',
			type: 'uni'
		},
		{
			name: 'تفکر علمی در علوم پایه',
			type: 'uni'
		},
		{
			name: 'نجوم',
			type: 'school'
		},
		{
			name: 'کامپیوتر',
			type: 'school'
		},
		{
			name: 'ادبی',
			type: 'school'
		},
		{
			name: 'سلول های بنیادی',
			type: 'school'
		},
		{
			name: 'جغرافیا',
			type: 'school'
		}
	];
	let filterMajors = [];
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}
	const handleClickSave = async () => {
		error = false;
		if (!type || !major || !level || !year || !rank) {
			error = 'لطفا همه فیلدها را پر کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (!file1) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (!ministry && type == 'uni') {
			error = 'لطفا همه فیلدها را پر کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		loading(myBtn);
		const api_token = getCookie('api_token');
		let data = { type, major, level, year, ministry, rank, description };
		let params = {
			filter: type,
			cert: 'training',
			type: 'olympiad',
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
		type = detail[1];
		console.log(detail);
		filterMajors = majors.filter((data) => {
			return data.type == detail[1] || data.type == 'all';
		});
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
			on:select={({ detail }) => {
				changeType(detail);
			}}
			title={types2[type]}
			data={types}
			multi={true}
			search={false}
			all={false}
			responsive={true}
			label="نوع المپیاد"
		/>
		<SearchSelect
			on:select={({ detail }) => (major = detail)}
			data={filterMajors}
			search={true}
			title={major}
			all={false}
			responsive={true}
			label="رشته"
			object={true}
		/>
		<SearchSelect
			on:select={({ detail }) => (level = detail)}
			data={['ملی', 'جهانی']}
			search={false}
			title={level}
			all={false}
			responsive={true}
			label="سطح المپیاد"
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
		{#if type == 'uni'}
			<SearchSelect
				on:select={({ detail }) => (ministry = detail)}
				data={['علوم', 'بهداشت - رتبه انفرادی', 'بهداشت - رتبه گروهی']}
				search={false}
				title={ministry}
				all={false}
				responsive={true}
				label="وزارت"
			/>
		{/if}
		<SearchSelect
			on:select={({ detail }) => (rank = detail)}
			data={['طلا', 'نقره', 'برنز']}
			search={false}
			title={rank}
			all={false}
			responsive={true}
			label="رتبه"
		/>
		<Input required={false} bind:val={description} label="توضیحات" />
		<div class="w-full px-2 mb-4">
			<FileInput
				name="olympiad_file"
				bind:isUploading
				label="فایل مورد نظرتان را آپلود کنید"
				size={500}
				status={100}
				sizeLabel="کیلوبایت"
				url="/scoreUpload"
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
