<script>
	export let showMedicalDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	import {createEventDispatcher} from 'svelte';
	export let showMedicalEdit = false;
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	import MedicalEdit from './MedicalEdit.svelte';
	let dispatch = createEventDispatcher();
	let types = {
		'1': 'آزمون‌های جامع علوم پایه',
		'2': 'آزمون پیش کارورزی پزشکی',
		'3': 'آزمون پذیرش دستیاری (رشته های پزشکی)'
	};
	const handleClick = () => {
		dispatch('handleClick');
	};
	async function getScores() {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/training/medical`, {
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
		showMedicalEdit = true;
		showMedicalDetails = false;
	}
	const editData = (detail)=>{
		scores[scores.indexOf(score)]  =detail;
		console.log(scores[scores.indexOf(score)] , detail);
	}

</script>

{#if showMedicalDetails}
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
				<DataBox label="نوع آزمون" data={types[score.attributes.filter]} />
				<DataBox label="رشته" data={score.attributes.data.major} />
				<DataBox label="سال برگزاری" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="توضیحات" data={score.attributes.data.description} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>

		</div>
	{/each}
{/if}
{#if showMedicalEdit}
	<div transition:fade={{duration:300}}>
		<MedicalEdit {showMedicalEdit} on:handleClickCancel={()=>{showMedicalDetails = true; showMedicalEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showMedicalDetails = true; showMedicalEdit = false;}}/>
	</div>
{/if}