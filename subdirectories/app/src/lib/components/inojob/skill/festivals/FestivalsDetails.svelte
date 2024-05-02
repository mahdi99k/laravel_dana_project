<script>
	export let showFestivalsDetails;
	import { fade, slide } from 'svelte/transition';
	$: score = [];
	export let showFestivalsEdit = false;
	import { afterUpdate, createEventDispatcher, onMount } from 'svelte';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	import FestivalsEdit from './FestivalsEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showFestivalsEdit = true;
		showFestivalsDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showFestivalsDetails}
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
				<DataBox
					label="عنوان جشنواره"
					data={`${score.attributes.data.type} - ${score.attributes.data.level}`}
				/>
				<DataBox label="زمینه یا رشته" data={score.attributes.data.major} />
				<DataBox label="سال ورود" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="میزان مشارکت" data={score.attributes.data.participation} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit
				on:editThis={() => editThis(score)}
				on:deleteThis={() => deleteThis(score.id)}
				status={score.attributes.status}
			/>
		</div>
	{/each}
{/if}
{#if showFestivalsEdit}
	<div transition:fade={{ duration: 300 }}>
		<FestivalsEdit
			{showFestivalsEdit}
			on:handleClickCancel={() => {
				showFestivalsDetails = true;
				showFestivalsEdit = false;
			}}
			bind:score
			on:handleClick={({ detail }) => {
				editData(detail);
				showFestivalsDetails = true;
				showFestivalsEdit = false;
			}}
		/>
	</div>
{/if}
