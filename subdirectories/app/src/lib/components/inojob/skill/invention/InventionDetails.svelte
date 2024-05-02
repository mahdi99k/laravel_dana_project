<script>
	import InventionEdit from './InventionEdit.svelte';
	export let showInventionDetails;
	import { fade, slide } from 'svelte/transition';
	let score;
	import { createEventDispatcher } from 'svelte';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	import { deleteScore } from '../../../../main';
	let dispatch = createEventDispatcher();
	$: score = [];
	export let showInventionEdit = false;

	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showInventionEdit = true;
		showInventionDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showInventionDetails}
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
				<DataBox label="عنوان اختراع" data={score.attributes.data.title} />
				<DataBox label="سطح اختراع" data={score.attributes.data.level} />
				<DataBox label="شماره ثبت اختراع" data={score.attributes.data.number} />
				<DataBox label="تاریخ ثبت اختراع" data={score.attributes.data.patent_data} />
				<DataBox label="سال برگزیدگی" data={score.attributes.data.year} />
				<DataBox label="سهم مشارکت(درصد)" data={score.attributes.data.participation} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}

{#if showInventionEdit}
<div transition:fade={{duration:300}}>
	<InventionEdit {showInventionEdit} on:handleClickCancel={()=>{showInventionDetails = true; showInventionEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showInventionDetails = true; showInventionEdit = false;}}/>
</div>
{/if}
