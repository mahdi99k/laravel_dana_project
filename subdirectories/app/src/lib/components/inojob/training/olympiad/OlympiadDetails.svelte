<script>
	export let showOlympiadDetails;
	import { slide, fade } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showOlympiadEdit = false;
	import { createEventDispatcher } from 'svelte';
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	import OlympiadEdit from './OlympiadEdit.svelte';
	let dispatch = createEventDispatcher();
	let types = {
		uni: 'دانشجویی',
		school: 'دانش آموزی'
	};
	async function getScores() {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/training/olympiad`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				// console.log(scores);
			});
	}
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showOlympiadEdit = true;
		showOlympiadDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showOlympiadDetails}
	<button
		on:click={() => {
			dispatch('handleClick');
		}}
		class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
	>
		افزودن المپیاد
	</button>
	{#each scores as score}
		<div
			transition:slide={{ duration: 200 }}
			class="bg-table--title border border-input--border p-5 rounded-xl my-5"
		>
			<div class="flex flex-wrap">
				<DataBox label="نوع المپیاد" data={types[score.attributes.filter]} />
				<DataBox label="رشته" data={score.attributes.data.major} />
				<DataBox label="سطح المپیاد" data={score.attributes.data.level} />
				<DataBox label="سال برگزاری" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				{#if score.attributes.filter == 'uni'}
					<DataBox label="وزارت" data={score.attributes.data.ministry} />
				{/if}
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}
{#if showOlympiadEdit}
<div transition:fade={{duration:300}}>
	<OlympiadEdit {showOlympiadEdit} on:handleClickCancel={()=>{showOlympiadDetails = true; showOlympiadEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showOlympiadDetails = true; showOlympiadEdit = false;}}/>
</div>
{/if}
