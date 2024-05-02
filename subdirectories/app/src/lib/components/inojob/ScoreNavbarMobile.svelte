<script>
	import BottomModal from './../modals/BottomModal.svelte';
	import { Modals, closeModal, openModal, modals } from 'svelte-modals';
	import { slide } from 'svelte/transition';
	let showModal = false;
	$: slider = 1;
	let barTitle = 'educationBar';
	let barModal = false;
	export let scores_num;
	import { page } from '$app/stores';
	import { afterUpdate, onMount } from 'svelte';
	$: pageName = '';
	let updated_first = false;
	let updated_slider = false;
	afterUpdate(() => {
		pageName = $page.url.pathname;
		if (pageName.includes('edu')) {
			if (!updated_first) {
				barTitle = 'educationBar';
				slider = 1;
				updated_first = true;
			}
		} else {
			updated_first = false;
		}
		console.log(updated_first, 'bef', updated_slider, pageName.includes('edu'));
		if (!updated_slider) {
			if (pageName.includes('training')) {
				barTitle = 'educationBar';
				slider = 1;
			} else if (pageName.includes('research')) {
				barTitle = 'researchBar';
				slider = 2;
			} else if (pageName.includes('skill')) {
				barTitle = 'skillBar';
				slider = 3;
			} else if (pageName.includes('culture')) {
				barTitle = 'cultureBar';
				slider = 4;
			} else if (pageName.includes('other')) {
				barTitle = 'otherBar';
				slider = 5;
			}
			updated_slider = true;
		}
		console.log(updated_slider, barTitle, 'sssssssssaaaaaaaa');
	});
	const Slide = (type) => {
		if (type == 'next') {
			if (slider == 5) slider = 1;
			else slider += 1;
		} else {
			if (slider == 1) slider = 5;
			else slider += -1;
		}
		console.log(slider);
		switch (slider) {
			case 1:
				barTitle = 'educationBar';
				break;
			case 2:
				barTitle = 'researchBar';
				break;
			case 3:
				barTitle = 'skillBar';
				break;
			case 4:
				barTitle = 'cultureBar';
				break;
			case 5:
				barTitle = 'otherBar';
				break;
			default:
				barTitle = 'educationBar';
				break;
		}
	};
	function handleBarModal(el) {
		console.log('open');
		showModal = true;
	}
</script>

<div class="my-5">
	<div class="flex flex-col rounded-xl overflow-hidden w-full">
		<div class="-bg--purple flex items-center justify-between px-3 py-2">
			<div
				class="cursor-pointer bg-button--socondary rounded-lg w-7 h-7 grid place-items-center"
				on:click={() => Slide('prev')}
			>
				<i class="fi fi-rr-angle-small-right -text--purple" />
			</div>
			<div class="flex flex-col items-center justify-center">
				<span class="text-sm mb-2 text-button--socondary font-bold">فرم‌ها</span>
				<span class="text-xs text-button--socondary">{slider} از 5</span>
			</div>
			<div
				class="cursor-pointer bg-button--socondary rounded-lg w-7 h-7 grid place-items-center"
				on:click={() => Slide('next')}
			>
				<i class="fi fi-rr-angle-small-left -text--purple" />
			</div>
		</div>
		<div class="bg-button--socondary px-3 py-2">
			{#if barTitle == 'educationBar'}
				<div class="flex items-center" transition:slide={{ duration: 200 }}>
					<!-- <div
						class="radial-progress text-score--rang"
						style="--value:70; --size:60px; --thickness: 6px;"
					>
						70%
					</div> -->
					<div class="flex-col flex ms-3">
						<span
							class="text-lg cursor-pointer accordion-title"
							on:click={() => handleBarModal('educationBar')}>ثبت مدارک آموزشی</span
						>
						<span class="text-sm text-text--gray">
							امتیاز:
							<div dir="ltr" class="inline-block text-right">
								{@html scores_num.training ||
									'<span class="loading loading-infinity loading-xs"></span>'}
							</div>
						</span>
					</div>
					<i
						class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
						on:click={() => handleBarModal('educationBar')}
					/>
				</div>
			{:else if barTitle == 'researchBar'}
				<div class="flex items-center" transition:slide={{ duration: 200 }}>
					<!-- <div
						class="radial-progress text-score--rang"
						style="--value:70; --size:60px; --thickness: 6px;"
					>
						70%
					</div> -->
					<div class="flex-col flex ms-3">
						<span
							class="text-lg cursor-pointer accordion-title"
							on:click={() => handleBarModal('researchBar')}>ثبت مدارک پژوهشی</span
						>
						<span class="text-sm text-text--gray">
							امتیاز:
							<div dir="ltr" class="inline-block text-right">
								{@html scores_num.research ||
									'<span class="loading loading-infinity loading-xs"></span>'}
							</div>
						</span>
					</div>
					<i
						class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
						on:click={() => handleBarModal('researchBar')}
					/>
				</div>
			{:else if barTitle == 'skillBar'}
				<div class="flex items-center" transition:slide={{ duration: 200 }}>
					<!-- <div
						class="radial-progress text-score--rang"
						style="--value:70; --size:60px; --thickness: 6px;"
					>
						70%
					</div> -->
					<div class="flex-col flex ms-3">
						<span
							class="text-lg cursor-pointer accordion-title"
							on:click={() => handleBarModal('skillBar')}>ثبت مدارک مهارتی</span
						>
						<span class="text-sm text-text--gray">
							امتیاز:
							<div dir="ltr" class="inline-block text-right">
								{@html scores_num.skill ||
									'<span class="loading loading-infinity loading-xs"></span>'}
							</div>
						</span>
					</div>
					<i
						class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
						on:click={() => handleBarModal('skillBar')}
					/>
				</div>
			{:else if barTitle == 'cultureBar'}
				<div class="flex items-center" transition:slide={{ duration: 200 }}>
					<!-- <div
						class="radial-progress text-score--rang"
						style="--value:70; --size:60px; --thickness: 6px;"
					>
						70%
					</div> -->
					<div class="flex-col flex ms-3">
						<span
							class="text-sm cursor-pointer accordion-title"
							on:click={() => handleBarModal('cultureBar')}>ثبت مدارک اجتماعی-فزهنگی</span
						>
						<span class="text-sm text-text--gray">
							امتیاز:
							<div dir="ltr" class="inline-block text-right">
								{@html scores_num.culture ||
									'<span class="loading loading-infinity loading-xs"></span>'}
							</div>
						</span>
					</div>
					<i
						class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
						on:click={() => handleBarModal('cultureBar')}
					/>
				</div>
			{:else if barTitle == 'otherBar'}
				<div class="flex items-center" transition:slide={{ duration: 200 }}>
					<!-- <div
						class="radial-progress text-score--rang"
						style="--value:70; --size:60px; --thickness: 6px;"
					>
						70%
					</div> -->
					<div class="flex-col flex ms-3">
						<span
							class="text-lg cursor-pointer accordion-title"
							on:click={() => handleBarModal('otherBar')}>ثبت مدارک سایر فعالیت‌ها</span
						>
						<span class="text-sm text-text--gray">0 امتیاز</span>
					</div>
					<i
						class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
						on:click={() => handleBarModal('otherBar')}
					/>
				</div>
			{/if}
		</div>
	</div>
	<!-- <div class="overflow-hidden h-screen w-screen fixed top-0 start-0">
        <div class="h-full w-full fixed bg-black bg-opacity-40 top-0 start-0" on:cl>

        </div>
        <div class="bg-base--gray rounded-xl p-2 fixed bottom-0 w-full start-0 m-0" on:clic>
            test
        </div>
    </div> -->
	<BottomModal bind:showModal>
		{#if barTitle == 'educationBar'}
			<ul class="style-type text-base">
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('edu')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/edu"> سوابق تحصیلی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('olympiad')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/olympiad"> المپیاد‌های علمی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('medical')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/medical"> آزمون‌های علوم پزشکی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('entrance')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/entrance">
						آزمون‌سراسری ورود به دانشگاه از دوره تحصیلی متوسطه
					</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('sample')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/sample"> دانشجویان نمونه کشوری </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('math')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/training/math"> مسابقه ریاضی دانشجویی کشور</a>
				</li>
			</ul>
		{:else if barTitle == 'researchBar'}
			<ul class="style-type text-base">
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('article')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/research/article"> مقالات </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer {pageName.includes('book')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/research/book"> کتاب </a>
				</li>
			</ul>
		{:else if barTitle == 'skillBar'}
			<ul class="style-type text-base">
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('festivals')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/festivals"> جشنواره ها و مسابقات مورد تایید بنیاد ملی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('invention')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/invention"> اختراع های برگزیده شده در بنیاد ملی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('babaei')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/babaei">
						شرکت و برگزیدگی در مسابقات مسئله محور(طرح شهید بابائی)
					</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('activities')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/activities"> فعالیت‌های مهارتی </a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('cooperation')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/cooperation">
						همکاری در اجرای قرارداد های پژوهشی توسعه ای و کاربردی
					</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('ahmadi')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/ahmadi">
						فعالیت در هسته های مسئله محور پژوهشی /فناورانه (طرح شهید احمدی روشن)
					</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('skill/art')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/skill/art"> برگزیدگان شیوه نامه های /هنری/ادبی/قرانی بنیادی </a>
				</li>
			</ul>
		{:else if barTitle == 'cultureBar'}
			<ul class="style-type text-base">
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('professional')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/professional">
						عضويت در انجمن‌های علمی-تخصصی دارای مجوز
					</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('cultural')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/cultural">
						همکاری/ حضور در برنامه­ تشکل‌ها، سازمان­های مردم نهاد، انجمن‌های علمی- فرهنگی و بنیادهای
						نخبگان استان­</a
					>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('journals')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/journals"> عضو هیئت تحریریه نشریه های علمی</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('management')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/management"> عضویت در هیئت مدیره انجمن‌های علمی/تخصصی</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('journals_head')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/journals_head"> سر دبیری نشریه های علمی</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('assoc_uni')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/assoc_uni"> دبیری انجمن‌های علمی دانشجویی</a>
				</li>
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('camp')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/culture/camp"> شركت در اردوهاي جهادي</a>
				</li>
			</ul>
		{:else if barTitle == 'otherBar'}
			<ul class="style-type text-base">
				<li
					class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('other')
						? '-text--purple bg-table--item'
						: ''}"
				>
					<a href="/inojob/score/other"
						>سایر فعالیتهای فناورانه-مهارتی، آموزشی، پژوهشی، اجتماعی -فرهنگی</a
					>
				</li>
			</ul>
		{/if}
	</BottomModal>
</div>

<style>
	.radial-progress {
		color: #fff;
	}
	.radial-progress::before {
		background: radial-gradient(#36ace5, #36ace5 98%, #0000) top/var(--thickness) var(--thickness)
				no-repeat,
			conic-gradient(#36ace5 calc(var(--value) * 1%), #0000 0);
		background-color: #555555;
	}
	.radial-progress::after {
		background-color: #36ace5;
	}
</style>
