<script>
	export let showJobDetails = true;
	import { fade } from 'svelte/transition';
	let title, company, phone, address , contract , personalStatus;
	import { afterUpdate } from 'svelte';
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
	import DataBox from '../DataBox.svelte';
	export let USER;
	afterUpdate(() => {
		title = USER.job.title;
		company = USER.job.company;
		phone = USER.job.phone;
		address = USER.job.address;
		address = USER.job.address;
		contract = USER.job.contract;
		personalStatus = USER.inojob.personal_status;
	});
	const handleClick = () => {
		console.log('com handle');
		dispatch('handleClick');
	};
</script>

{#if showJobDetails}
	<div
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
		class="bg-table--title border border-input--border md:p-5 p-2 rounded-xl my-5"
	>
		<div class="flex flex-wrap">
			<DataBox label="عنوان شغل" data={title} />
			<DataBox label="نوع قرارداد" data={contract} />
			<DataBox label="عنوان محل کار" data={company} />
			<DataBox label="تلفن محل کار" data={phone} />
			<DataBox label="آدرس محل کار" data={address} />
		</div>
		{#if personalStatus == 0 || personalStatus == 3}
		<div>
			<button
				on:click={handleClick}
				class="btn text-white md:text-lg text-base rounded-xl xl:w-2/12 sm:w-6/12 w-full ms-auto block md:h-14 h-10 gtid place-items-center bg-button--socondary border-none hover:bg-table--item"
			>
				ویرایش
			</button>
		</div>
		{/if}
	</div>
{/if}
