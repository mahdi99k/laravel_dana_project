<script>
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	export let showEduDetails;
	import { fade, slide } from 'svelte/transition';
	export let showEduEdit = false;
	import {createEventDispatcher } from 'svelte';
	import {deleteScore } from '../../../../main';
	import EduEdit from './EduEdit.svelte';
	$: score = [];
	let dispatch = createEventDispatcher();
	let degrees = {
		associate: 'کاردانی',
		mullah2: 'سطح دو حوزه',
		mullah3: 'سطح سه حوزه',
		mullah4: 'سطح چهار حوزه',
		bachelor: 'کارشناسی',
		master: 'کارشناسی ارشد',
		con_master: 'کارشناسی ارشد پیوسته',
		pro_doctor: 'دکتری حرفه ای',
		phd: 'دکتری تخصصی'
	};
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		score = detail;
		showEduEdit = true;
		showEduDetails = false;
	}
	const editData = (detail)=>{
		scores[scores.indexOf(score)]  =detail;
		console.log(scores[scores.indexOf(score)] , detail);
	}

	console.log('eeeeeeeeee' , scores);
</script>

{#if showEduDetails}
	<div transition:slide={{ duration: 200 }}>
		<button
			on:click={() => {
				dispatch('handleClick');
			}}
			class="rounded-xl block w-full bg--primary text-lg h-14 text-white"
		>
			افزودن سابقه تحصیلی
		</button>
		{#each scores as score}
			<div
				transition:slide={{ duration: 200 }}
				class="bg-table--title border border-input--border p-5 rounded-xl my-5" id="score-{score.id}"
			>
				<div class="flex flex-wrap">
					<DataBox label="مقطع تحصیلی" data={degrees[score.attributes.filter]} />
					<DataBox label="رشته تحصیلی " data={score.attributes.data.major} />
					<DataBox label="نام دانشگاه" data={score.attributes.data.university} />
					<DataBox label="گرایش" data={score.attributes.data.oriantation} />
					<DataBox label="رتبه پذیرش" data={score.attributes.data.rank} />
					<DataBox label="ورودی نیم سال" data={score.attributes.data.entry_half} />
					<DataBox label="سال شروع تحصیل" data={score.attributes.data.entry_year} />
					<DataBox label="تعداد واحدهای گذرانده" data={score.attributes.data.unit_numbers} />
					<DataBox label="معدل" data={score.attributes.data.gpa} />
					{#if score.attributes.data.country.includes('ایران') }
						<DataBox
							label="استان و شهر محل تحصیل"
							data={`${score.attributes.data.province} - ${score.attributes.data.city}`}
						/>
					{/if}
					<DataBox label="کشور محل تحصیل" data={score.attributes.data.country} />
					<DataBox label="وضعیت تحصیلی" data={score.attributes.data.status} />

					{#if score.attributes.filter != 'mullah2' && score.attributes.filter != 'mullah3' && score.attributes.filter != 'mullah4' && score.attributes.filter != 'associate' && score.attributes.filter != 'diploma' && score.attributes.filter != ''}
						<DataBox label="استاد" data={score.attributes.data.teacher} />
						<DataBox label="مشاور" data={score.attributes.data.supervisor} />
						<DataBox label="صورت جلسه دفاع" data={score.attributes.data.defense} />
						<DataBox label="نام پایان نامه" data={score.attributes.data.thesis} />
					{/if}
					{#if score.attributes.filter== 'phd'}
						<DataBox label="نوع دوره" data={score.attributes.data.course_type} />
					{/if}
					<DownloadBox url={score.attributes.file1} />
					<DownloadBox url={score.attributes.file2} />
				</div>
				<ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
			</div>
		{/each}
	</div>
{/if}
{#if showEduEdit}
	<div transition:fade={{duration:300}}>
		<EduEdit {showEduEdit} on:handleClickCancel={()=>{showEduDetails = true; showEduEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showEduDetails = true; showEduEdit = false;}}/>
	</div>
{/if}

