<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import SearchModal from '../../../modals/SearchModal.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showInternational;
	export let scores;
	export let cantAdd;
	let isUploading = false;
	let error = false;
	let journal_title,
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
		cat,
		description;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		console.log(cat);
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
			link,
			author_numbers,
			writer,
			supervisor_participation,
			status,
			shamsi_data,
			doi,
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
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				cantAdd = response.data.cantAdd;
				scores = [response.data.data , ...scores]
				dispatch('handleClick');
				journal_title ="";
				article_title ="";
				country ="";
				degree ="";
				position ="";
				link="";
				author_numbers ="";
				writer ="";
				supervisor_participation ="";
				status ="";
				shamsi_data ="";
				doi ="";
				cat = "";
				description ="";
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;

	let degrees = ['کارشناسی', 'کارشناسی ارشد', 'دکتری حرفه ای', 'دکتری تخصصی', 'هیچکدام'];
	let countries = [];
	const getCountries = async () => {
		await axios.get(`${API_URL}/getCountries`).then(function (response) {
			countries = response.data.data;
		});
	};
	getCountries();
</script>

{#if showInternational}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<SearchModal
				on:select={({ detail }) => {journal_title = detail.name ; cat = detail.cat;}}
				url="/getJournals"
				sendAll={true}
				query="&type=article&in_internal=0"
				label="عنوان مجله"
				responsive={true}
			/>
			<Input bind:val={article_title} label="عنوان مقاله" />
			<SearchSelect
				on:select={({ detail }) => (country = detail.name)}
				data={countries}
				label="نام کشور برگزار کننده"
				responsive={true}
				object={true} all={false}
			/>
			<SearchSelect
				on:select={({ detail }) => (degree = detail)}
				data={degrees}
				label="برگرفته از مقطع"
				responsive={true}
				all={false}
			/>
			<SearchSelect
				on:select={({ detail }) => (position = detail)}
				data={['اول', 'بقیه همکاران']}
				label="جایگاه فرد"
				search={false}
				all={false}
				responsive={true}
			/>
			<Input bind:val={author_numbers} label="تعداد نویسندگان" number={true}/>
			<Input bind:val={writer} label="نگارنده(گان)" />
			<SearchSelect
				on:select={({ detail }) => (supervisor_participation = detail)}
				data={['بله', 'خیر']}
				label="مشارکت استاد راهنما"
				search={false}
				all={false}
				responsive={true}
			/>
			<SearchSelect
				on:select={({ detail }) => (status = detail)}
				data={['چاپ', 'پذیرش']}
				label="وضعیت پذیرش"
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
				search={false}
				multi={true}
				all={false}
				responsive={true}
			/>
			{#if doi == '1'}
				<Input label="لینک مقاله" bind:val={link}/>
			{/if}
			<Input required={false} bind:val={description} label="توضیحات" />
			<div class=" w-full px-2 mb-4">
				<FileInput
					name="book_file"
					bind:isUploading
					label="فایل مجله"
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
