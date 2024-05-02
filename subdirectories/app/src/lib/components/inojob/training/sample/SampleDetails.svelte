<script>
	export let showSampleDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showSampleEdit = false;
	import { createEventDispatcher } from 'svelte';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	import SampleEdit from './SampleEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showSampleEdit = true;
		showSampleDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showSampleDetails}
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
				<DataBox label="رشته" data={score.attributes.data.major} />
				<DataBox label="سال" data={score.attributes.data.year} />
				<DataBox label="نام دانشگاه" data={score.attributes.data.university} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showSampleEdit}
<div transition:fade={{duration:300}}>
	<SampleEdit {showSampleEdit} on:handleClickCancel={()=>{showSampleDetails = true; showSampleEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showSampleDetails = true; showSampleEdit = false;}}/>
</div>
{/if}
