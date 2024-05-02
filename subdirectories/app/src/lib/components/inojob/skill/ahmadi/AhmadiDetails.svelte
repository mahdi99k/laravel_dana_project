<script>
	export let showAhmadiDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	let score;
	import {createEventDispatcher} from 'svelte';
	import  {deleteScore} from '../../../../main';
	import AhmadiEdit from './AhmadiEdit.svelte';
	let dispatch = createEventDispatcher();
	$: score = [];
	export let showAhmadiEdit = false;
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showAhmadiEdit = true;
		showAhmadiDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showAhmadiDetails}
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
				<DataBox label="عنوان فعالیت" data={score.attributes.data.title} />
				<DataBox label="امتیاز کسب شده" data={score.attributes.data.score_item} />
				<DataBox label="سال" data={score.attributes.data.year} />

				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showAhmadiEdit}
<div transition:fade={{duration:300}}>
	<AhmadiEdit {showAhmadiEdit} on:handleClickCancel={()=>{showAhmadiDetails = true; showAhmadiEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showAhmadiDetails = true; showAhmadiEdit = false;}}/>
</div>
{/if}
