<script>
	import { slide } from 'svelte/transition';

	let educationBar = false;
	let researchBar = false;
	let skillBar = false;
	let cultureBar = false;
	let otherBar = false;

	import { page } from '$app/stores';
	import { afterUpdate, onMount } from 'svelte';
	export let scores_num = [];
	console.log(scores_num);
	$: pageName = '';
	let updatedPage = false;
	let updated = false;
	afterUpdate(() => {
		pageName = $page.url.pathname;
		if (pageName.includes('edu') && !updated) {
			researchBar = false;
			skillBar = false;
			cultureBar = false;
			otherBar = false;
			educationBar = true;
			updated = true;
		} else {
			updated = false;
		}
		if (!updatedPage) {
			if (pageName.includes('training')) educationBar = true;
			else if (pageName.includes('research')) researchBar = true;
			else if (pageName.includes('skill')) skillBar = true;
			else if (pageName.includes('culture')) cultureBar = true;
			else if (pageName.includes('other')) otherBar = true;
			updatedPage = true;
		}
	});

	//

	function closeAllBar(el) {
		console.log(researchBar, 'fa');
		if (el == 'educationBar') {
			researchBar = false;
			skillBar = false;
			cultureBar = false;
			otherBar = false;
			educationBar = !educationBar;
		}
		if (el == 'researchBar') {
			educationBar = false;
			researchBar = !researchBar;
			skillBar = false;
			cultureBar = false;
			otherBar = false;
		}
		if (el == 'skillBar') {
			educationBar = false;
			researchBar = false;
			skillBar = !skillBar;
			cultureBar = false;
			otherBar = false;
		}
		if (el == 'cultureBar') {
			educationBar = false;
			researchBar = false;
			skillBar = false;
			cultureBar = !cultureBar;
			otherBar = false;
		}
		if (el == 'otherBar') {
			educationBar = false;
			researchBar = false;
			skillBar = false;
			cultureBar = false;
			otherBar = !otherBar;
		}
		if (el == null) {
			educationBar = false;
			researchBar = false;
			skillBar = false;
			cultureBar = false;
			otherBar = false;
		}
	}
</script>

<div>
	<div class="flex flex-col">
		<div class="bg-table--item rounded-lg p-3 mb-5">
			<span>امتیاز کلی شما: </span>
			<span class="-text--error">
				{@html Number(scores_num.training) +
					Number(scores_num.culture) +
					Number(scores_num.skill) +
					Number(scores_num.research) ||
					'<span class="loading loading-infinity loading-xs"></span>'}
			</span>
		</div>
		<span class="text-lg mb-5">فرم‌ها</span>
		<div class="flex flex-col mb-7" class:active-accordion={educationBar}>
			<div class="flex items-center">
				<!-- <div
					class="radial-progress text-score--rang"
					style="--value:70; --size:60px; --thickness: 6px;"
				>
					70%
				</div> -->
				<div class="flex-col flex ms-3">
					<button
						class="text-lg cursor-pointer accordion-title"
						on:click={() => closeAllBar('educationBar')}>ثبت مدارک آموزشی</button
					>
					<span class="text-sm text-text--gray">
						<span> امتیاز: </span>
						<div dir="ltr" class="text-right inline-block">
							{@html scores_num.training ||
								'<span class="loading loading-infinity loading-xs"></span>'}
						</div>
					</span>
				</div>
				<i
					class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
					on:click={() => closeAllBar('educationBar')}
				/>
			</div>
			{#if educationBar}
				<div transition:slide={{ duration: 200 }} class="mt-3">
					<ul class="style-type ms-10 text-base">
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
					<div class="h-1 rounded-full w-full bg-input--border" />
				</div>
			{/if}
		</div>
		<div class="flex flex-col mb-7" class:active-accordion={researchBar}>
			<div class="flex items-center">
				<!-- <div
					class="radial-progress text-score--rang"
					style="--value:70; --size:60px; --thickness: 6px;"
				>
					70%
				</div> -->
				<div class="flex-col flex ms-3">
					<button
						class="text-lg cursor-pointer accordion-title"
						on:click={() => closeAllBar('researchBar')}>ثبت مدارک پژوهشی</button
					>
					<span class="text-sm text-text--gray">
						<span> امتیاز: </span>
						<div dir="ltr" class="text-right inline-block">
							{@html scores_num.research ||
								'<span class="loading loading-infinity loading-xs"></span>'}
						</div>
					</span>
				</div>
				<i
					class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
					on:click={() => closeAllBar('researchBar')}
				/>
			</div>
			{#if researchBar}
				<div transition:slide={{ duration: 200 }} class="mt-3">
					<ul class="style-type ms-10 text-base">
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
					<div class="h-1 rounded-full w-full bg-input--border" />
				</div>
			{/if}
		</div>
		<div class="flex flex-col mb-7" class:active-accordion={skillBar}>
			<div class="flex items-center">
				<!-- <div
					class="radial-progress text-score--rang"
					style="--value:70; --size:60px; --thickness: 6px;"
				>
					70%
				</div> -->
				<div class="flex-col flex ms-3">
					<button
						class="text-lg cursor-pointer accordion-title"
						on:click={() => closeAllBar('skillBar')}>ثبت مدارک مهارتی</button
					>
					<span class="text-sm text-text--gray">
						<span> امتیاز: </span>
						<div dir="ltr" class="text-right inline-block">
							{@html scores_num.skill ||
								'<span class="loading loading-infinity loading-xs"></span>'}
						</div>
					</span>
				</div>
				<i
					class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
					on:click={() => closeAllBar('skillBar')}
				/>
			</div>
			{#if skillBar}
				<div transition:slide={{ duration: 200 }} class="mt-3">
					<ul class="style-type ms-10 text-base">
						<li
							class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.includes('festivals')
								? '-text--purple bg-table--item'
								: ''}"
						>
							<a href="/inojob/score/skill/festivals">
								جشنواره ها و مسابقات مورد تایید بنیاد ملی
							</a>
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
							<a href="/inojob/score/skill/art">
								برگزیدگان شیوه نامه های /هنری/ادبی/قرانی بنیادی
							</a>
						</li>
					</ul>
					<div class="h-1 rounded-full w-full bg-input--border" />
				</div>
			{/if}
		</div>
		<div class="flex flex-col mb-7" class:active-accordion={cultureBar}>
			<div class="flex items-center">
				<!-- <div
					class="radial-progress text-score--rang"
					style="--value:70; --size:60px; --thickness: 6px;"
				>
					70%
				</div> -->
				<div class="flex-col flex ms-3">
					<button
						class="text-sm cursor-pointer accordion-title"
						on:click={() => closeAllBar('cultureBar')}>ثبت مدارک اجتماعی-فزهنگی</button
					>
					<span class="text-sm text-text--gray">
						<span> امتیاز: </span>
						<div dir="ltr" class="text-right inline-block">
							{@html scores_num.culture ||
								'<span class="loading loading-infinity loading-xs"></span>'}
						</div>
					</span>
				</div>
				<i
					class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
					on:click={() => closeAllBar('cultureBar')}
				/>
			</div>
			{#if cultureBar}
				<div transition:slide={{ duration: 200 }} class="mt-3">
					<ul class="style-type ms-10 text-base">
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
								همکاری/ حضور در برنامه­ تشکل‌ها، سازمان­های مردم نهاد، انجمن‌های علمی- فرهنگی و
								بنیادهای نخبگان استان­</a
							>
						</li>
						<li
							class="p-3 rounded-lg mb-2 cursor-pointer text-sm {pageName.substr(
								pageName.lastIndexOf('/')
							) == '/journals'
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
							<a href="/inojob/score/culture/management">
								عضویت در هیئت مدیره انجمن‌های علمی/تخصصی</a
							>
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
					<div class="h-1 rounded-full w-full bg-input--border" />
				</div>
			{/if}
		</div>
		<div class="flex flex-col mb-7" class:active-accordion={otherBar}>
			<div class="flex items-center">
				<!-- <div
					class="radial-progress text-score--rang"
					style="--value:70; --size:60px; --thickness: 6px;"
				>
					70%
				</div> -->
				<div class="flex-col flex ms-3">
					<button
						class="text-lg cursor-pointer accordion-title"
						on:click={() => closeAllBar('otherBar')}>ثبت مدارک سایر فعالیت‌ها</button
					>
					<span class="text-sm text-text--gray">امتیاز ندارد</span>
				</div>
				<i
					class="accordion-mark fi fi-rr-angle-down ms-5 text-xl self-start mt-2 cursor-pointer"
					on:click={() => closeAllBar('otherBar')}
				/>
			</div>
			{#if otherBar}
				<div transition:slide={{ duration: 200 }} class="mt-3">
					<ul class="style-type ms-10 text-base">
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
					<div class="h-1 rounded-full w-full bg-input--border" />
				</div>
			{/if}
		</div>
	</div>
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
	.accordion-mark,
	.accordion-title {
		transition: all 0.5s;
	}
	.active-accordion .accordion-title,
	.active-accordion .accordion-mark {
		color: #d8b4fe;
	}
	.active-accordion .accordion-mark {
		transform: rotate(180deg);
	}
</style>
