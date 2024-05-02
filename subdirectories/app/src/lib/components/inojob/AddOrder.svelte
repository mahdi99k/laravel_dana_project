<script>
	// import { USER } from '$lib/main.js';
	import { fade } from 'svelte/transition';
	import { createEventDispatcher } from 'svelte';
	let dispatch = createEventDispatcher();
</script>

<div class="flex justify-center items-center flex-col" transition:fade={{ duration: 200 }}>
	<div class="xl:w-4/12 lg:w-6/12 md:w-8/12 sm:w-10/12 w-full grid place-items-center">
		<img src="/img/inojob/add-bg.svg" alt="add svg" class="w-full ratio-square" />
	</div>
	<div class="text-xl my-3">شما هنوز هیچ اولویت شغلی اضافه نکرده اید</div>
	<p class="text-text--gray">
		موقعیت‌های شغلی خود را اضافه و اولویت بندی کنید و در این صفحه مشاهده کنید.
	</p>
	<button
		class="flex items-center px-5 py-3 bg-button--primary rounded-lg mt-6"
		on:click={() => dispatch('open')}
	>
		<i class="fi fi-rr-plus-small me-3 text-3xl" />
		<span class="text-lg">اضافه کردن اولویت‌</span>
	</button>
</div>
