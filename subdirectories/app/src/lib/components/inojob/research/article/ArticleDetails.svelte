<script>
	import ScienceEdit from './ScienceEdit.svelte';
	export let showArticleDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showArticleEdit = false;
	export let cantAdd = false;
	import {createEventDispatcher } from 'svelte';
	import {deleteScore } from '../../../../main';
	import InternationalEdit from './InternationalEdit.svelte';
	import NationalEdit from './NationalEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	$: filter = '';
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = ( score1) => {
		filter = score1.attributes.filter;
		score = score1;
		showArticleEdit = true;
		showArticleDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
	let filters = {
		'international':'مقاله های منتشر شده / پذیرفته شده برای انتشار در نشریه های با نمایه معتبر بین المللی',
		'science':'مقاله‌هاي منتشرشده/ پذيرفته‌شده براي انتشار در نشريه‌هاي علمی - پژوهشی/ترویجی', 
		'national':'مقاله‌هاي ارائه‌شده  در همايش‌هاي معتبر علمي (داخلي و بين‌المللي)',
	};
</script>

{#if showArticleDetails}
{#if !cantAdd}
	<button
		on:click={() => {
			dispatch('handleClick');
		}}
		class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
	>
		افزودن
	</button>
	{:else}
<p>{cantAdd}</p>
	{/if}
	{#each scores as score}
		<div
			transition:slide={{ duration: 200 }}
			class="bg-table--title border border-input--border p-5 rounded-xl my-5"
		>
			<div class="flex flex-wrap">
				<DataBox label="نوع مجله" data={filters[score.attributes.filter]} responsive={false}/>
				{#if score.attributes.filter == 'international' || score.attributes.filter == 'science'}
					<DataBox label="عنوان مجله" data={score.attributes.data.journal_title} responsive={false}/>
				{:else if score.attributes.filter == 'national'}
					<DataBox label="عنوان همایش" data={score.attributes.data.event_title} />
				{/if}
				<DataBox label="عنوان مقاله" data={score.attributes.data.article_title} />
				{#if score.attributes.filter == 'international'}
					<DataBox label="نام کشور برگزار کننده" data={score.attributes.data.country} />
				{:else if score.attributes.filter == 'national'}
					<DataBox label="نام کشور برگزار کننده" data={score.attributes.data.country} />
				{/if}
				<DataBox label="برگرفته از مقطع" data={score.attributes.data.degree} />
				<DataBox label="جایگاه فرد" data={score.attributes.data.position} />
				<DataBox label="تعداد نویسندگان" data={score.attributes.data.author_numbers} />
				<DataBox label="نگارنده‌گان" data={score.attributes.data.writer} />
				<DataBox
					label="مشارکت استاد راهنما"
					data={score.attributes.data.supervisor_participation}
				/>
				{#if score.attributes.filter != 'national'}
					<DataBox label="وضعیت پذیرش" data={score.attributes.data.status} />
				{/if}
				<DataBox label="تاریخ پذیرش/چاپ" data={score.attributes.data.shamsi_data} />
				{#if score.attributes.filter == 'international'}
					<DataBox label="آيا مقاله داراي Link/DOI مي باشد؟" data={score.attributes.data.doi == '1' ? 'بله' : 'خیر'} />
				{/if}
				{#if score.attributes.filter == 'national'}
					<DataBox label="نوع مقاله" data={score.attributes.data.type} />
					<DataBox label="سطح همایش" data={score.attributes.data.level} />
					<DataBox label="برگزارکننده‌گان" data={score.attributes.data.organizer} />
					<DataBox label="نوع ارائه" data={score.attributes.data.presentaion} />
				{/if}
				{#if score.attributes.filter != 'international'}
					<DataBox label="لینک مقاله" data={score.attributes.data.link} />
				{:else}
					{#if score.attributes.data.doi == '1'}
						<DataBox label="لینک مقاله" data={score.attributes.data.link} />
					{/if}
				{/if}
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
				{#if score.attributes.file2}
					<DownloadBox url={score.attributes.file2} />
				{/if}
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showArticleEdit}
	{#if filter == "international"}
		<div transition:fade={{duration:300}}>
			<InternationalEdit {showArticleEdit} on:handleClickCancel={()=>{showArticleDetails = true; showArticleEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showArticleDetails = true; showArticleEdit = false;}}/>
		</div>
	{:else if filter == 'national'}
		<div transition:fade={{duration:300}}>
			<NationalEdit {showArticleEdit} on:handleClickCancel={()=>{showArticleDetails = true; showArticleEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showArticleDetails = true; showArticleEdit = false;}}/>
		</div>
	{:else if filter == 'scienec'}
		<div transition:fade={{duration:300}}>
			<ScienceEdit {showArticleEdit} on:handleClickCancel={()=>{showArticleDetails = true; showArticleEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showArticleDetails = true; showArticleEdit = false;}}/>
		</div>
	{/if}
{/if}
