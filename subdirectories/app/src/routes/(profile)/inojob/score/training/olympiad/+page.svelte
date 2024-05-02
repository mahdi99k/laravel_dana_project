<script>
	import OlympiadDetails from '$lib/components/inojob/training/olympiad/OlympiadDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import OlympiadAdd from '$lib/components/inojob/training/olympiad/OlympiadAdd.svelte';
	import Dropdown from '../../../../../../lib/components/Dropdown.svelte';
	$: updated = false;
	let showOlympiadDetails = false;
	let showOlympiadAdd = true;
	$: isPending = true;
	let error = false;
	let USER;
	$: USER;
	$: scores = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/training/olympiad`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				console.log(scores.length);
				if (scores.length > 0) {
					showOlympiadAdd = false;
					showOlympiadDetails = true;
				}
				isPending = false;
			})
			.catch(function (err) {
				error = err.response.data.message;
				isPending = false;
				console.log(error, err);
			});
	});
</script>

<div
	class="bg-base--gray rounded-xl my-8 p-8"
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
				<div slot="header">المپیادهای علمی</div>
				<div slot="body">
					<OlympiadDetails
						{showOlympiadDetails}
						on:handleClick={() => {
							showOlympiadDetails = false;
							showOlympiadAdd = true;
						}}
						bind:updated
						bind:scores
					/>
					<OlympiadAdd
						{showOlympiadAdd}
						on:handleClick={() => {
							showOlympiadDetails = true;
							showOlympiadAdd = false;
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
