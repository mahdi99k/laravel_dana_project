<script>
	export let showBabaeiDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showBabaeiEdit = false;
	import { createEventDispatcher } from 'svelte';
	import {deleteScore} from '../../../../main';
	import BabaeiEdit from './BabaeiEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showBabaeiEdit = true;
		showBabaeiDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showBabaeiDetails}
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
				<DataBox label="عنوان طرح" data={score.attributes.data.title} />
				<DataBox label="بخش" data={score.attributes.data.unit} />
				<DataBox label="سال" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}

{#if showBabaeiEdit}
<div transition:fade={{duration:300}}>
	<BabaeiEdit {showBabaeiEdit} on:handleClickCancel={()=>{showBabaeiDetails = true; showBabaeiEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showBabaeiDetails = true; showBabaeiEdit = false;}}/>
</div>
{/if}
