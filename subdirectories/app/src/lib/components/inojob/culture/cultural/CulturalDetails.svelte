<script>
	export let showCulturalDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showCulturalEdit = false;
	import { createEventDispatcher } from 'svelte';
	import { deleteScore } from '../../../../main';
	import CulturalEdit from './CulturalEdit.svelte';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showCulturalEdit = true;
		showCulturalDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showCulturalDetails}
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
				<DataBox label="نحوه شرکت" data={score.attributes.data.type} />
				<DataBox label="تاريخ شروع عضویت" data={score.attributes.data.start_date} />
				<DataBox label="تاريخ پایان عضویت" data={score.attributes.data.end_date} />
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
{#if showCulturalEdit}
	<div transition:fade={{ duration: 300 }}>
		<CulturalEdit
			{showCulturalEdit}
			on:handleClickCancel={() => {
				showCulturalDetails = true;
				showCulturalEdit = false;
			}}
			bind:score
			on:handleClick={({ detail }) => {
				editData(detail);
				showCulturalDetails = true;
				showCulturalEdit = false;
			}}
		/>
	</div>
{/if}
