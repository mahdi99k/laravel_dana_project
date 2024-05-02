<script>
	export let showPersonalDetails = true;
	import { fade } from 'svelte/transition';
	import axios from 'axios';
	import { onMount, afterUpdate } from 'svelte';
	import { getCookie, API_URL } from '$lib/main';
	let first_name,
		last_name,
		father,
		gender,
		birthday,
		melli_code,
		melli_serial,
		melli_city,
		marital,
		nationality,
		latin_lName,
		latin_fName,
		melli_number,
		birth_country,
		birth_province,
		birth_city,
		disability,
		personalStatus,
		military;
	export let USER;
	import { createEventDispatcher } from 'svelte';
	import DataBox from '../DataBox.svelte';
	let dispatch = createEventDispatcher();

	const handleClick = () => {
		dispatch('handleClick');
	};

	afterUpdate(() => {
		first_name = USER.first_name;
		last_name = USER.last_name;
		father = USER.about.father;
		gender = USER.about.gender;
		birthday = USER.birthday;
		melli_city = USER.melli.city;
		melli_code = USER.melli.code;
		melli_serial = USER.melli.serial;
		melli_number = USER.melli.number;
		marital = USER.about.marital;
		military = USER.about.military;
		latin_lName = USER.more.latin_lName;
		latin_fName = USER.more.latin_fName;
		nationality = USER.more.nationality;
		birth_city = USER.more.birth_city;
		birth_country = USER.more.birth_country;
		birth_province = USER.more.birth_province;
		disability = USER.more.disability;
		personalStatus = USER.inojob.personal_status;
	});
</script>

{#if showPersonalDetails}
	<div
		in:fade={{ duration: 200, delay: 200 }}
		out:fade={{ duration: 200 }}
		class="bg-table--title border border-input--border md:p-5 p-2 rounded-xl my-5"
	>
		<div class="flex flex-wrap">
			<DataBox label="نام" data={first_name} />
			<DataBox label="نام خانوادگی" data={last_name} />
			<DataBox label="نام لاتین" data={latin_fName} />
			<DataBox label="نام خانوادگی لاتین" data={latin_lName} />
			<DataBox label="نام پدر" data={father} />
			<DataBox label="جنسیت" data={gender == 2 ? 'زن' : (gender == 1 ? 'مرد' : 'ثبت نشده')} />
			<DataBox label="تاریخ تولد" data={birthday} />
			<DataBox label="کد ملی" data={melli_code} />
			<DataBox label="سریال شناسنامه" data={melli_serial} />
			<DataBox label="شماره شناسنامه" data={melli_number} />
			<DataBox label="محل صدور شناسنامه" data={melli_city} />
			<DataBox label="وضعیت تاهل" data={marital} />
			<DataBox label="معلولیت" data={disability ? 'بله' : 'خیر'} />
			<DataBox label="تابعیت" data={nationality} />
			{#if gender != 'زن'}
				<DataBox label="وضعیت سربازی" data={military} />
			{/if}
			<DataBox label="کشور محل تولد" data={birth_country} />
			<DataBox label="استان محل تولد" data={birth_province} />
			<DataBox label="شهر محل تولد" data={birth_city} />
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
