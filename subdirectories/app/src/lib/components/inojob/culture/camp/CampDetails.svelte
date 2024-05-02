<script>
	import CampEdit from './CampEdit.svelte';
	export let showCampDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showCampEdit = false;
	import {createEventDispatcher } from 'svelte';
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showCampEdit = true;
		showCampDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
	console.log(scores);
</script>

{#if showCampDetails}
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
				<DataBox label="نام گروه جهادی" data={score.attributes.data.group} />
				<DataBox label="تاریخ شروع اردو" data={score.attributes.data.start_date} />
				<DataBox label="تاریخ پایان اردو" data={score.attributes.data.end_date} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showCampEdit}
<div transition:fade={{duration:300}}>
	<CampEdit {showCampEdit} on:handleClickCancel={()=>{showCampDetails = true; showCampEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showCampDetails = true; showCampEdit = false;}}/>
</div>
{/if}
