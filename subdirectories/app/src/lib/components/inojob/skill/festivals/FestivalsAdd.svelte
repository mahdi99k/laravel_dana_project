<script>
	import Input from '../../../forms/Input.svelte';
	import MultiSelect from '../../../forms/MultiSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, closeLoading, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showFestivalsAdd;
	export let scores;
	let isUploading = false;
	let error = false;
	let participation, description;
	import { createEventDispatcher, onMount } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	let data = [];

	let years = [];
	for (let i = 1370; i < 1403; i++) {
		years.push({
			name: String(i)
		});
	}
	let filter;
	$: ableClose = false;
	$: step = 1;
	$: steps = {
		1: {
			name: 'type',
			data: [
				{
					type: 'kharazmi',
					name: 'خوارزمی'
				},
				{
					type: 'razi',
					name: 'رازی'
				},
				{
					type: 'farabi',
					name: 'فارابی'
				},
				{
					type: 'salman',
					name: 'سلمان فارسی (نیروهای مسلح)'
				}
			]
		},
		2: {
			name: 'level',
			kharazmi: [
				{ name: 'دانش آموزی', type: 'kharazmi' },
				{ name: 'دانشجویی و آزاد', type: 'kharazmi' },
				{ name: 'بین المللی', type: 'karazmi' }
			],
			razi: [
				{ name: 'محقق برگزیده', type: 'razi' },
				{ name: 'محقق جوان', type: 'razi' },
				{ name: 'محقق دانشجو', type: 'razi' }
			],
			farabi: [
				{ name: 'بزرگسال', type: 'farabi' },
				{ name: 'جوان', type: 'farabi' }
			],
			salman: [
				{ name: 'طرح های سامانه ای ،طرح های علمی و دانشی و محققین', type: 'salman' },
				{ name: 'طرح های فناورانه(طرح برتر)', type: 'salman' }
			]
		},
		3: {
			name: 'major',
			kharazmi: [
				{ name: 'خوارزمی' },
				{ name: 'برق و کامپیوتر' },
				{ name: 'مکانیک' },
				{ name: 'صنایع شیمیایی' },
				{ name: 'کشاورزی و منابع طبیعی' },
				{ name: 'علوم پایه' },
				{ name: 'طرح های ویژه' },
				{ name: 'زیست فناوری و علوم پایه پزشکی' },
				{ name: 'عمران' },
				{ name: 'معماری و هنر' },
				{ name: 'فناوری نانو' },
				{ name: 'علوم پزشکی' },
				{ name: 'مواد و متالورژی و انرژی های نو' },
				{ name: 'صنایع و مدیریت فناوری' },
				{ name: 'علوم انسانی' },
				{ name: 'کشاورزی' },
				{ name: 'صنایع' },
				{ name: 'بیوتکنولوژی' },
				{ name: 'هنر' },
				{ name: 'علوم پزشکی' }
			],
			razi: [
				{ name: 'ابداعات و اختراعات' },
				{ name: 'علوم بالینی جراحی' },
				{ name: 'علوم بالینی داخلی' },
				{ name: 'علوم پایه' },
				{ name: 'علوم بهداشتی، مدیریت و تغذیه' },
				{ name: 'علوم توانبخشی و پیراپزشکی' },
				{ name: 'علوم دارویی' },
				{ name: 'فناوری نوین' },
				{ name: 'علوم دندانپزشکی' },
				{ name: 'تخصصی HSR' },
				{ name: 'ابداعات و اختراعات و فرضیه های علمی' },
				{ name: 'سازمان های غیر دولتی حامی پژوهش علوم پزشکی' },
				{ name: 'طب سنتی ایرانی' }
			],
			farabi: [
				{ name: 'انقلاب اسلامی و امام خمینی' },
				{ name: 'تاریخ، جغرافیا و باستان شناسی' },
				{ name: 'حقوق، زبان و ادبیات فارسی' },
				{ name: 'علوم اجتماعی و علوم ارتباطات' },
				{ name: 'علوم اقتصادی، مدیریت و حسابداری' },
				{ name: 'علوم تربیتی، روانشناسی و علوم رفتاری' },
				{ name: 'علوم سیاسی، روابط بین الملل و مطالعات منطقه ای' },
				{ name: 'فقه و اصول، علوم قرآنی و حدیث' },
				{ name: 'فلسفه، کلام، اخلاق، ادیان و عرفان' },
				{ name: 'فناوری اطلاعات، اطلاع رسانی و کتابداری' },
				{ name: 'مطالعات هنر و زیباشناسی' }
			],
			salman: [
				{ name: 'آسیب شناسی' },
				{ name: 'آمار زیستی' },
				{ name: 'آموزش بهداشت' },
				{ name: 'آموزش پرستاری' },
				{ name: 'آموزش پزشکی' },
				{ name: 'آینده پژوهی' },
				{ name: 'اپیدمیولوژی' },
				{ name: 'اخلاق پزشکی' },
				{ name: 'ادبیات کودک' },
				{ name: 'ادبیات نمایشی' },
				{ name: 'ادیان و عرفان' },
				{ name: 'ارتباط تصویری(گرافیک)' },
				{ name: 'ارتوپدی' },
				{ name: 'ارتودنسی' },
				{ name: 'اعضای مصنوعی و وسایل کمکی' },
				{ name: 'اقتصاد ' },
				{ name: 'اقتصاد بهداشت' },
				{ name: 'اقتصاد سلامت' },
				{ name: 'اقتصاد و مدیریت دارو' },
				{ name: 'الکتروشیمی' },
				{ name: 'الهیات و معارف اسلامی، فقه شافعی' },
				{ name: 'آموزش زبان ژاپنی' },
				{ name: 'اندودنتیکس' },
				{ name: 'انفورماتیک پزشکی' },
				{ name: 'انگولوژی' },
				{ name: 'انگل شناسی' },
				{ name: 'انگل شناسی پزشکی' },
				{ name: 'انگل شناسی دامپزشکی' },
				{ name: 'اورولوژی' },
				{ name: 'ایمنی شناسی پزشکی' },
				{ name: 'باستان شناسی' },
				{ name: 'بافت شناسی' },
				{ name: 'باکتری شناسی' },
				{ name: 'باکتری شناسی پزشکی' },
				{ name: 'برنامه ریزی شهری و منطقه ای' },
				{ name: 'بهداشت باروری' },
				{ name: 'بهداشت حرفه ای' },
				{ name: 'بهداشت عمومی' },
				{ name: 'بهداشت محبط' },
				{ name: 'بهداشت و مبارزه با بیماری ها' },
				{ name: 'بیماری های پوست' },
				{ name: 'بیماری های داخلی' },
				{ name: 'بیماری های دهان و تشخیص' },
				{ name: 'بیماری های عفونی و گرمسیری' },
				{ name: 'بیماری های قلب و عروق' },
				{ name: 'بیماری های کودکان' },
				{ name: 'بیماری های مغز و اعصاب' },
				{ name: 'بیوانفورماتیک' },
				{ name: 'بیوشیمی' },
				{ name: 'بیوفیزیک' },
				{ name: 'بیوتکنولوژی' },
				{ name: 'بیوتکنولوژی پزشکی' },
				{ name: 'بیوتکنولوژی دارویی' },
				{ name: 'بیوشیمی بالینی' },
				{ name: 'بیولوژی تولید مثل' },
				{ name: 'بیهوشی' }
			]
		},
		4: {
			name: 'year',
			data: years
		},
		5: {
			name: 'rank',
			data: [{ name: 'رتبه اول' }, { name: 'رتبه دوم' }, { name: 'رتبه سوم' }]
		}
	};

	console.log(years);
	onMount(() => {
		data = steps[1].data;
	});

	// let data = steps[1].data;
	function createBtn(node) {
		myBtn = node;
	}
	let dataParams = {};

	const handleClickSave = async () => {
		error = false;
		if (
			!dataParams.type ||
			!dataParams.level ||
			!dataParams.major ||
			!dataParams.rank ||
			!dataParams.year ||
			!participation
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
		loading(myBtn);
		const api_token = getCookie('api_token');
		dataParams.participation = participation;
		dataParams.description = description;
		let params = {
			filter: dataParams.type,
			cert: 'skill',
			type: 'festival',
			data: dataParams,
			file1
		};
		await axios
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = [response.data.data, ...scores];
				dispatch('handleClick');
				dataParams.type = '';
				dataParams.level = '';
				dataParams.major = '';
				dataParams.rank = '';
				dataParams.year = '';
				participation = '';
				description = '';
			});
	};
	const handleClickCancel = () => {
		ableClose = false;
		step = 1;
		data = steps[1].data;
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;

	const getData = (detail) => {
		if (step == 1) {
			dataParams.type_value = detail.type;
		}

		dataParams[steps[step].name] = detail.name;
		if (step == 5) {
			ableClose = true;
		} else {
			steps[step].data = data;
			step++;
			console.log(detail, 'detsssssssssssss', step, steps[step]);
			if (step < 4) data = steps[step][detail.type];
			else data = steps[step].data;
		}
		console.log(dataParams);
	};
</script>

{#if showFestivalsAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="pb-20">
			<div class="flex flex-wrap mt-3">
				<MultiSelect
					{data}
					label="عنوان"
					on:select={({ detail }) => getData(detail)}
					bind:ableClose
					responsive={false}
					bind:step
					endStep="5"
					bind:steps
				/>
				<Input bind:val={participation} label="میزان مشارکت(درصد)" responsive={false} />
				<Input required={false} bind:val={description} label="توضیحات" responsive={false} />
				<div class="w-full px-2 mb-4">
					<FileInput
						name="invention_file"
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
