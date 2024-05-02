<script>
	import { fade, slide } from 'svelte/transition';
	import { afterUpdate, onMount } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	import axios from 'axios';
	import PersonalAdd from '$lib/components/inojob/private/PersonalAdd.svelte';
	import PersonalDetails from '$lib/components/inojob/private/PersonalDetails.svelte';
	import ContactAdd from '$lib/components/inojob/private/ContactAdd.svelte';
	import ContactDetails from '$lib/components/inojob/private/ContactDetails.svelte';
	import JobAdd from '$lib/components/inojob/private/JobAdd.svelte';
	import JobDetails from '$lib/components/inojob/private/JobDetails.svelte';
	import FileAdd from '$lib/components/inojob/private/FileAdd.svelte';
	import Dropdown from '$lib/components/Dropdown.svelte';
	let showPersonalDetails,
		showContactDetails,
		showJobDetails,
		showFilesDetails = true;
	let showPersonalAdd,
		showContactAdd,
		showJobAdd,
		showFilesAdd = false;
	$: isPending = true;
	let USER;
	$: USER;
	onMount(async () => {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getUser`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then(function (response) {
				USER = response.data.data;
				isPending = false;
			});
	});
</script>

<div
	class="bg-base--gray rounded-xl my-8 lg:p-8"
	in:fade={{ duration: 200, delay: 200 }}
	out:fade={{ duration: 200 }}
>
	{#if !isPending}
		<div in:slide={{ duration: 200, delay: 200 }} class="p-2">
			<Dropdown>
				<div slot="header">اطلاعات فردی</div>
				<div slot="body">
					<PersonalDetails
						bind:USER
						{showPersonalDetails}
						on:handleClick={() => {
							showPersonalDetails = false;
							showPersonalAdd = true;
						}}
					/>
					<PersonalAdd
						bind:USER
						{showPersonalAdd}
						on:handleClick={() => {
							showPersonalDetails = true;
							showPersonalAdd = false;
						}}
					/>
				</div>
			</Dropdown>
			<Dropdown>
				<div slot="header">اطلاعات تماس</div>
				<div slot="body">
					<ContactDetails
						bind:USER
						{showContactDetails}
						on:handleClick={() => {
							showContactDetails = false;
							showContactAdd = true;
						}}
					/>
					<ContactAdd
						bind:USER
						{showContactAdd}
						on:handleClick={() => {
							showContactAdd = false;
							showContactDetails = true;
						}}
					/>
				</div>
			</Dropdown>
			<Dropdown>
				<div slot="header">اطلاعات شغلی</div>
				<div slot="body">
					<JobDetails
						bind:USER
						{showJobDetails}
						on:handleClick={() => {
							showJobDetails = false;
							showJobAdd = true;
						}}
					/>
					<JobAdd
						bind:USER
						{showJobAdd}
						on:handleClick={() => {
							showJobAdd = false;
							showJobDetails = true;
						}}
					/>
				</div>
			</Dropdown>
			<Dropdown>
				<div slot="header">بارگذاری مدارک</div>
				<div slot="body">
					<FileAdd bind:USER />
				</div>
			</Dropdown>
		</div>
	{:else}
		<div out:fade={{ duration: 200 }} class="text-center">
			<span class="loading loading-bars loading-lg" />
		</div>
	{/if}
</div>
