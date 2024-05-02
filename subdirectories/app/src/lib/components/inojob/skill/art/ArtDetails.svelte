<script>
	import ArtEdit from './ArtEdit.svelte';
	export let showArtDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showArtEdit = false;
	import { createEventDispatcher } from 'svelte';
	import { deleteScore } from '../../../../main';
	let dispatch = createEventDispatcher();
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showArtEdit = true;
		showArtDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showArtDetails}
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
				<DataBox label="سال برگزیدگی" data={score.attributes.data.year} />
				<DataBox label="نوع برگزیدگی" data={score.attributes.data.choise} />
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
{#if showArtEdit}
	<div transition:fade={{ duration: 300 }}>
		<ArtEdit
			{showArtEdit}
			on:handleClickCancel={() => {
				showArtDetails = true;
				showArtEdit = false;
			}}
			bind:score
			on:handleClick={({ detail }) => {
				editData(detail);
				showArtDetails = true;
				showArtEdit = false;
			}}
		/>
	</div>
{/if}
