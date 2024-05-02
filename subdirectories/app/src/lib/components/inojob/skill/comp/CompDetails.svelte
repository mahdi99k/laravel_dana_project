<script>
	export let showCompDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	$: score = [];
	export let showCompEdit = false;
	import { createEventDispatcher } from 'svelte';
	import {deleteScore } from '../../../../main';
	import CompEdit from './CompEdit.svelte';
	let dispatch = createEventDispatcher();
	let titles = {
		'robocup': 'مسابقات بین المللی ربوکاپ آزاد ایران ',
		'nano_uni': 'مسابقه ملی فناوری نانو(دانشجویی)',
		'nano_school': 'المپیاد دانش آموزی علوم و فناوری نانو',
		'tech': 'مجموعه رقابت های تخصصی فناورد',
		'technology': 'برگزیدگی در مسابقات فناورانه',
		'bahaei': 'جشنواره شیخ بهایی(فن آفرینی)'
	};
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showCompEdit = true;
		showCompDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showCompDetails}
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
				<DataBox label="عنوان مسابقه" data={titles[score.attributes.data.title]} />
				{#if score.attributes.data.title == 'robocup' || score.attributes.data.title == 'nano_uni' || score.attributes.data.title == 'tech'}
					<DataBox label="عنوان طرح" data={score.attributes.data.idea} />
				{/if}
				{#if score.attributes.data.title == 'robocup' || score.attributes.data.title == 'bahaei'}
					<DataBox label="بخش" data={score.attributes.data.unit} />
				{/if}
				<DataBox label="زمینه" data={score.attributes.data.idea} />
				{#if score.attributes.data.title == 'technology'}
					<DataBox label="نوع مسابقه" data={score.attributes.data.comp_type} />
				{/if}
				<DataBox label="سال" data={score.attributes.data.year} />
				<DataBox label="رتبه" data={score.attributes.data.rank} />
				<DataBox label="میزان مشارکت(درصد)" data={score.attributes.data.participation} />
				<DownloadBox url={score.attributes.file1} />
			</div>
			<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
		</div>
	{/each}
{/if}

{#if showCompEdit}
<div transition:fade={{duration:300}}>
	<CompEdit {showCompEdit} on:handleClickCancel={()=>{showCompDetails = true; showCompEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showCompDetails = true; showCompEdit = false;}}/>
</div>
{/if}
