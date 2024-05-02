<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import MultiSelect from '../../../forms/MultiSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showEduAdd;
	export let scores;
	export let updated = false;
	let degree = '';
	let univetsities = [];
	let major,
		oriantation,
		rank,
		entry_half,
		university,
		entry_year,
		unit_numbers,
		gpa,
		province,
		city,
		country,
		teacher,
		supervisor,
		end_date,
		status,
		defense,
		thesis,
		course_type;
	country = '';
	let isUploading = false;
	let error = false;
	import { createEventDispatcher } from 'svelte';
	import SearchModal from '../../../modals/SearchModal.svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	let countries = [];
	function createBtn(node) {
		myBtn = node;
	}
	$: ableClose = false;
	let step = 1;
	let data = [];
	let provinces = [];
	$: steps = {
		1: {
			name: 'province',
			data: []
		},
		2: {
			name: 'city',
			data: []
		}
	};

	const handleClickSave = async () => {
		error = false;
		if (
			!major ||
			!entry_half ||
			!entry_year ||
			!gpa ||
			!country ||
			!status ||
			country == '' ||
			!degree ||
			(degree != 'diploma' && !oriantation) ||
			(country.includes('ایران') && (!province || !city)) || (degree == 'diploma' && end_date)
		) {
			error = 'لطفا همه فیلدها را پر کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (!file1) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (degree == 'phd') {
			if (!course_type) {
				error = 'لطفا همه فیلدها را پر کنید';
				myBtn.innerHTML = 'ذخیره';
				return;
			}
		}
		loading(myBtn);
		const api_token = getCookie('api_token');

		let data = {
			major,
			oriantation,
			rank,
			university,
			entry_half,
			entry_year,
			unit_numbers,
			gpa,
			province,
			city,
			country,
			teacher,
			supervisor,
			status,
			defense,
			thesis,
			end_date,
			course_type
		};
		let params = {
			filter: degree,
			cert: 'training',
			type: 'edu',
			data,
			file1,
			file2
		};
		await axios
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = [response.data.data, ...scores];
				dispatch('handleClick');
				major = '';
				oriantation = '';
				rank = '';
				university = '';
				entry_half = '';
				entry_year = '';
				unit_numbers = '';
				gpa = '';
				province = '';
				city = '';
				country = '';
				teacher = '';
				supervisor = '';
				status = '';
				defense = '';
				thesis = '';
				error = '';
				end_date = '';
				course_type = '';
			});
		ableClose = false;
		step = 1;
		data = steps[1].data;
	};
	const handleClickCancel = () => {
		ableClose = false;
		step = 1;
		data = steps[1].data;
		dispatch('handleClick');
	};

	async function getProvinces() {
		await axios.get(`${API_URL}/getProvinces`).then(function (response) {
			data = response.data.data;
			steps[step].data = data;
		});
	}
	getProvinces();
	const getCities = async (detail) => {
		data = [];
		await axios.get(`${API_URL}/getCities/${detail.id}`).then(function (response) {
			data = response.data.data;
			steps[step].data = data;
		});
	};
	async function getData(detail) {
		if (step == 1) {
			province = detail.name;
			console.log(province);
		}
		if (step == 1) await getCities(detail);
		else if (step == 2) {
			city = detail.name;
		}
	}
	let degrees = [
		['دیپلم', 'diploma'],
		['کاردانی', 'associate'],
		['سطح دو حوزه', 'mullah2'],
		['سطح سه حوزه', 'mullah3'],
		['سطح چهار حوزه', 'mullah4'],
		['کارشناسی', 'bachelor'],
		['کارشناسی ارشد', 'master'],
		['کارشناسی ارشد پیوسته', 'con_master'],
		['دکتری حرفه ای', 'pro_doctor'],
		['دکتری تخصصی', 'phd']
	];
	const changeDegree = (detail) => {
		degree = detail[1];
	};

	const getCountries = async () => {
		await axios.get(`${API_URL}/getCountries`).then(function (response) {
			countries = response.data.data;
		});
	};
	getCountries();

	//SEND FILE
	let file1 = false;
	let file2 = false;
</script>

{#if showEduAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchSelect
				on:select={({ detail }) => {
					changeDegree(detail);
				}}
				data={degrees}
				multi={true}
				search={false}
				all={false}
				responsive={true}
				label="مقطع"
			/>
			<SearchSelect
				on:select={({ detail }) => {
					country = detail.name;
				}}
				data={countries}
				all={false}
				label="کشور محل تحصیل"
				responsive={true}
				object={true}
			/>
			{#if degree == 'diploma'}
				<SearchSelect 
					on:select={({detail})=>major=detail}
					data={[
						'علوم انسانی',
						'علوم تجربی',
						'ریاضی فیزیک',
						'کار دانش',
						'فنی و حرفه‌ای'
					]}
					responsive={true}
					all={false}
					search={false}
					label="رشته تحصیلی"
				/>
				<DateInput bind:val={end_date} label="تاریخ دانش‌آموختگی/تاریخ پایان تحصیل"/>
			{:else}
			<SearchModal
				on:select={({ detail }) => (major = detail)}
				url="/getMajors"
				label="رشته تحصیلی"
				responsive={true}
			/>
			{/if}
			{#if country.includes('ایران') || !country}
				<SearchModal
					on:select={({ detail }) => (university = detail)}
					url="/getUniversities"
					label={degree == 'diploma' ? 'نام دبیرستان/پیش دانشگاهی' : 'نام دانشگاه'}
					responsive={true}
				/>
			{:else}
				<Input label={degree == 'diploma' ? 'نام دبیرستان/پیش دانشگاهی' : 'نام دانشگاه'} bind:val={university} />
			{/if}
			<Input bind:val={oriantation} label="گرایش" />
			<Input bind:val={rank} label="رتبه پذیرش" required={false} />
			<SearchSelect
				on:select={({ detail }) => (entry_half = detail)}
				data={['اول', 'دوم']}
				label="ورودی نیم سال"
				responsive={true}
				search={false}
				all={false}
			/>
			<SearchSelect
				label="سال شروع تحصیل"
				on:select={({ detail }) => (entry_year = detail)}
				required={true}
				responsive={true}
				search={true}
				all={false}
				data={YEARS}
			/>
			<Input bind:val={unit_numbers} label="تعداد واحدهای گذرانده" required={false} />
			<Input bind:val={gpa} label="معدل" />
			{#if country.includes('ایران')}
				<MultiSelect
					{data}
					label="استان و شهر محل تحصیل"
					on:select={({ detail }) => getData(detail)}
					bind:ableClose
					responsive={true}
					bind:step
					endStep="2"
					bind:steps
				/>
			{/if}
			<SearchSelect
				on:select={({ detail }) => (status = detail)}
				data={['دانش آموخته', 'دانشجو', 'اخراجی', 'انصرافی']}
				search={false}
				all={false}
				responsive={true}
				label="وضعیت تحصیل"
			/>
			{#if degree != 'associate' && degree != 'mullah2' && degree != 'mullah3' && degree != 'mullah4' && degree != 'diploma' && degree != ''}
				<Input required={false} bind:val={teacher} label="استاد" />
				<Input required={false} bind:val={supervisor} label="مشاور" />
				<Input required={false} bind:val={defense} label="صورت جلسه دفاع" />
				<Input required={false} bind:val={thesis} label="نام پایان‌نامه" />
			{/if}
			{#if degree == 'phd'}
				<SearchSelect
					on:select={({ detail }) => (course_type = detail)}
					data={['آموزشی', 'پژوهشی (عادی)', 'آموزش محور', 'پژوهش محور']}
					label="نوع دوره"
					responsive={true}
				/>
			{/if}
			<div class="flex flex-wrap w-full">
				<div class="lg:w-5/12 sm:w-6/12 w-full px-2 mb-4">
					<FileInput
						name="edu_file1"
						bind:isUploading
						label="گواهی دانش آموختگی یا اشتغال به تحصیل "
						size={500}
						sizeLabel="کیلوبایت"
						url="/scoreUpload"
						type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
						on:send={({ detail }) => {
							file1 = detail;
						}}
					/>
				</div>
				<div class="lg:w-5/12 sm:w-6/12 w-full px-2 mb-4">
					<FileInput
						name="edu_file2"
						bind:isUploading
						label="صورت جلسه دفاع"
						size={500}
						sizeLabel="کیلوبایت"
						url="/scoreUpload"
						type={['jpg', 'png', 'pdf', 'webp', 'jpeg']}
						on:send={({ detail }) => {
							file2 = detail;
						}}
					/>
				</div>
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
