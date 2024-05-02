<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, YEARS, closeLoading, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showCompAdd;
	let isUploading = false;
	export let scores;
	let error = false;
	let majors = [];
	let titles = [
		['مسابقات بین المللی ربوکاپ آزاد ایران ', 'robocup'],
		['مسابقه ملی فناوری نانو(دانشجویی)', 'nano_uni'],
		['المپیاد دانش آموزی علوم و فناوری نانو', 'nano_school'],
		// ['مجموعه رقابت های تخصصی فناورد', 'tech'],
		['برگزیدگی در مسابقات فناورانه', 'technology'],
		['جشنواره شیخ بهایی(فن آفرینی)', 'bahaei']
	];
	let title, idea, unit, major, year, rank, comp_type, participation;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (title == 'robocup' || title == 'nano_uni' || title == 'tech') {
			if (!idea) {
				error = 'لطفا فایل خواسته شده را بارگذاری کنید';
				myBtn.innerHTML = 'ذخیره';
				return;
			}
		}
		if (title == 'robocup' || title == 'babei') {
			if (!unit) {
				error = 'لطفا فایل خواسته شده را بارگذاری کنید';
				myBtn.innerHTML = 'ذخیره';
				return;
			}
		}
		if (title == 'technology') {
			if (!comp_type) {
				error = 'لطفا فایل خواسته شده را بارگذاری کنید';
				myBtn.innerHTML = 'ذخیره';
				return;
			}
		}
		if (!title || !participation || !rank || !major) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
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
			idea,
			unit,
			major,
			year,
			rank,
			comp_type,
			participation
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'skill',
			type: 'comp',
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
				title = '';
				idea = '';
				unit = '';
				major = '';
				year = '';
				rank = '';
				comp_type = '';
				participation = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;
	const changeTitle = (detail) => {
		comp_type = '';
		major = '';
		rank = '';
		year = '';
		participation = '';
		title = detail[1];
		if (title == 'robocup' || title == 'nano_uni' || title == 'nano_school') {
			majors = [
				'آسیب شناسی',
				'آمار زیستی',
				'آموزش بهداشت',
				'آموزش پرستاری',
				'آموزش پزشکی',
				'آینده پژوهی',
				'اپیدمیولوژی',
				'اخلاق پزشکی',
				'ادبیات کودک',
				'ادبیات نمایشی',
				'ادیان و عرفان',
				'ارتباط تصویری(گرافیک)',
				'ارتوپدی',
				'ارتودنسی',
				'اعضای مصنوعی و وسایل کمکی',
				'اقتصاد ',
				'اقتصاد بهداشت',
				'اقتصاد سلامت',
				'اقتصاد و مدیریت دارو',
				'الکتروشیمی',
				'الهیات و معارف اسلامی، فقه شافعی',
				'آموزش زبان ژاپنی',
				'اندودنتیکس',
				'انفورماتیک پزشکی',
				'انگولوژی',
				'انگل شناسی',
				'انگل شناسی پزشکی',
				'انگل شناسی دامپزشکی',
				'اورولوژی',
				'ایمنی شناسی پزشکی',
				'باستان شناسی',
				'بافت شناسی',
				'باکتری شناسی',
				'باکتری شناسی پزشکی',
				'برنامه ریزی شهری و منطقه ای',
				'بهداشت باروری',
				'بهداشت حرفه ای',
				'بهداشت عمومی',
				'بهداشت محبط',
				'بهداشت و مبارزه با بیماری ها',
				'بیماری های پوست',
				'بیماری های داخلی',
				'بیماری های دهان و تشخیص',
				'بیماری های عفونی و گرمسیری',
				'بیماری های قلب و عروق',
				'بیماری های کودکان',
				'بیماری های مغز و اعصاب',
				'بیوانفورماتیک',
				'بیوشیمی',
				'بیوفیزیک',
				'بیوتکنولوژی',
				'بیوتکنولوژی پزشکی',
				'بیوتکنولوژی دارویی',
				'بیوشیمی بالینی',
				'بیولوژی تولید مثل',
				'بیهوشی'
			];
		} else if (title == 'tech' || title == 'technology') {
			majors = ['برق', 'کامپیوتر'];
		} else if (title == 'bahaei') {
			majors = ['فن آفرینان نوپا', 'فن آفرینان در حال رشد', 'فن آفرینان رشد یافته'];
		}
	};
</script>

{#if showCompAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchSelect
				on:select={({ detail }) => {
					changeTitle(detail);
				}}
				data={titles}
				multi={true}
				search={false}
				all={false}
				responsive={true}
				label="عنوان مسابقه"
			/>
			{#if title == 'robocup' || title == 'nano_uni' || title == 'tech'}
				<Input bind:val={idea} label="عنوان طرح" />
			{/if}
			{#if title == 'robocup'}
				<SearchSelect
					on:select={({ detail }) => (unit = detail)}
					data={['دانشجویی', 'دانش‌آموزی']}
					label="بخش"
					search={false}
					all={false}
					responsive={true}
				/>
			{:else if title == 'bahaei'}
				<SearchSelect
					on:select={({ detail }) => (unit = detail)}
					data={['طراحان کسب و کار دانشجویی', 'طراحان کسب و کار آزاد']}
					label="بخش"
					search={false}
					all={false}
					responsive={true}
				/>
			{/if}
			<SearchSelect
				on:select={({ detail }) => (major = detail)}
				data={majors}
				label="زمینه یا رشته"
				search={false}
				all={false}
				responsive={true}
			/>
			<SearchSelect
				on:select={({ detail }) => (rank = detail)}
				data={['رتبه اول', 'رتبه دوم', 'رتبه سوم']}
				search={true}
				all={false}
				responsive={true}
				label="رتبه"
			/>
			{#if title == 'technology'}
				<SearchSelect
					on:select={({ detail }) => (comp_type = detail)}
					data={['ملی', 'بین المللی']}
					search={true}
					all={false}
					responsive={true}
					label="نوع مسابقه"
				/>
			{/if}
			<SearchSelect
				label="سال"
				on:select={({ detail }) => (year = detail)}
				required={true}
				responsive={true}
				search={true}
				all={false}
				data={YEARS}
			/>
			<Input bind:val={participation} label="میزان مشارکت(درصد)" />

			<div class="w-full px-2 mb-4">
				<FileInput
					name="comp_file"
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
