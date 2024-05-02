<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	import axios from 'axios';
	export let showActivitiesAdd;
	import { API_URL, YEARS, loading, getCookie } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let scores;
	let isUploading = false;
	let error = false;
	let type, description;
	let activities = {
		employment: { best_amount: null },
		knowledge: {
			// rank: null,
			participation: null,
			name: null,
			production_year: null,
			production_level: null
		},
		experience: {
			start_date: null,
			end_date: null,
			company: null,
			act_type: null,
			contract: null,
			contract_details: null,
			post: null
		},
		postdoctor: { start_date: null, end_date: null, status: null , type:null },
		base_certificate: { hour: null, course: null, place: null },
		pro_certificate: { hour: null, course: null, place: null },
		assistant: { edu_year: null, half_year: null, hour: null },
		internship: { plan: null, title: null, start_date: null, end_date: null, hour: null },
		history: { place: null, half_year: null, year: null, hour: null },
		skill_comp: { title: null, date: null, rank: null /* participation: null */ }
	};

	let filter;
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	let types = [
		['برگزیدگان آزمون استخدام شرکت‌های خصوصی و دانش‌بنیان', 'employment'],
		['مشارکت موثر در تولید محصول دانش بنیان در شرکت دانش بنیان', 'knowledge'],
		['سابقه اشتغال مرتبط با زمینه استعدادی با ارائة سوابق بيمه', 'experience'],
		['دوره پسادکترا و فرصت مطالعاتی', 'postdoctor'],
		['گواهینامه­ های پایه معتبر مهارتی', 'base_certificate'],
		['گواهینامه­ های تخصصی معتبر مهارتی', 'pro_certificate'],
		['دستياري آموزشی، پژوهشی و فناورانه', 'assistant'],
		['شرکت در برنامه‌های کارآموزی و کارورزی', 'internship'],
		['سابقه تدریس', 'history'],
		['برگزيدگي در مسابقات مهارتي', 'skill_comp']
	];
	function createBtn(node) {
		myBtn = node;
	}
	const handleClickSave = async () => {
		error = false;
		console.log(filter);
		let active_type = activities[filter];
		console.log(active_type);
		Object.keys(active_type).forEach((value) => {
			if (active_type[value] == null || !active_type[value]) {
				if (filter != 'internship' && value != 'hour') {
					error = 'لطفا فیلدهای خواسته شده را پر کنید';
					myBtn.innerHTML = 'ذخیره';
					// console.log(active_type[value] , 'ssssssssssssssss');
					return;
				}
			}
		});
		if (!file1) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		console.log(error, 'errrrrrrrrrrrrr', file1);
		if (error == '' || !error) {
			loading(myBtn);
			let data = active_type;
			data.activity_type = type;
			data.description = description;
			const api_token = getCookie('api_token');

			isUploading = true;
			let params = {
				filter: filter,
				cert: 'skill',
				type: 'activities',
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
					file1 = false;
					activities = {
						employment: { best_amount: null },
						knowledge: {
							// rank: null,
							participation: null,
							name: null,
							production_year: null,
							production_level: null
						},
						experience: {
							start_date: null,
							end_date: null,
							company: null,
							act_type: null,
							contract: null,
							contract_details: null,
							post: null
						},
						postdoctor: { start_date: null, end_date: null, status: null , type:null },
						base_certificate: { hour: null, course: null, place: null },
						pro_certificate: { hour: null, course: null, place: null },
						assistant: { edu_year: null, half_year: null, hour: null },
						internship: { plan: null, title: null, start_date: null, end_date: null, hour: null },
						history: { place: null, half_year: null, year: null, hour: null },
						skill_comp: { title: null, date: null, rank: null /* participation: null */ }
					};
					description = '';
					filter = null;
				});
		}
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;
	let years = [];
	for (let i = 1382; i < 1402; i++) {
		years.push(`${i - 1} - ${i}`);
	}
</script>

{#if showActivitiesAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchSelect
				on:select={({ detail }) => {
					type = detail[0];
					filter = detail[1];
				}}
				multi={true}
				data={types}
				search={true}
				all={false}
				label="نوع فعالیت"
			/>
			{#if filter == 'employment'}
				<Input bind:val={activities.employment.best_amount} label="تعداد شایستگی برتر" />
			{:else if filter == 'knowledge'}
				<!-- <Input bind:val={activities.knowledge.rank} label="رتبه" /> -->
				<Input bind:val={activities.knowledge.participation} label="سهم مشارکت" />
				<Input bind:val={activities.knowledge.name} label="نام محصول" />
				<SearchSelect
					label="سال تولید"
					on:select={({ detail }) => (activities.knowledge.production_year = detail)}
					required={true}
					responsive={true}
					search={true}
					all={false}
					data={YEARS}
				/>
				<Input bind:val={activities.knowledge.production_level} label="میزان تولید" />
			{:else if filter == 'experience'}
				<DateInput bind:val={activities.experience.start_date} label="تاریخ شروع" />
				<DateInput bind:val={activities.experience.end_date} label="تاریخ پایان" />
				<Input bind:val={activities.experience.company} label="نام شرکت/سازمان" />
				<Input bind:val={activities.experience.act_type} label="نوع فعاليت در شرکت/سازمان" />
				<SearchSelect
					on:select={({ detail }) => (activities.experience.contract = detail)}
					data={[
						'رسمی',
						'پیمانی',
						'قرارداد کار معین(مشخص)',
						'پروژه ای',
						'شرکتی',
						'پیمانکاری',
						' هیئت علمی',
						'سایر'
					]}
					search={false}
					all={false}
					responsive={true}
					label="نوع قرارداد"
				/>
				{#if activities.experience.contract != null}
					{#if activities.experience.contract.includes('سایر')}
						<Input bind:val={activities.experience.contract_details} label="نوع قرارداد" />
					{/if}
				{/if}
				<Input bind:val={activities.experience.post} label="عنوان پست سازمانی" />
			{:else if filter == 'postdoctor'}
				<SearchSelect
					on:select={({ detail }) => (activities.postdoctor.type = detail)}
					data={['فرصت مطالعاتی', 'پسادکترا']}
					search={false}
					all={false}
					responsive={true}
					label="نوع دوره"
				/>
				<DateInput bind:val={activities.postdoctor.start_date} label="تاریخ شروع" />
				<DateInput bind:val={activities.postdoctor.end_date} label="تاریخ پایان" />
				<SearchSelect
					on:select={({ detail }) => (activities.postdoctor.status = detail)}
					data={['با تایید بنیاد', 'سایز']}
					search={false}
					all={false}
					responsive={true}
					label="وضعیت تایید دوره"
				/>
			{:else if filter == 'pro_certificate'}
				<Input
					bind:val={activities.pro_certificate.hour}
					number={true}
					label="تعداد ساعت دوره:(به عدد)"
				/>
				<Input bind:val={activities.pro_certificate.course} label="نام دوره" />
				<Input bind:val={activities.pro_certificate.place} label="مرکز برگزارکننده دوره" />
			{:else if filter == 'base_certificate'}
				<Input
					bind:val={activities.base_certificate.hour}
					number={true}
					label="تعداد ساعت دوره:(به عدد)"
				/>
				<Input bind:val={activities.base_certificate.course} label="نام دوره" />
				<Input bind:val={activities.base_certificate.place} label="مرکز برگزارکننده دوره" />
			{:else if filter == 'assistant'}
				<SearchSelect
					label="سال"
					on:select={({ detail }) => (activities.assistant.edu_year = detail)}
					required={true}
					responsive={true}
					search={true}
					all={false}
					data={YEARS}
				/>
				<Input bind:val={activities.assistant.hour} number={true} label="تعداد دوره:(به عدد)" />
				<SearchSelect
					on:select={({ detail }) => (activities.assistant.half_year = detail)}
					data={['اول', 'دوم']}
					search={false}
					all={false}
					responsive={true}
					label="نیم سال تحصیلی"
				/>
			{:else if filter == 'internship'}
				<SearchSelect
					on:select={({ detail }) => (activities.internship.plan = detail)}
					data={['کارآموزی', 'کارورزی']}
					search={false}
					all={false}
					responsive={true}
					label="نوع برنامه"
				/>
				<Input bind:val={activities.internship.title} label="عنوان برنامه" />
				<DateInput bind:val={activities.internship.start_date} label="تاریخ شروع" />
				<DateInput bind:val={activities.internship.end_date} label="تاریخ پایان" />
				<Input
					bind:val={activities.internship.hour}
					required={false}
					number={true}
					label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
				/>
			{:else if filter == 'history'}
				<SearchSelect
					on:select={({ detail }) => (activities.history.place = detail)}
					data={['تدریس خارج از دانشگاه', 'تدریس در دانشگاه']}
					search={false}
					all={false}
					responsive={true}
					label="محل تدریس"
				/>
				<SearchSelect
					on:select={({ detail }) => (activities.history.half_year = detail)}
					data={['اول', 'دوم']}
					search={false}
					all={false}
					responsive={true}
					label="نیم سال تحصیلی"
				/>
				<SearchSelect
					on:select={({ detail }) => (activities.history.year = detail)}
					data={years}
					search={false}
					all={false}
					responsive={true}
					label="سال تحصیلی"
				/>
				<Input
					bind:val={activities.history.hour}
					label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
				/>
			{:else if filter == 'skill_comp'}
				<Input bind:val={activities.skill_comp.title} label="عنوان مسابقه" />
				<SearchSelect
					on:select={({ detail }) => (activities.skill_comp.rank = detail)}
					data={['رتبه اول', 'رتبه دوم', 'رتبه سوم']}
					search={false}
					all={false}
					responsive={true}
					label="رتبه"
				/>
				<DateInput bind:val={activities.skill_comp.date} label="تاریخ برگزاری" />
				<!-- <Input bind:val={activities.skill_comp.participation} label="سهم مشارکت" /> -->
			{/if}
			{#if filter}
				<Input bind:val={description} label="توضیح نوع فعالیت " required={false} />
			{/if}
			{#if filter || filter != null}
				<div class="w-full px-2 mb-4">
					<FileInput
						name="activities_file"
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
			{/if}
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
