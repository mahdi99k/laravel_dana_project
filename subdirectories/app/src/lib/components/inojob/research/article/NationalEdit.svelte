<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let updated = false;
	let isUploading = false;
	let error = false;
	export let score;
	let event_title = score.attributes.data.event_title,
		article_title = score.attributes.data.article_title,
		position = score.attributes.data.position,
		author_numbers = score.attributes.data.author_numbers,
		writer = score.attributes.data.writer,
		shamsi_data = score.attributes.data.shamsi_data,
		type = score.attributes.data.type,
		level = score.attributes.data.level,
		organizer = score.attributes.data.organizer,
		country = score.attributes.data.country,
		supervisor_participation = score.attributes.data.supervisor_participation,
		link = score.attributes.data.link,
		description = score.attributes.data.description,
		presentaion = score.attributes.data.presentaion;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		if (
			!event_title ||
			!article_title ||
			!position ||
			!author_numbers ||
			!writer ||
			!shamsi_data ||
			!type ||
			!level ||
			!organizer ||
			!country ||
			!supervisor_participation ||
			!link ||
			!presentaion
		) {
			error = 'لطفا همه فیلدها را پر کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		if (!file1 || !file2) {
			error = 'لطفا فایل خواسته شده را بارگذاری کنید';
			myBtn.innerHTML = 'ذخیره';
			return;
		}
		isUploading = true;
		loading(myBtn);
		let data = {
			event_title,
			article_title,
			position,
			author_numbers,
			writer,
			shamsi_data,
			type,
			level,
			organizer,
			country,
			supervisor_participation,
			link,
			presentaion
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: 'national',
			cert: 'research',
			type: 'article',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/updateScore/${score.id}`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				dispatch('handleClick' , response.data.data);
				event_title = '';
				article_title = '';
				degree = '';
				position = '';
				author_numbers = '';
				writer = '';
				shamsi_data = '';
				type = '';
				level = '';
				organizer = '';
				country = '';
				supervisor_participation = '';
				link = '';
				description = '';
				presentaion = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClickCancel');
	};

	//SEND FILE
	let file1 = score.attributes.file1;
	let file2 = score.attributes.file2;
	let countries = [];
	const getCountries = async () => {
		await axios.get(`${API_URL}/getCountries`).then(function (response) {
			countries = response.data.data;
		});
	};
	getCountries();
</script>

	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<Input bind:val={event_title} label="عنوان همایش" />
			<Input bind:val={article_title} label="عنوان مقاله" />
			<SearchSelect
				on:select={({ detail }) => (position = detail)}
				data={['اول', 'بقیه همکاران']}
				label="جایگاه فرد"
				title={position}
				search={false}
				all={false}
				responsive={true}
			/>
			<Input bind:val={author_numbers} label="تعداد نویسندگان" />
			<Input bind:val={writer} label="نگارنده(گان)" />
			<SearchSelect
				on:select={({ detail }) => (supervisor_participation = detail)}
				data={['بله', 'خیر']}
				label="مشارکت استاد راهنما"
				title={supervisor_participation}
				search={false}
				all={false}
				responsive={true}
			/>
			<DateInput  bind:val={shamsi_data} label="تاريخ پذيرش/چاپ(شمسی) " />
			<SearchSelect
				on:select={({ detail }) => (type = detail)}
				data={['کامل', 'خلاصه']}
				label="نوع مقاله"
				title={type}
				search={false}
				all={false}
				responsive={true}
			/>
			<SearchSelect
				on:select={({ detail }) => (level = detail)}
				data={['بین المللی', 'ملی']}
				label="سطح همایش"
				title={level}
				search={false}
				all={false}
				responsive={true}
			/>
			<Input bind:val={organizer} label="برگزارکننده‌گان" />
			<Input bind:val={link} label="لینک مقاله" />
			<SearchSelect
				on:select={({ detail }) => (country = detail.name)}
				data={countries}
				label="نام کشور برگزار کننده"
				title={country}
				responsive={true}
				object={true}
			/>
			
			<Input bind:val={article_title} label="عنوان مجله"  />
			<SearchSelect
				on:select={({ detail }) => (presentaion = detail)}
				data={['پوستر', 'سخنرانی']}
				label="نوع ارائه"
				title={presentaion}
				search={false}
				all={false}
				responsive={true}
			/>
			<Input required={false} bind:val={description} label="توضیحات" />
			<div class="flex w-full justify-between flex-wrap">
				<div class="lg:w-5/12 sm:w-6/12 w-full px-2 mb-4">
					<FileInput
						name="book_file"
						bind:isUploading
						label="فایل مقاله"
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

				<div class="lg:w-5/12 sm:w-6/12 w-full px-2 mb-4">
					<FileInput
						name="book_file2"
						bind:isUploading
						label="گواهی ارائه مقاله های همایشی"
						size={500}
						status={100}
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
