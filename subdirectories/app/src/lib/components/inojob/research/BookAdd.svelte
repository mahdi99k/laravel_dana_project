<script>
	import Input from '../../forms/Input.svelte';
	import SearchSelect from '../../forms/SearchSelect.svelte';
	import axios from 'axios';
	import { API_URL, getCookie, closeLoading, loading, YEARS } from '../../../main';
	import { fade } from 'svelte/transition';
	export let showBookAdd;
	export let scores;
	export let cantAdd;
	let isUploading = false;
	let title,
		position,
		author_numbers,
		supervisor_participation,
		selected_type,
		unit,
		publisher,
		year,
		participation,
		isbn,
		description;
	selected_type = '';
	import { createEventDispatcher } from 'svelte';
	import FileInput from '../../forms/FileInput.svelte';
	import SearchModal from '../../modals/SearchModal.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;
	let error = false;
	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (
			!title ||
			!position ||
			!author_numbers ||
			!supervisor_participation ||
			!selected_type ||
			selected_type == '' ||
			(selected_type.startsWith('کتاب') && !unit) ||
			!publisher ||
			!year ||
			!participation ||
			!isbn
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
			title,
			position,
			author_numbers,
			supervisor_participation,
			selected_type,
			unit,
			publisher,
			year,
			participation,
			isbn,
			description
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'research',
			type: 'book',
			data,
			file1
		};
		await axios
			.post(`${API_URL}/addScore`, params, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				cantAdd = response.data.cantAdd;
				scores = [response.data.data, ...scores];
				dispatch('handleClick');
				title = '';
				position = '';
				author_numbers = '';
				supervisor_participation = '';
				selected_type = '';
				unit = '';
				publisher = '';
				year = '';
				participation = '';
				isbn = '';
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};
	//SEND FILE
	let file1 = false;
</script>

{#if showBookAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<Input bind:val={title} label="عنوان کتاب" />
			<SearchSelect
				on:select={({ detail }) => (position = detail)}
				data={['اول', 'بقیه همکاران']}
				label="جایگاه فرد"
				search={false}
				all={false}
				responsive={true}
			/>
			<SearchSelect
				on:select={({ detail }) => (selected_type = detail)}
				data={['کتاب سال جمهوری اسلامی', 'کتاب سال حوزه', 'هیچکدام']}
				label="اثر برگزیده"
				search={false}
				all={false}
				responsive={true}
			/>

			<SearchSelect
				label="میزان مشارکت"
				on:select={({ detail }) => (participation = detail)}
				required={true}
				responsive={true}
				search={true}
				all={false}
				data={['نگارش کتاب کامل علمی', 'نگارش فصل کتاب علمی', 'ترجمه کتاب علمی']}
			/>
			{#if selected_type.startsWith('کتاب')}
				<SearchSelect
					on:select={({ detail }) => (unit = detail)}
					data={['تالیف برگزیده', 'تالیف شایسته تقدیر', 'ترجمه برگزیده', 'ترجمه شایسته تقدیر']}
					label="بخش"
					search={false}
					all={false}
					responsive={true}
				/>
			{/if}
			<Input bind:val={author_numbers} label="تعداد نویسندگان" />
			<SearchSelect
				on:select={({ detail }) => (supervisor_participation = detail)}
				data={['بله', 'خیر']}
				label="مشارکت استاد راهنما"
				search={false}
				all={false}
				responsive={true}
			/>
			<SearchModal
				on:select={({ detail }) => (publisher = detail)}
				url="/getJournals"
				query="&type=book"
				label="نام ناشر"
				responsive={true}
			/>
			<SearchSelect
				label="سال انتشار"
				on:select={({ detail }) => (year = detail)}
				required={true}
				responsive={true}
				search={true}
				all={false}
				data={YEARS}
			/>
			<!-- <Input bind:val={participation} label="میزان مشارکت" /> -->
			<Input bind:val={isbn} label="شابک" />
			<Input required={false} bind:val={description} label="توضیحات" />
			<div class="w-full px-2 mb-4">
				<FileInput
					name="book_file"
					bind:isUploading
					label="فایل کتاب"
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
