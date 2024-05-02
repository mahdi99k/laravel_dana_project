<script>
	import AhmadiDetails from '$lib/components/inojob/skill/ahmadi/AhmadiDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import AhmadiAdd from '$lib/components/inojob/skill/ahmadi/AhmadiAdd.svelte';
	import Dropdown from '../../../../../../lib/components/Dropdown.svelte';
	$: updated = false;
	let showAhmadiDetails = false;
	let showAhmadiAdd = true;
	$: isPending = true;
	let error = false;
	let USER;
	$: USER;
	$: scores = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/skill/ahmadi`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				console.log(scores.length);
				if (scores.length > 0) {
					showAhmadiAdd = false;
					showAhmadiDetails = true;
				}
				isPending = false;
			})
			.catch(function (err) {
				error = err.response.data.message;
				isPending = false;
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
				<div slot="header">
					فعالیت در هسته های مسئله محور پژوهشی /فناورانه (طرح شهید احمدی روشن)
				</div>
				<div slot="body">
					<AhmadiDetails
						{showAhmadiDetails}
						on:handleClick={() => {
							showAhmadiDetails = false;
							showAhmadiAdd = true;
						}}
						bind:updated
						bind:scores
					/>
					<AhmadiAdd
						{showAhmadiAdd}
						on:handleClick={() => {
							showAhmadiDetails = true;
							showAhmadiAdd = false;
						}}
						bind:updated
						bind:scores
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
