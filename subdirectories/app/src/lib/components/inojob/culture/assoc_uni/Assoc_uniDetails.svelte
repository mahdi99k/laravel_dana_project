<script>
	export let showAssoc_uniDetails;
	import Assoc_uniEdit from './Assoc_uniEdit.svelte';
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showAssoc_uniEdit = false;
	import { createEventDispatcher } from 'svelte';
	import {deleteScore } from '../../../../main';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showAssoc_uniEdit = true;
		showAssoc_uniDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showAssoc_uniDetails}
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
				<DataBox label="نام انجمن" data={score.attributes.data.assoc} />
				<DataBox label="تاریخ شروع عضویت" data={score.attributes.data.start_date} />
				<DataBox label="تاریخ پایان عضویت" data={score.attributes.data.end_date} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showAssoc_uniEdit}
<div transition:fade={{duration:300}}>
	<Assoc_uniEdit {showAssoc_uniEdit} on:handleClickCancel={()=>{showAssoc_uniDetails = true; showAssoc_uniEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showAssoc_uniDetails = true; showAssoc_uniEdit = false;}}/>
</div>
{/if}

