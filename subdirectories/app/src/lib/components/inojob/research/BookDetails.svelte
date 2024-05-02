<script>
	import BookEdit from './BookEdit.svelte';
	export let showBookDetails;
	import { fade, slide } from 'svelte/transition';
	$: score = [];
	export let showBookEdit = false;
	export let cantAdd;
	import { deleteScore } from '../../../main';
	import DataBox from '../DataBox.svelte';
	import DownloadBox from '../DownloadBox.svelte';
	import { createEventDispatcher } from 'svelte';
	import ScoreDeletEdit from '../ScoreDeletEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showBookEdit = true;
		showBookDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showBookDetails}
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
				<DataBox label="عنوان کتاب" data={score.attributes.data.title} />
				<DataBox label="جایگاه فرد" data={score.attributes.data.position} />
				<DataBox label="تعداد نویسندگان" data={score.attributes.data.author_numbers} />
				<DataBox
					label="مشارکت استاد راهنما"
					data={score.attributes.data.supervisor_participation}
				/>
				<DataBox label="اثر برگزیده" data={score.attributes.data.selected_type} />
				<DataBox label="بخش" data={score.attributes.data.unit} />
				<DataBox label="نام ناشر" data={score.attributes.data.publisher} />
				<DataBox label="سال انتشار" data={score.attributes.data.year} />
				<DataBox label="میزان مشارکت" data={score.attributes.data.participation} />
				<DataBox label="شابک" data={score.attributes.data.isbn} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}

{#if showBookEdit}
<div transition:fade={{duration:300}}>
	<BookEdit {showBookEdit} on:handleClickCancel={()=>{showBookDetails = true; showBookEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showBookDetails = true; showBookEdit = false;}}/>
</div>
{/if}
