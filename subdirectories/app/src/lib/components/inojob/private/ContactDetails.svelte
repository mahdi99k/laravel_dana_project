<script>
	export let showContactDetails = true;
	import { fade } from 'svelte/transition';
	let phone, telephone, email, province, city, postal, address, emergency , personalStatus;
	import { afterUpdate, createEventDispatcher } from 'svelte';
	import DataBox from '../DataBox.svelte';
	let dispatch = createEventDispatcher();
	export let USER;

	const handleClick = () => {
		dispatch('handleClick');
	};
	afterUpdate(() => {
		phone = USER.phone;
		telephone = USER.about.telephone;
		email = USER.email;
		province = USER.about.province;
		city = USER.more.city;
		postal = USER.more.postal;
		address = USER.more.address;
		emergency = USER.more.emergency;
		personalStatus = USER.inojob.personal_status;
	});
</script>

{#if showContactDetails}
	<div
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
		class="bg-table--title border border-input--border md:p-5 p-2 rounded-xl my-5"
	>
		<div class="flex flex-wrap">
			<DataBox label="شماره همراه" data={phone} />
			<DataBox label="تلفن منزل" data={telephone} />
			<DataBox label="شماره همراه اضطراری" data={emergency} />
			<DataBox label="ایمیل" data={email} responsive="sm:w-full" />
			<DataBox label="محل سکونت" data={`${province || ''}${province ? ' - ' : ''}${city || ''} `} />
			<DataBox label="آدرس" data={address} />
			<DataBox label="کد پستی" data={postal} />
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
