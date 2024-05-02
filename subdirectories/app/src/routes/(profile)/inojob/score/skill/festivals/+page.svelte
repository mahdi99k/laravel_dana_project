<script>
	import FestivalsDetails from '$lib/components/inojob/skill/festivals/FestivalsDetails.svelte';
	import CompDetails from '$lib/components/inojob/skill/comp/CompDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import FestivalsAdd from '$lib/components/inojob/skill/festivals/FestivalsAdd.svelte';
	import CompAdd from '$lib/components/inojob/skill/comp/CompAdd.svelte';
	import Dropdown from '../../../../../../lib/components/Dropdown.svelte';
	$: updated = false;
	let showFestivalsDetails = false;
	let showFestivalsAdd = true;
	let showCompDetails = false;
	let showCompAdd = true;
	$: isPending = true;
	let USER;
	let error = false;
	$: USER;
	$: scoresF = [];
	$: scoresC = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/skill/festival`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scoresF = response.data.data;
				if (scoresF.length > 0) {
					showFestivalsAdd = false;
					showFestivalsDetails = true;
				}
			})
			.catch(function (err) {
				error = err.response.data.message;
				isPending = false;
				console.log(err);
			});
		await axios
			.get(`${API_URL}/getScores/skill/comp`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then(function (response) {
				scoresC = response.data.data;
				if (scoresC.length > 0) showCompAdd = false;
				showCompDetails = true;
				isPending = false;
			})
			.catch(function (err) {
				error = err.response.data.message;
				isPending = false;
				console.log(err);
			});
	});
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
				<div slot="header">جشنواره‌ها</div>
				<div slot="body">
					<FestivalsDetails
						{showFestivalsDetails}
						on:handleClick={() => {
							showFestivalsDetails = false;
							showFestivalsAdd = true;
						}}
						bind:updated
						bind:scores={scoresF}
					/>
					<FestivalsAdd
						{showFestivalsAdd}
						on:handleClick={() => {
							showFestivalsDetails = true;
							showFestivalsAdd = false;
						}}
						bind:updated
						bind:scores={scoresF}
					/>
				</div>
			</Dropdown>
			<Dropdown>
				<div slot="header">مسابقات</div>
				<div slot="body">
					<CompDetails
						{showCompDetails}
						on:handleClick={() => {
							showCompDetails = false;
							showCompAdd = true;
						}}
						bind:updated
						bind:scores={scoresC}
					/>
					<CompAdd
						{showCompAdd}
						on:handleClick={() => {
							showCompDetails = true;
							showCompAdd = false;
						}}
						bind:updated
						bind:scores={scoresC}
					/>
				</div>
			</Dropdown>
		{/if}
	{:else}
		<div out:fade={{ duration: 200 }} class="text-center">
			<span class="loading loading-bars loading-lg" />
		</div>
	{/if}
</div>
