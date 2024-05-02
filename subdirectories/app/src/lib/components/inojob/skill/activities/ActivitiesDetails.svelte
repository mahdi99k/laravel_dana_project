<script>
	export let showActivitiesDetails;
	import { fade, slide } from 'svelte/transition';
	import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
	import { deleteScore } from '../../../../main';
	import ActivitiesEdit from './ActivitiesEdit.svelte';
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	$: score = [];
	export let showActivitiesEdit = false;
	export let scores = [];
	const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
	const editThis = (detail) => {
		console.log(detail);
		score = detail;
		showActivitiesEdit = true;
		showActivitiesDetails = false;
	};
	const editData = (detail) => {
		scores[scores.indexOf(score)] = detail;
		console.log(scores[scores.indexOf(score)], detail);
	};
</script>

{#if showActivitiesDetails}
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
				<DataBox label="نوع فعالیت" data={score.attributes.data.activity_type} />
				{#if score.attributes.filter == 'employment'}
					<DataBox label="تعداد شایستگی برتر" data={score.attributes.data.best_amount} />
				{:else if score.attributes.filter == 'knowledge'}
					<DataBox label="سهم مشارکت<" data={score.attributes.data.participation} />
					<DataBox label="نام محصول" data={score.attributes.data.name} />
					<!-- <DataBox label="رتبه" data={score.attributes.data.rank} /> -->
					<DataBox label="سال تولید" data={score.attributes.data.production_year} />
					<DataBox label="میزان تولید" data={score.attributes.data.production_level} />
				{:else if score.attributes.filter == 'experience'}
					<DataBox label="تاریخ شروع" data={score.attributes.data.start_date} />
					<DataBox label="تاریخ پایان" data={score.attributes.data.end_date} />
					<DataBox label="نام شرکت/سازمان" data={score.attributes.data.company} />
					<DataBox label="نوع فعاليت در شرکت/سازمان" data={score.attributes.data.act_type} />
					{#if score.attributes.data.contract.includes('سایر')}
						<DataBox label="نوع قرارداد" data={score.attributes.data.contract_details} />
					{:else}
						<DataBox label="نوع قرارداد" data={score.attributes.data.contract} />
					{/if}
					<DataBox label="عنوان پست سازمانی" data={score.attributes.data.post} />
				{:else if score.attributes.filter == 'postdoctor'}
					<DataBox label="نوع دوره" data={score.attributes.data.type} />
					<DataBox label="تاریخ شروع" data={score.attributes.data.start_date} />
					<DataBox label="تاریخ پایان" data={score.attributes.data.end_date} />
					<DataBox label="وضعیت تایید دوره" data={score.attributes.data.status} />
				{:else if score.attributes.filter == 'base_certificate' || score.attributes.filter == 'pro_certificate'}
					<DataBox
						label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
						data={score.attributes.data.hour}
					/>
					<DataBox label="نام دوره" data={score.attributes.data.course} />
					<DataBox label="مرکز برگزارکننده دوره" data={score.attributes.data.place} />
				{:else if score.attributes.filter == 'assistant'}
					<DataBox label="سال تحصیل(با فرمت  1402)" data={score.attributes.data.edu_year} />
					<DataBox
						label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
						data={score.attributes.data.hour}
					/>
					<DataBox label="نیم سال تحصیلی" data={score.attributes.data.half_year} />
				{:else if score.attributes.filter == 'internship'}
					<DataBox label="نوع برنامه" data={score.attributes.data.plan} />
					<DataBox label="عنوان برنامه" data={score.attributes.data.title} />
					<DataBox label="تاریخ شروع " data={score.attributes.data.start_date} />
					<DataBox label="تاریخ پایان" data={score.attributes.data.end_date} />
					<DataBox
						label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
						data={score.attributes.data.hour}
					/>
				{:else if score.attributes.filter == 'history'}
					<DataBox label="محل تدریس" data={score.attributes.data.place} />
					<DataBox label="نیم سال تحصیلی" data={score.attributes.data.half_year} />
					<DataBox label="سال تحصیلی" data={score.attributes.data.year} />
					<DataBox
						label="تعداد ساعت فعاليت،همکاري يا حضور در دوره:(به عدد)"
						data={score.attributes.data.hour}
					/>
				{:else if score.attributes.filter == 'skill_comp'}
					<DataBox label="عنوان مسابقه" data={score.attributes.data.title} />
					<DataBox label="رتبه" data={score.attributes.data.rank} />
					<DataBox label="تاریخ برگزاری" data={score.attributes.data.date} />
					<!-- <DataBox label="سهم مشارکت" data={score.attributes.data.participation} /> -->
				{/if}

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
{#if showActivitiesEdit}
	<div transition:fade={{ duration: 300 }}>
		<ActivitiesEdit
			{showActivitiesEdit}
			on:handleClickCancel={() => {
				showActivitiesDetails = true;
				showActivitiesEdit = false;
			}}
			bind:score
			on:handleClick={({ detail }) => {
				editData(detail);
				showActivitiesDetails = true;
				showActivitiesEdit = false;
			}}
		/>
	</div>
{/if}
