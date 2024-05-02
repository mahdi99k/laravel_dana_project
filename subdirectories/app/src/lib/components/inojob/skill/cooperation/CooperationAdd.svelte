<script>
	import Input from '../../../forms/Input.svelte';
	import SearchSelect from '../../../forms/SearchSelect.svelte';
	import FileInput from '../../../forms/FileInput.svelte';
	import axios from 'axios';
	import { API_URL, closeLoading, getCookie, loading } from '../../../../main';
	import { fade } from 'svelte/transition';
	export let showCooperationAdd;
	export let scores;
	export let updated = false;
	let isUploading = false;
	let error = false;
	let title,
		institute,
		start_date,
		approve_date,
		end_date,
		position,
		person_amounts,
		price,
		supervisor_participation,
		description;
	import { createEventDispatcher } from 'svelte';
	import DateInput from '../../../forms/DateInput.svelte';
	let dispatch = createEventDispatcher();
	let myBtn;

	let majors = ['test'];
	function createBtn(node) {
		myBtn = node;
	}

	const handleClickSave = async () => {
		error = false;
		if (
			!title ||
			// !institute ||
			!start_date ||
			!approve_date ||
			!end_date ||
			!position ||
			!person_amounts ||
			!price ||
			!supervisor_participation
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
		let data = {
			title,
			// institute,
			start_date,
			approve_date,
			end_date,
			position,
			person_amounts,
			price,
			supervisor_participation,
			description
		};
		const api_token = getCookie('api_token');
		let params = {
			filter: null,
			cert: 'skill',
			type: 'cooperation',
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
				institute = '';
				start_date = '';
				approve_date = '';
				end_date = '';
				position = '';
				person_amounts = '';
				price = '';
				supervisor_participation = '';
				description = '';
			});
	};
	const handleClickCancel = () => {
		dispatch('handleClick');
	};

	//SEND FILE
	let file1 = false;
</script>

{#if showCooperationAdd}
	<form
		on:submit|preventDefault={handleClickSave}
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
	>
		<div class="flex flex-wrap pb-20">
			<Input bind:val={title} label="عنوان طرح" />
			<DateInput bind:val={start_date} label="تاریخ شروع" />
			<DateInput bind:val={approve_date} label="تاریخ تصویب" />
			<DateInput bind:val={end_date} label="تاریخ پایان" />
			<SearchSelect
				on:select={({ detail }) => (position = detail)}
				data={['اول', 'بقیه همکاران']}
				label="جایگاه فرد"
				search={false}
				all={false}
				responsive={true}
			/>
			<Input bind:val={person_amounts} label="تعداد کل افراد شرکت کننده" />
			<Input bind:val={price} label="مبلغ طرح (ریال)" />
			<SearchSelect
				on:select={({ detail }) => (supervisor_participation = detail)}
				data={['بله', 'خیر']}
				search={true}
				all={false}
				responsive={true}
				label="با مشارکت استاد راهنما"
			/>
			<Input required={false} bind:val={description} label="توضیح نوع فعالیت " />
			<div class="w-full px-2 mb-4">
				<FileInput
					name="cooperation_file"
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
