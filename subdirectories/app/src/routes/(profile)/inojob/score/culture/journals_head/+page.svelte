<script>
	import Journals_headDetails from '$lib/components/inojob/culture/journals_head/Journals_headDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import Journals_headAdd from '$lib/components/inojob/culture/journals_head/Journals_headAdd.svelte';
	import Dropdown from '../../../../../../lib/components/Dropdown.svelte';
	$: updated = false;
	let showJournals_headDetails = false;
	let showJournals_headAdd = true;
	$: isPending = true;
	let error = false;
	let USER;
	$: USER;
	$: scores = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/culture/journals_head`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				console.log(scores.length);
				if (scores.length > 0) {
					showJournals_headAdd = false;
					showJournals_headDetails = true;
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
				<div slot="header">سر دبیری نشریه های علمی</div>
				<div slot="body">
					<Journals_headDetails
						{showJournals_headDetails}
						on:handleClick={() => {
							showJournals_headDetails = false;
							showJournals_headAdd = true;
						}}
						bind:updated
						bind:scores
					/>
					<Journals_headAdd
						{showJournals_headAdd}
						on:handleClick={() => {
							showJournals_headDetails = true;
							showJournals_headAdd = false;
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
