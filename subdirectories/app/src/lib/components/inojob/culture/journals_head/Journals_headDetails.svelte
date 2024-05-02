<script>
	export let showJournals_headDetails;
	import { fade, slide } from 'svelte/transition';
	import Journals_headEdit from './Journals_headEdit.svelte';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showJournals_headEdit = false;
	import {createEventDispatcher} from 'svelte';
	import {deleteScore } from '../../../../main';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showJournals_headEdit = true;
		showJournals_headDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showJournals_headDetails}
	<button
		on:click={() => {
			dispatch('handleClick');
		}}
		class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
	>
		افزودن
	</button>
	{#each scores as score}
		<div
			transition:slide={{ duration: 200 }}
			class="bg-table--title border border-input--border p-5 rounded-xl my-5"
		>
			<div class="flex flex-wrap">
				<DataBox label="نام نشریه علمی" data={score.attributes.data.journal} />
				<DataBox label="نوع نشریه" data={score.attributes.data.type} />
				<DataBox label="نام انجمن" data={score.attributes.data.assoc} />
				<DataBox label="تاریخ شروع عضویت" data={score.attributes.data.start_date} />
				<DataBox label="تاریخ پایان عضویت" data={score.attributes.data.end_date} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showJournals_headEdit}
<div transition:fade={{duration:300}}>
	<Journals_headEdit {showJournals_headEdit} on:handleClickCancel={()=>{showJournals_headDetails = true; showJournals_headEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showJournals_headDetails = true; showJournals_headEdit = false;}}/>
</div>
{/if}
