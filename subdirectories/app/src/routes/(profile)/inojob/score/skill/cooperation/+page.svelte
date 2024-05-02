<script>
	import CooperationDetails from '$lib/components/inojob/skill/cooperation/CooperationDetails.svelte';
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import CooperationAdd from '$lib/components/inojob/skill/cooperation/CooperationAdd.svelte';
	import Dropdown from '../../../../../../lib/components/Dropdown.svelte';
	$: updated = false;
	let showCooperationDetails = false;
	let showCooperationAdd = true;
	$: isPending = true;
	let error = false;
	let USER;
	$: USER;
	$: scores = [];
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getScores/skill/cooperation`, {
				headers: { Authorization: `Bearer ${api_token}` }
			})
			.then(function (response) {
				scores = response.data.data;
				console.log(scores.length);
				if (scores.length > 0) {
					showCooperationAdd = false;
					showCooperationDetails = true;
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
				
				<div slot="header">همکاری در اجرای قرارداد های پژوهشی توسعه ای و کاربردی</div>
				<div slot="body">
					<CooperationDetails
					{showCooperationDetails}
					on:handleClick={() => {
						showCooperationDetails = false;
						showCooperationAdd = true;
					}}
					bind:updated
					bind:scores
				/>
				<CooperationAdd
					{showCooperationAdd}
					on:handleClick={() => {
						showCooperationDetails = true;
						showCooperationAdd = false;
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
