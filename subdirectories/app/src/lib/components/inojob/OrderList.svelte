<script>
	import { afterUpdate, onMount } from 'svelte';
	import Sortable from 'sortablejs';
	// import { USER } from '$lib/main.js';
	import { fade, slide } from 'svelte/transition';
	import { API_URL, getCookie, makeSlider } from '../../main';
	import axios from 'axios';
	import AddOrder from './AddOrder.svelte';
	import InojobList from './InojobList.svelte';
	import { createEventDispatcher } from 'svelte';
	import MessageModal from '../modals/MessageModal.svelte';
	let dispatch = createEventDispatcher();
	let showMessage = false;
	let showList = false;
	let updated_add = false;
	let userPriorities = [];
	$: showPriorities = userPriorities.filter((item) => true);
	let isPending = true;
	let userPrioritiesId = [];
	let searchInput = '';
	let firstPending = true;
	let status = 0;
	const getPriorities = async (token) => {
		isPending = true;
		await axios
			.get(`${API_URL}/getPriorities`, { headers: { Authorization: `Bearer ${token}` } })
			.then(function (response) {
				console.log(response.data.data);
				userPriorities = response.data.data;
				userPriorities.forEach((p) => {
					userPrioritiesId = [...userPrioritiesId, Number(p.id)];
				});
				showPriorities = userPrioritiesId.filter((item) => true);
				console.log(showPriorities, 'sssaaaaaaaaaaaa');
				console.log(userPrioritiesId);
			});

		await axios.get(`${API_URL}/getPrioritiesStatus` , { headers: { Authorization: `Bearer ${token}` } })
		.then(response=>{
			status = Number(response.data);
			isPending = false;
		})
	};
	let inojob_slider = '';
	function inojobSlider(node) {
		inojob_slider = node;
		makeSlider(inojob_slider);
	}
	let getDegree = {
		bachelor: 'کارشناسی / ارشد / دکتری',
		master: 'کارشناسی ارشد /دکتری',
		doctor: 'دکتری'
	};
	onMount(async () => {
		const api_token = getCookie('api_token');
		await getPriorities(api_token);
		// await axios.get(`${API_URL}/getUser` , {headers: {Authorization:`Bearer ${api_token}`}})
		// .then(function(response){
		//     console.log(response);
		// })
	});
	const updatePriorities = async () => {
		console.log('testaaa');
		const api_token = getCookie('api_token');
		await getPriorities(api_token);
	};
	const deletePriority = async (id, e) => {
		e.target.innerHTML = '<span class="loading loading-ring loading-xs"></span>';
		const api_token = getCookie('api_token');
		userPrioritiesId = userPrioritiesId.filter((item) => item != Number(id));
		console.log(userPrioritiesId);
		await axios
			.post(
				`${API_URL}/setPriority`,
				{ priorities: userPrioritiesId },
				{ headers: { Authorization: `Bearer ${api_token}` } }
			)
			.then(function (response) {
				userPriorities = userPriorities.filter((item) => item.id != Number(id));
				e.target.innerHTML = '-';
				showMessage = true;
			});
	};

	const openOrder = () => {
		showList = true;
		firstPending = false;
		updated_add = true;
	};
	const filterOrder = () => {
		showPriorities = userPriorities.filter((item) => item.title.includes(searchInput));
	};
	async function sortContainer(node) {
		const api_token = getCookie('api_token');
		Sortable.create(node, {
			handle: '.handle',
			group: 'shared',
			animation: 150,
			onEnd: async function (/**Event*/ evt) {
				let allItems = node.querySelectorAll('.inojob-item');
				userPrioritiesId = [];
				allItems.forEach((value) => {
					userPrioritiesId.push(Number(value.dataset.id));
				});
				await axios
					.post(
						`${API_URL}/setPriority`,
						{ priorities: userPrioritiesId },
						{ headers: { Authorization: `Bearer ${api_token}` } }
					)
					.then(function (response) {
						// showPriorities = response.data.data;
						console.log(userPrioritiesId);
					});
			}
		});
	}
</script>

{#if isPending}
	<div out:fade={{ duration: 200 }} class="text-center">
		<span class="loading loading-bars loading-lg" />
	</div>
{:else}
	<MessageModal message="اولویت با موفقیت حذف شد" bind:showMessage type="success" />
	<div in:fade={{ duration: 200, delay: 200 }}>
		{#if userPrioritiesId.length > 0}
			<div class="flex justify-between flex-wrap">
				<div
					class="bg-table--title rounded-lg overflow-hidden flex justify-between border-input--border h-16 xl:w-5/12 md:w-8/12 w-full mt-5"
				>
					<input
						type="text"
						class="w-full border-none outline-none h-full p-3 text-white bg-transparent"
						on:keyup={filterOrder}
						bind:value={searchInput}
					/>
					<div class="bg-button--socondary flex justify-center items-center h-full aspect-square">
						<i class="fi fi-rr-search text-2xl text-text--gray" />
					</div>
				</div>
				{#if status == 0 || status == 3}
				<button
					class="flex items-center px-5 py-3 bg-button--primary rounded-lg mt-6"
					on:click={openOrder}
				>
					<i class="fi fi-rr-plus-small me-3 text-3xl" />
					<span class="text-lg">اضافه کردن اولویت‌</span>
				</button>
				{/if}
			</div>
			<div
				class="overflow-x-scroll purple-scrollbar overflow-y-hidden inojob-slider h-full mt-10"
				use:inojobSlider
			>
				<div class="list-container h-full">
					<div
						class="flex justify-between items-center bg-table--purple w-full p-3 h-18 rounded-xl"
					>
						<div class="w-2/12 text-center">اولویت</div>
						<div class="w-1/12 text-center">کد</div>
						<div class="w-5/12 text-center">عنوان شغلی</div>
						<div class="w-3/12 text-center">نام سازمان</div>
						<div class="w-2/12 text-center">نام استان</div>
						<div class="w-2/12 text-center">جزئیات بیشتر</div>
					</div>
					{#if isPending}
						<div
							class="order-container flex flex-col animate-pulse mt-2"
							out:fade={{ duration: 300 }}
						>
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
						</div>
					{:else}
						<div
							class="order-container purple-scrollbar flex flex-col mt-2 overflow-y-scroll inojob-list-scroll"
							use:sortContainer
						>
							{#each showPriorities as inojob}
								<div
									class="my-3 rounded-xl inojob-item"
									data-id={inojob.id}
									transition:slide={{ duration: 200 }}
								>
									<input
										type="checkbox"
										class="hidden custom-collapse-input"
										id="collapse-{inojob.id}"
										name="custom-collapse"
									/>

									<div class=" font-medium flex p-3">
										<div class="w-2/12 text-center text-sm grid items-center">
											{userPrioritiesId.indexOf(Number(inojob.id)) == 0
												? 'اول'
												: userPrioritiesId.indexOf(Number(inojob.id)) == 1
												? 'دوم'
												: 'سوم'}
										</div>
										{#if Number(status) == 0 || Number(status) ==3}
										<div class="handle me-2 flex justify-start items-center">
											<i class="fi fi-rr-arrows text-lg" />
										</div>
										<button
											class="w-2/12 flex items-center justify-start"
											on:click={(event) => deletePriority(inojob.id, event)}
										>
											<span
												in:slide={{ duration: 200, delay: 200 }}
												out:slide={{ duration: 200 }}
												class="bg-button--success rounded-lg w-10 h-10 grid place-items-center me-3 cursor-pointer"
												>-</span
											>
											<span>{inojob.id}</span>
										</button>
										{:else}
											<div class="w-1/12 text-center">
												<span>{inojob.id}</span></div>
										{/if}
										<div class="w-5/12 text-center">{inojob.attributes.title}</div>
										<div class="w-3/12 text-center">{inojob.attributes.employer.name}</div>
										<div class="w-2/12 text-center">{inojob.attributes.location.province}</div>
										<label for="collapse-{inojob.id}" class="w-2/12 text-center cursor-pointer"
											><i class="fi fi-rr-angle-circle-down text-2xl" /></label
										>
									</div>
									<div class=" bg-table--title custom-collapse-content rounded-b-xl">
										<div class="p-3 flex justify-between text-xs">
											<div>
												رشته‌های تحصیلی:
												<span class="-text--purple">
													{inojob.attributes.major.includes('all')
														? 'همه رشته‌ها'
														: inojob.attributes.major.join('،')}
												</span>
											</div>
											<div>
												نام سازمان زیر مجموعه:
												<span class="-text--purple">{inojob.attributes.emp.name} </span>
											</div>
											<div>
												مقطع تحصیلی:
												<span class="-text--purple"> {getDegree[inojob.attributes.degree]}</span>
											</div>
											<div>
												ثبت نامی‌ها:
												<span class="-text--purple">{inojob.attributes.count.requests} نفر</span>
											</div>
											<div>
												ظرفیت:
												<span class="-text--purple">{inojob.attributes.count.count} نفر </span>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="flex justify-between items-center w-full p-3 h-18 rounded-xl my-3"  transition:fade={{duration:300}}>
                                <div class="w-1/12 text-center flex items-center justify-start">
                                    <span class="bg-button--primary rounded-lg w-10 h-10 grid place-items-center me-3 cursor-pointer">+</span>
                                    <span>{index+1}</span>
                                </div>
                            </div> -->
							{/each}
						</div>
					{/if}
				</div>
			</div>
		{:else}
			<AddOrder on:open={openOrder} />
		{/if}
	</div>
	{#if !firstPending}
		<div transition:fade={{ duration: 200 }}>
			<InojobList bind:showList on:updatePriorities={updatePriorities} bind:updated_add />
		</div>
	{/if}
{/if}

<style>
	.order-container > div:nth-child(odd) {
		background-color: #393939;
	}
	.order-container > div:nth-child(even) {
		background-color: #4c4c4c;
	}
</style>
