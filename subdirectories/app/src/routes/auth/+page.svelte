<script>
	import axios from 'axios';
	axios.default.withCredentials = true;
	import { goto } from '$app/navigation';
	import First from '$lib/components/auth/First.svelte';
	import Second from '$lib/components/auth/Second.svelte';
	import Third from '$lib/components/auth/Third.svelte';
	import { closeLoading, loginUser } from '$lib/main.js';
	import { API_URL } from '$lib/main';
	let showFirst = true;
	let showSecond = false;
	let showThird = false;
	$: error = null;
	$: expireTime = '';
	$: nowTime = '';
	let token = '';
	let phone, code, first_name, last_name, melli_code, myBtnFirst, myBtnSecond, myBtnThird;
	const sendPhone = async () => {
		await axios
			.post(`${API_URL}/getCode`, {
				phone: phone
			})
			.then(function (response) {
				console.log(response);
				if (response.data.status == 'success') {
					expireTime = response.data.data.expire;
					nowTime = response.data.data.now;
					showFirst = false;
					showSecond = true;
					error = null;
					console.log(expireTime, nowTime);
					closeLoading(myBtnSecond, 'ارسال کد');
					closeLoading(myBtnFirst, 'تایید');
				} else {
					error = response.error;
					closeLoading(myBtnFirst, 'تایید');
				}
			})
			.catch(function (err) {
				console.log(err);
				error = err.response.data.message;
				closeLoading(myBtnFirst, 'تایید');
			});
	};
	const sendCode = async () => {
		await axios.get(`https://inova.ir/sanctum/csrf-cookie`, { withCredentials: true });
		await axios
			.post(
				`${API_URL}/sendCode`,
				{
					phone: phone,
					code: code
				},
				{ headers: { Authorization: `Bearer ${token}` } }
			)
			.then(function (response) {
				if (response.data.status == 'success') {
					error = null;
					// closeLoading(myBtnSecond , 'ارسال کد');
					token = response.data.data.token;
					if (response.data.message) {
						showSecond = false;
						showThird = true;
					} else {
						loginUser(token);
						// axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
						goto('/inojob/private');
					}

					console.log(token);
				} else {
					error = response.error;
					closeLoading(myBtnSecond, 'ارسال کد');
					code = [];
				}
			})
			.catch(function (err) {
				console.log(err);
				error = err.response.data.message;
				closeLoading(myBtnSecond, 'ارسال کد');
				code = [];
			});
	};
	const sendName = async () => {
		console.log(token);
		await axios
			.post(
				`${API_URL}/updateUser`,
				{
					first_name: first_name,
					last_name: last_name,
					melli_code: melli_code
				},
				{ headers: { Authorization: `Bearer ${token}` } }
			)
			.then(function (response) {
				if (response.data.status == 'success') {
					showSecond = false;
					showThird = false;
					error = null;
					loginUser(token);
					goto('/inojob/private');
				} else {
					error = response.error;
					closeLoading(myBtnThird, 'ثبت نام');
				}
			})
			.catch(function (err) {
				console.log(err);
				// error = err.response.data.message;
				closeLoading(myBtnThird, 'ثبت نام');
			});
	};
</script>

<main>
	<div class="login-container flex items-center h-screen w-full p-8">
		<div
			class="backdrop-blur bg--gray-03 h-full rounded-2xl lg:px-10 py-7 border border-slate-400 xl:w-5/12 lg:w-6/12 md:w-8/12 sm:w-9/12 w-full lg:m-0 mx-auto flex justify-center items-center"
		>
			<div class="flex flex-col items-start w-full xl:p-28 md:p-10 p-3">
				<First bind:myBtnFirst {error} {showFirst} on:sendPhone={sendPhone} bind:phone />
				<Second
					bind:myBtnSecond
					{error}
					{expireTime}
					{nowTime}
					{showSecond}
					on:sendCode={sendCode}
					on:sendAgain={sendPhone}
					bind:code
				/>
				<Third
					bind:myBtnThird
					{error}
					{showThird}
					on:sendName={sendName}
					bind:first_name
					bind:last_name
					bind:melli_code
				/>
			</div>
		</div>
	</div>
</main>

<style>
	.login-container {
		background-image: url('/img/authBg.webp');
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>
