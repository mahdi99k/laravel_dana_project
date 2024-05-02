<script>
	import EduDetails from '$lib/components/inojob/training/edu/EduDetails.svelte';
	import { fade } from 'svelte/transition';
	import { onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import EduAdd from '$lib/components/inojob/training/edu/EduAdd.svelte';
	import Dropdown from '$lib/components/Dropdown.svelte';
	$: updated = false;
	let showEduDetails = false;
	let showEduAdd = true;
	$: isPending = true;
	let USER;
	$: USER;
	$: scores = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/training/edu`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				console.log(scores.length);
				if (scores.length > 0) {
					showEduAdd = false;
					showEduDetails = true;
				}
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
		<Dropdown>
			<div slot="header">سوابق تحصیلی</div>
			<div slot="body">
				<EduDetails
					bind:scores
					{showEduDetails}
					on:handleClick={() => {
						showEduDetails = false;
						showEduAdd = true;
					}}
					bind:updated
				/>
				<EduAdd
					bind:scores
					{showEduAdd}
					on:handleClick={() => {
						showEduDetails = true;
						showEduAdd = false;
					}}
					bind:updated
				/>
			</div>
		</Dropdown>
	{:else}
		<div out:fade={{ duration: 200 }} class="text-center">
			<span class="loading loading-bars loading-lg" />
		</div>
	{/if}
</div>
