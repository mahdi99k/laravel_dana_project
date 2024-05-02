<script>
	import CooperationEdit from './CooperationEdit.svelte';
	export let showCooperationDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showCooperationEdit = false;
	import { createEventDispatcher } from 'svelte';
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
		showCooperationEdit = true;
		showCooperationDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showCooperationDetails}
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
				<DataBox label="نام طرح" data={score.attributes.data.title} />
				<!-- <DataBox label="نام موسسه" data={score.attributes.data.institute} /> -->
				<DataBox label="تاریخ شروع" data={score.attributes.data.start_date} />
				<DataBox label="تاریخ تصویب" data={score.attributes.data.approve_date} />
				<DataBox label="تاریخ پایان" data={score.attributes.data.end_date} />
				<DataBox label="جایگاه فرد در طرح" data={score.attributes.data.position} />
				<DataBox label="تعداد کل افراد مشارکت‌کننده" data={score.attributes.data.person_amounts} />
				<DataBox label="مبلغ طرح(ریال)" data={score.attributes.data.price} />
				<DataBox
					label="با مشارکت استاد ارهنما"
					data={score.attributes.data.supervisor_participation}
				/>
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
{#if showCooperationEdit}
	<div transition:fade={{ duration: 300 }}>
		<CooperationEdit
			{showCooperationEdit}
			on:handleClickCancel={() => {
				showCooperationDetails = true;
				showCooperationEdit = false;
			}}
			bind:score
			on:handleClick={({ detail }) => {
				editData(detail);
				showCooperationDetails = true;
				showCooperationEdit = false;
			}}
		/>
	</div>
{/if}
