<script>
	export let showOtherDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from './../DownloadBox.svelte';
	import DataBox from './../DataBox.svelte';
	$: score = [];
	export let showOtherEdit = false;
	import { createEventDispatcher } from 'svelte';
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../main';
	import OtherEdit from './OtherEdit.svelte';
	import ScoreDeletEdit from '../ScoreDeletEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showOtherEdit = true;
		showOtherDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showOtherDetails}
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
				<DataBox label="سال" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="توضیحات متقاضی" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showOtherEdit}
<div transition:fade={{duration:300}}>
	<OtherEdit {showOtherEdit} on:handleClickCancel={()=>{showOtherDetails = true; showOtherEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showOtherDetails = true; showOtherEdit = false;}}/>
</div>
{/if}
