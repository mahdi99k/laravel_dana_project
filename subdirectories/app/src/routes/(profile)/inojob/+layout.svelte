<script>
	import ScoreNavbarMobile from '$lib/components/inojob/ScoreNavbarMobile.svelte';
	import { fade, slide } from 'svelte/transition';
	import ScoreNavbar from '$lib/components/inojob/ScoreNavbar.svelte';
	import axios from 'axios';
	import { page } from '$app/stores';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import Steps from '$lib/components/inojob/Steps.svelte';
	import VerifyModal from '$lib/components/modals/VerifyModal.svelte';
	$: pageName = '';
	$: scores_num = [];
	let step = 0;
	let caseStatus = 0;
	let casePending = true;
	let api_token;
	onMount(async () => {
		api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getUserCase`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then((response) => {
				if (response) {
					if (response.data != '') {
						step = response.data.step;
						caseStatus = response.data.status;
					}
					casePending = false;
				}
			});
		await axios
			.get(`${API_URL}/us`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then(function (response) {
				scores_num = response.data;
			});

		
	});
	afterUpdate(() => {
		pageName = $page.url.pathname.substr($page.url.pathname.lastIndexOf('/'));
	});
	// let pageNameReal = $page.url.pathname.substr($page.url.pathname.lastIndexOf('/'));
	// $: pageName = $page.url.pathname.lastIndexOf('/');

	const steps = [
		{
			name: 'ارسال فرم',
			icon: 'fi-rr-check',
			active: true
		},
		{
			name: 'استانی',
			icon: 'fi-rr-marker',
			active: true
		},
		{
			name: 'ستادی',
			icon: 'fi-rr-bank',
			active: true
		},
		{
			name: 'داوران',
			icon: 'fi-rr-glasses',
			active: true
		},
		{
			name: 'کانون ارزیابان',
			icon: 'fi-rr-interactive',
			active: false
		},
		{
			name: 'نهایی',
			icon: 'fi-rr-checkbox',
			active: false
		}
	];

	const sendCase = async () => {
		await axios
			.post(
				`${API_URL}/sendUserCase`,
				{},
				{ headers: { Authorization: `Bearer ${api_token}` } }
			)
			.then((response) => {
				step = response.data.step;
				caseStatus = response.data.status;
			});
		window.location.reload();
	};
	const deleteCase = async () => {
		await axios
			.delete(`${API_URL}/deleteUserCase`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then((response) => {
				step = 0;
				caseStatus = 0;
			});
		window.location.reload();
	};
	const handleCase = async () => {
		if (caseStatus == 3 || caseStatus == 0) await sendCase();
		else await deleteCase();

		showModal = false;
	};
	const status_data = {
		'0': 'ارسال نشده',
		'1': 'بررسی نشده',
		'2': 'تایید اصل مدارک',
		'3': 'درخواست ادیت (نقص)',
		'4': 'دریافت شده از کاربر (ادیت شده)',
		'5': 'تایید نهایی - مدارک تایید شده'
	};
	let showModal = false;
	let successLabel = caseStatus == 0 || caseStatus == 3 ? 'ارسال نهایی فرم' : 'حذف درخواست';
</script>

<VerifyModal
	bind:showModal
	successLabel={caseStatus == 0 || caseStatus == 3 ? 'ارسال نهایی فرم' : 'حذف درخواست'}
	on:success={() => {
		handleCase();
	}}
>
	{#if caseStatus == 0 || caseStatus == 3}
		<p>
			دیگر نمیتونید ادیت کنید
			<br />
			آیا از درخواست خود اطمینان دارید؟
		</p>
	{:else}
		<p>پس از حذف و ادیت اطلاعات باید مجدد روی "اطلاعاتم را تکمیل کردم" بزنید</p>
	{/if}
</VerifyModal>
<div class="flex pt-4 flex-wrap">
	{#if casePending}
		<div class=" w-full text-center">
			<span class="loading loading-bars loading-lg" />
		</div>
	{:else}
		<div
			class="flex xl:items-stretch w-full mb-6 flex-wrap xl:px-0 px-2"
			transition:slide={{ duration: 200 }}
		>
			<div class="xl:w-6/12 w-full xl:pe-2 h-full max-h-48 xl:mb-0 mb-3">
				<div
					class="bg-base--gray border border-input--border rounded-lg h-full p-6 flex justify-between"
				>
					<div class="flex flex-col">
						{#if Number(caseStatus) == 3 || caseStatus == 0}
							<span class="font-medium">فرم‌های خود را نهایی کنید</span>
							<span class="text-text--gray text-sm mt-2 mb-6"
								>ابتدا تمام مراحل را انجام دهید و سپس فرم‌ها را ارسال نهایی کنید</span
							>
							<button
								class="bg-button--primary h-12 px-4 rounded-lg"
								on:click={() => (showModal = true)}>اطلاعاتم را تکمیل کردم</button
							>
						{:else}
							<span class="font-medium">شما فرمتان را ارسال کرده اید</span>
							<span class="text-text--gray text-sm mt-2 mb-6"
								>برای ویرایش اطلاعات باید درخواست خود را حذف کنید</span
							>
							<button
								class="-bg--error h-12 px-4 rounded-lg"
								on:click={() => (showModal = true)}
								>درخواست ادیت دارم
							</button>
						{/if}
					</div>
					<div>
						<img src="/img/inojob/final.svg" alt="final" />
					</div>
				</div>
			</div>
			<div class="xl:w-6/12 w-full xl:ps-2 h-full max-h-48 xl:mb-0 mb-6">
				<div
					class="bg-base--gray rounded-lg border border-input--border flex flex-col overflow-hidden h-full"
				>
					<div class="bg-input--gray flex items-center py-4 px-6">
						<span> مراحل وضعیت استخدام</span>
						<div class="ms-auto flex items-center text-sm">
							<div>
								<span class="text-text--gray">مرحله فعلی : </span>
								<span>{steps[step].name}</span>
							</div>
							<div class="w-px h-4 bg-input--border mx-4" />
							<div>
								<span class="text-text--gray">وضعیت : </span>
								<span>{status_data[caseStatus]}</span>
							</div>
						</div>
					</div>
					<div class="p-6">
						<Steps data={steps} active={step} />
					</div>
				</div>
			</div>
		</div>
	{/if}
	{#if $page.url.pathname.includes('score')}
		<div class="xl:w-3/12 w-full px-2 hidden xl:block">
			<div class="bg-base--gray rounded-xl lg:p-5 p-3">
				<ScoreNavbar bind:scores_num />
			</div>
		</div>
	{/if}

	<div class="{$page.url.pathname.includes('score') ? 'xl:w-9/12' : ''} w-full px-2">
		<div
			class="xl:w-6/12 md:w-7/12 sm:w-8/12 w-full flex items-center bg-base--gray justify-center rounded-xl h-16 p-2 md:mx-0 mx-auto"
		>
			<a
				transition:fade={{ duration: 300 }}
				href="/inojob/private"
				class="grid place-items-center text-sm md:text-lg w-1/3 h-full tab-link {pageName ==
				'/private'
					? 'active'
					: ''}">اطلاعات شخصی</a
			>
			<a
				transition:fade={{ duration: 300 }}
				href="/inojob/priority"
				class="grid place-items-center text-sm md:text-lg w-1/3 h-full tab-link {pageName ==
				'/priority'
					? 'active'
					: ''}">اولویت‌های شغلی</a
			>
			<a
				transition:fade={{ duration: 300 }}
				href="/inojob/score"
				class="grid place-items-center text-sm md:text-lg w-1/3 h-full tab-link {$page.url.pathname.includes(
					'score'
				)
					? 'active'
					: ''}">ثبت مدارک امتیازی</a
			>
		</div>
		{#if $page.url.pathname.includes('score')}
			<div class="xl:hidden block w-full">
				<ScoreNavbarMobile bind:scores_num />
			</div>
		{/if}
		<slot />
	</div>
</div>
