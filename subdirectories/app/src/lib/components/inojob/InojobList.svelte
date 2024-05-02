<script>
	import axios from 'axios';
	import { fade, slide } from 'svelte/transition';
	// console.log(API_URL);
	import { API_URL, getCookie, makeSlider } from '../../main';
	import { afterUpdate, onMount } from 'svelte';
	import SearchSelect from '../forms/SearchSelect.svelte';
	import { createEventDispatcher } from 'svelte';
	import MessageModal from '../modals/MessageModal.svelte';
	let dispatch = createEventDispatcher();

	//pages
	let last_page, current_page;
	let messageType = 'error';
	let showMessage = false;
	let message;
	export let showList = false;
	export let updated_add = false;
	let updated = false;
	let inojobs = [];
	let isPending = true;
	$: select = '';
	$: userPriorities = [];
	let formData = {};
	let inojobInfo = { major: [], province: [], degree: [], employer: [] };
	inojobInfo.degree = [
		['کارشناسی / ارشد / دکتری', 'bachelor'],
		['کارشناسی ارشد /دکتری', 'master'],
		['دکتری', 'doctor']
	];
	let getDegree = {
		bachelor: 'کارشناسی / ارشد / دکتری',
		master: 'کارشناسی ارشد /دکتری',
		doctor: 'دکتری'
	};
	// formData.title = '';
	// formData.province = '';
	// formData.major = '';
	// formData.degree = '';
	// formData.employer = '';
	var searchTimeout;
	// onMount(()=>{
	formData.title = '';
	formData.province = '';
	formData.major = '';
	formData.degree = '';
	formData.employer = '';
	// });
	let page = 1;
	const close = () => {
		showList = false;
		if (updated) dispatch('updatePriorities');
	};
	const getInojobs = async () => {
		isPending = true;
		if (searchTimeout) clearTimeout(searchTimeout);
		searchTimeout = setTimeout(async () => {
			console.log(formData.degree, 'list');
			let params = `title=${formData.title || ''}&province=${
				formData.province || ''
			}&major=[${formData.major || ''}]&degree=${formData.degree || ''}&employer=${
				formData.employer || ''
			}&page=${page}&group=1`;
			await axios
				.get(`${API_URL}/getInojobs?${params}`)
				.then(function (response) {
					inojobs = response.data.data;
					current_page = response.data.meta.current_page;
					last_page = response.data.meta.last_page;
					isPending = false;
				})
				.catch(function (err) {
					console.log(err);
				});
		}, 400);
	};
	let inojob_slider = '';
	function inojobSlider(node) {
		inojob_slider = node;
		makeSlider(inojob_slider);
	}
	async function getUserPriorities() {
		const api_token = getCookie('api_token');
		await axios
			.get(`${API_URL}/getUser`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then(function (response) {
				console.log(response.data);
				let myData = response.data.data.inojob.priorities;
				userPriorities = [];
				Object.keys(myData).forEach(d=>{
					userPriorities = [...userPriorities , Number(d)];
				})
				console.log(userPriorities , 'ooooooooo')
			});
	}
	onMount(async () => {
		await getUserPriorities();
		getInojobs();
	});
	const inojobsInfo = async () => {
		await axios
			.get(`${API_URL}/getInojobsFields`)
			.then(function (response) {
				inojobInfo.province = response.data.data.provinces;
				inojobInfo.employer = response.data.data.employers;
				inojobInfo.major = response.data.data.majors;
				console.log(inojobInfo.degree);
			})
			.catch(function (err) {
				console.log(err);
			});
	};
	console.log('uuuuuuuuu' , userPriorities);
	async function addPriority(id) {
		console.log('mmmmmm' , userPriorities);
		updated = true;
		const api_token = getCookie('api_token');
			if (userPriorities.includes(Number(id))) {
				message = 'اولویت با موفقیت حذف شد';
				messageType = 'success';
				showMessage = true;
				userPriorities = userPriorities.filter((item) => item != Number(id));
			} else {
				if (userPriorities.length >= 3) {
					message = 'اولویت‌های شما به حداکثر رسیده است';
					messageType = 'error';
					showMessage = true;
					return;
				}
				message = 'اولویت با موفقیت اضافه شد';
				messageType = 'success';
				showMessage = true;
				userPriorities = [...userPriorities, Number(id)];
			}

		await axios
			.post(
				`${API_URL}/setPriority`,
				{ priorities: userPriorities },
				{ headers: { Authorization: `Bearer ${api_token}` } }
			)
			.then(function (response) {});
	}
	afterUpdate(() => {
		if (updated_add) {
			getUserPriorities();
			getInojobs();
			updated_add = false;
		}
	});
	inojobsInfo();
</script>

<!-- svelte-ignore a11y-no-static-element-interactions -->
{#if showList}
	<MessageModal bind:message bind:showMessage bind:type={messageType} />
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<div
		class="fixed bg-black bg-opacity-50 w-screen h-screen top-0 start-0 z-40"
		on:click|self={close}
		transition:fade={{ duration: 200 }}
	>
		<div
			class="lg:w-10/12 w-full list-scrollbar-inojob mx-auto my-auto bg-base--gray p-4 rounded-xl lg:mt-10"
		>
			<button class="bg-score--low h-10 w-10 rounded-lg mb-4" on:click={close}>
				<i class="fi fi-rr-cross-small" />
			</button>
			<div class="flex justify-between items-center mb-4 flex-wrap w-full">
				<div
					class="bg-table--title rounded-2xl overflow-hidden flex justify-between border border-input--border h-12 lg:w-4/12 w-full"
				>
					<input
						type="text"
						placeholder="جستجو در عنوان شغل‌ها یا کد شغلی"
						class="w-full border-none outline-none h-full p-3 text-white bg-transparent"
						on:keyup={() => {
							page = 1;
							getInojobs();
						}}
						bind:value={formData.title}
					/>
					<div
						class="bg-button--socondary flex justify-center items-center h-full aspect-square border-r border-input--border"
					>
						<i class="fi fi-rr-search text-2xl text-text--gray" />
					</div>
				</div>
				<div class=" w-full lg:w-7/12 p-3 flex gap-3 py-0 lg:mt-0 mt-4">
					<div class="w-1/3">
						<SearchSelect
							label="استان"
							required={false}
							showLabel={false}
							data={inojobInfo.province}
							on:select={({ detail }) => {
								page = 1;
								formData.province = detail;
								getInojobs();
							}}
						/>
					</div>
					<div class="w-1/3">
						<SearchSelect
							label="رشته تحصیلی"
							required={false}
							showLabel={false}
							data={inojobInfo.major}
							on:select={({ detail }) => {
								formData.major = detail;
								page = 1;
								getInojobs();
							}}
						/>
					</div>
					<div class="w-1/3">
						<SearchSelect
							label="نام سازمان"
							required={false}
							showLabel={false}
							data={inojobInfo.employer}
							on:select={({ detail }) => {
								formData.employer = detail;
								page = 1;
								getInojobs();
							}}
						/>
					</div>
					<div class="w-1/3">
						<SearchSelect
							search={false}
							multi={true}
							showLabel={false}
							label="مقطع"
							required={false}
							data={inojobInfo.degree}
							on:select={({ detail }) => {
								formData.degree = detail[1];
								page = 1;
								getInojobs();
							}}
						/>
					</div>
				</div>
			</div>
			<div
				class="overflow-x-scroll overflow-y-hidden inojob-slider inojob-list-scroll purple-scrollbar"
				use:inojobSlider
			>
				<div class="list-container h-full">
					{#if inojobs.length > 0}
						<div
							class="flex justify-between items-center bg-table--purple w-full p-3 h-18 rounded-xl"
						>
							<div class="w-2/12 text-center">کد</div>
							<div class="w-5/12 text-center">عنوان شغلی</div>
							<div class="w-3/12 text-center">نام سازمان</div>
							<div class="w-2/12 text-center">نام استان</div>
							<div class="w-2/12 text-center">جزئیات بیشتر</div>
						</div>
					{/if}
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
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
							<div class="rounded-lg h-18 flex items-center md:p-5 p-2 my-3 w-full" />
						</div>
					{:else if inojobs.length > 0}
						<div
							class="order-container purple-scrollbar flex flex-col mt-2 overflow-y-scroll h-full"
						>
							{#each inojobs as inojob}
								<div class="my-3 rounded-xl">
									<input
										type="checkbox"
										class="hidden custom-collapse-input"
										id="collapse-list-{inojob.id}"
										name="custom-collapse"
									/>
									<div class=" font-medium flex p-3">
										<button
											class="w-2/12 flex items-center justify-start"
											on:click={() => addPriority(inojob.id)}
										>
												{#if userPriorities.includes(Number(inojob.id))}
													<span
														in:slide={{ duration: 200, delay: 200 }}
														out:slide={{ duration: 200 }}
														class="bg-button--success rounded-lg w-10 h-10 grid place-items-center me-3 cursor-pointer"
														>-</span
													>
												{:else}
													<span
														in:slide={{ duration: 200, delay: 200 }}
														out:slide={{ duration: 200 }}
														class="bg-button--primary rounded-lg w-10 h-10 grid place-items-center me-3 cursor-pointer"
														>+</span
													>
												{/if}
											<span>{inojob.id}</span>
										</button>
										<div class="w-5/12 text-center">
											{inojob.attributes.title}
										</div>
										<div class="w-3/12 text-center">
											{inojob.attributes.employer.name}
										</div>
										<div class="w-2/12 text-center">
											{inojob.attributes.location.province}
										</div>
										<label
											for="collapse-list-{inojob.id}"
											class="w-2/12 text-center cursor-pointer"
											><i
												class="fi fi-rr-angle-circle-down text-2xl"
											/></label
										>
									</div>
									<div
										class=" bg-table--title custom-collapse-content rounded-b-xl"
									>
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
												<span class="-text--purple"
													>{inojob.attributes.emp.name}</span
												>
											</div>
											<div>
												مقطع تحصیلی:
												<span class="-text--purple">
													{getDegree[inojob.attributes.degree]}</span
												>
											</div>
											<div>
												ثبت نامی‌ها:
												<span class="-text--purple"
													>{inojob.attributes.count.requests} نفر</span
												>
											</div>
											<div>
												ظرفیت:
												<span class="-text--purple"
													>{inojob.attributes.count.count} نفر
												</span>
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
					{:else}
						<p class="text-center pt-7">نتیجه ای یافت نشد</p>
					{/if}
				</div>
			</div>
			{#if inojobs.length > 0}
				<div>
					<div
						class="lg:w-5/12 sm:w-8/12 w-full flex bg-table--item rounded-lg h-14 mx-auto my-2"
					>
						<button
							on:click={() => {
								page++;
								getInojobs();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}"><i class="fi fi-rr-angle-right" /></button
						>
						<button
							on:click={() => {
								page = last_page;
								getInojobs();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}"
							>{last_page || ''}
						</button>
						<button class="cursor-pointer rounded-lg grid place-items-center w-1/6"
							>...</button
						>
						<button
							on:click={() => {
								page++;
								getInojobs();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							last_page
								? 'text-text--gray pointer-events-none'
								: ''}">{current_page + 1 || ''}</button
						>
						<button
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 bg-table--purple"
							>{current_page || ''}</button
						>
						<button
							on:click={() => {
								page--;
								getInojobs();
							}}
							class="cursor-pointer rounded-lg grid place-items-center w-1/6 {current_page ==
							1
								? 'text-text--gray pointer-events-none'
								: ''}"><i class="fi fi-rr-angle-left" /></button
						>
					</div>
				</div>
			{/if}
		</div>
	</div>
{/if}

<style>
	.order-container > div:nth-child(odd) {
		background-color: #393939;
	}
	.order-container > div:nth-child(even) {
		background-color: #4c4c4c;
	}
	.inojob-list-scroll {
		height: calc(100% - 260px);
	}
	.list-scrollbar-inojob {
		height: 100vh;
	}
	@media screen and (min-width: 1024px) {
		.inojob-list-scroll {
			height: calc(100% - 200px);
		}
		.list-scrollbar-inojob {
			height: 90%;
		}
	}
</style>
