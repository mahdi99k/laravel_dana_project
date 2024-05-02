<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import MultiSelect from '../../../forms/MultiSelect.svelte';
	import SearchModal from '../../../modals/SearchModal.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let score;
	let isUploading = false;
	let error = false;
	let journal_title = score.attributes.data.journal_title,
		article_title = score.attributes.data.article_title,
		country = score.attributes.data.country,
		degree = score.attributes.data.degree,
		position = score.attributes.data.position,
		author_numbers = score.attributes.data.author_numbers,
		writer = score.attributes.data.writer,
		supervisor_participation = score.attributes.data.supervisor_participation,
		status = score.attributes.data.status,
		link = score.attributes.data.link,
		shamsi_data = score.attributes.data.shamsi_data,
		doi = score.attributes.data.doi,
		description = score.attributes.data.description,
		cat = score.attributes.data.cat;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (
			!journal_title ||
			!article_title ||
			!degree ||
			!position ||
			!author_numbers ||
			!writer ||
			!supervisor_participation ||
			!status ||
			!shamsi_data ||
			!doi || (doi == '1' && !link)
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
		isUploading = true;
		loading(myBtn);
		let data = {
			journal_title,
			article_title,
			country,
			degree,
			position,
			author_numbers,
			writer,
			supervisor_participation,
			status,
			shamsi_data,
			doi,
			link,
			type:cat,
			description
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: 'international',
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
				journal_title ="";
				article_title ="";
				country ="";
				degree ="";
				position ="";
				link = "";
				author_numbers ="";
				writer ="";
				supervisor_participation ="";
				status ="";
				cat ="";
				shamsi_data ="";
				doi ="";
				description ="";
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClickCancel');
	};

	//SEND FILE
	let file1 = score.attributes.file1;

	let degrees = ['کارشناسی', 'کارشناسی ارشد', 'دکتری حرفه ای', 'دکتری تخصصی', 'هیچکدام'];
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
			<SearchModal
				on:select={({ detail }) => {journal_title = detail.name; cat = detail.cat}}
				url="/getJournals"
				title={journal_title}
				label="عنوان مجله"
				sendAll={true}
				responsive={true}
				query="&type=article&in_internal=0"
			/>
			<Input bind:val={article_title} label="عنوان مقاله" />
			<SearchSelect
				on:select={({ detail }) => (country = detail.name)}
				data={countries}
				label="نام کشور برگزار کننده"
				title={country}
				responsive={true}
				object={true} all={false}
			/>
			<SearchSelect
				on:select={({ detail }) => (degree = detail)}
				data={degrees}
				label="برگرفته از مقطع"
				title={degree}
				responsive={true}
				all={false}
			/>
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
				search={false}
				title={supervisor_participation}
				all={false}
				responsive={true}
			/>
			<SearchSelect
				on:select={({ detail }) => (status = detail)}
				data={['چاپ', 'پذیرش']}
				label="وضعیت پذیرش"
				title={status}
				search={false}
				all={false}
				responsive={true}
			/>
			<DateInput  bind:val={shamsi_data} label="تاريخ پذيرش/چاپ(شمسی) "/>
			<SearchSelect
				on:select={({ detail }) => (doi = detail[1])}
				data={[['بله' , '1'], ['خیر' , '2']]}
				label="آيا مقاله داراي Link/DOI مي باشد؟ *"
				url="/scoreUpload"
				title={doi == '1' ? 'بله' : 'خیر'}
				multi={true}
				search={false}
				all={false}
				responsive={true}
			/>
			{#if doi == '1'}
				<Input label="لینک مقاله" bind:val={link}/>
			{/if}
			<Input required={false} bind:val={description} label="توضیحات" />
			<div class="w-full px-2 mb-4">
				<FileInput
					name="book_file"
					bind:isUploading
					label="فایل مجله"
					size={500}
					status={100}
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