<script>
	import ArticleDetails from '$lib/components/inojob/research/article/ArticleDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import SearchSelect from '$lib/components/forms/SearchSelect.svelte';
	import InternationalAdd from '$lib/components/inojob/research/article/InternationalAdd.svelte';
	import NationalAdd from '$lib/components/inojob/research/article/NationalAdd.svelte';
	import ScienceAdd from '$lib/components/inojob/research/article/ScienceAdd.svelte';
	import Dropdown from '$lib/components/Dropdown.svelte';
	$: updated = true;
	$: cantAdd = false;
	let showArticleDetails = false;
	let showArticleAdd = true;
	let showInternational = false;
	let showNational = false;
	let showScience = false;
	$: isPending = true;
	let error = false;
	let USER;
	$: USER;
	$: scores = [];
	afterUpdate(async () => {
		if (updated) {
			const api_token = getCookie('api_token');
			await axios
				.get(`${API_URL}/getScores/research/article`, {
					headers: { Authorization: `Bearer ${api_token}` }
				})
				.then(function (response) {
					scores = response.data.data;
					cantAdd = response.data.info.cantAdd;
					if (scores.length > 0) {
						showArticleAdd = false;
						showArticleDetails = true;
					}
					if(cantAdd){
						showArticleAdd = false;
						showArticleDetails = true;
					}
					isPending = false;
					updated = false;
				})
				.catch(function (err) {
					error = err.response.data.message;
					isPending = false;
				});
		}
	});
	let filters = [
		[
			'مقاله های منتشر شده / پذیرفته شده برای انتشار در نشریه های با نمایه معتبر بین المللی',
			'international'
		],
		['مقاله‌هاي منتشرشده/ پذيرفته‌شده براي انتشار در نشريه‌هاي علمی - پژوهشی/ترویجی', 'science'],
		['مقاله‌هاي ارائه‌شده  در همايش‌هاي معتبر علمي (داخلي و بين‌المللي)', 'national']
	];
	let filter;
	const filterArticle = (detail) => {
		showInternational = false;
		showNational = false;
		showScience = false;
		if (detail[1] == 'international') showInternational = true;
		else if (detail[1] == 'national') showNational = true;
		else if (detail[1] == 'science') showScience = true;
		console.log(detail[1], showScience, showArticleAdd);
	};
</script>

<div
	class="bg-base--gray rounded-xl my-8 lg:p-8 p-2"
	in:fade={{ duration: 200, delay: 200 }}
	out:fade={{ duration: 200 }}
>
	{#if !isPending}
		{#if error}
			<div class="text-center">{error}</div>
			<a href="/inojob/score/training/edu" class="block lg:w-5/12 w-full mx-auto mt-5">
				<button class="btn bg-button--primary rounded-xl w-full h-14 text-white"
					>رفتن به سوابق تحصیلی</button
				></a
			>
		{:else}
			<Dropdown>
				<div slot="header">مقاله‌ها</div>
				<div slot="body">
					{#if showArticleAdd}
						<SearchSelect
							data={filters}
							label="نوع مقاله"
							search={false}
							on:select={({ detail }) => filterArticle(detail)}
							multi={true}
							all={false}
						/>
						<InternationalAdd
							{showInternational}
							on:handleClick={() => {
								showArticleDetails = true;
								showInternational = false;
								showArticleAdd = false;
							}}
							bind:updated
							bind:scores
							bind:cantAdd
						/>
						<NationalAdd
							{showNational}
							on:handleClick={() => {
								showArticleDetails = true;
								showNational = false;
								showArticleAdd = false;
							}}
							bind:updated
							bind:scores
							bind:cantAdd
						/>
						<ScienceAdd
							{showScience}
							on:handleClick={() => {
								showArticleDetails = true;
								showScience = false;
								showArticleAdd = false;
							}}
							bind:updated
							bind:scores
							bind:cantAdd
						/>
					{:else}
						<ArticleDetails
							{showArticleDetails}
							on:handleClick={() => {
								showArticleDetails = false;
								showArticleAdd = true;
							}}
							bind:updated
							bind:scores
							bind:cantAdd
						/>
					{/if}
				</div>
			</Dropdown>
		{/if}
	{:else}
		<div out:fade={{ duration: 200 }} class="text-center">
			<span class="loading loading-bars loading-lg" />
		</div>
	{/if}
</div>
