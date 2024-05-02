<script>
	import { page, navigating } from '$app/stores';
	import { afterUpdate } from 'svelte';
	import axios from 'axios';
	import { goto } from '$app/navigation';
	import { API_URL, setCookie, getCookie } from '../../lib/main';
	export let api_token;
	// const USER = $page.data.user;
	// import user from '../user';
	// console.log(page.url);
	// $: isLoggedIn = $user === null ? false : true;
	$: pageName = '';
	$: api_token;
	afterUpdate(() => {
		api_token = getCookie('api_token');
		pageName = $page.url.pathname.substr($page.url.pathname.lastIndexOf('/'));
	});
	// export async function load({cookies}){
	// 	const api_token = cookies.get('api_token') ?? false;
	// 	return{
	// 		props:{
	// 			data: api_token
	// 		}
	// 	}
	// }
	// export let data;
	const logout = () => {
		axios
			.delete(`${API_URL}/logout`, { headers: { Authorization: `Bearer ${api_token}` } })
			.then(function (response) {
				setCookie('api_token', '', 0);
				setCookie('laravel_session', '', 0);
				setCookie('XSRF-TOKEN', '', 0);
				goto('/auth');
			});
	};
</script>

<div class="flex justify-between">
	<div class="lg:w-28" />
	<div class="lg:w-28 w-full fixed lg:top-0 bottom-0 z-30 lg:h-screen">
		<nav
			class="flex lg:flex-col h-full flex-row lg:p-3 px-6 py-1 w-full bg-base--gray items-center lg:justify-start justify-between custom"
		>
			<!-- <a
				href="/"
				class="lg:mb-6 px-3 py-1 flex flex-col items-center justify-center"
				class:active={pageName == '/'}
			>
				<i class="fi fi-rr-briefcase lg:text-2xl text-xl" />
				<span class="lg:hidden block">میز کار</span>
			</a> -->
			<!-- <a
				href="/cv"
				class="lg:mb-6 px-3 py-1 flex flex-col items-center justify-center"
				class:active={$page.url.pathname.includes('cv')}
			>
				<i class="fi fi-rr-document lg:text-2xl text-xl" />
				<span class="lg:hidden block">رزومه</span>
			</a> -->
			<a
				href="/inojob"
				class="lg:mb-6 px-3 py-1 flex flex-col items-center justify-center"
				class:active={$page.url.pathname.includes('inojob')}
			>
				<i class="fi fi-rr-bank lg:text-2xl text-xl" />
				<span class="lg:hidden block">جذب نیرو</span>
			</a>
			<button
				on:click={logout}
				class="lg:mb-6 px-3 py-1 flex flex-col items-center justify-center"
			>
				<i class="fi fi-rr-sign-out-alt lg:text-2xl text-xl" />
				<span class="lg:hidden block">خروج</span>
			</button>
			<!-- <a
				href="/user"
				class="lg:mb-6 px-3 py-1 flex flex-col items-center justify-center"
				class:active={$page.url.pathname.includes('user')}
			>
				<i class="fi fi-rr-user lg:text-2xl text-xl" />
				<span class="lg:hidden block">پروفایل</span>
			</a> -->
		</nav>
	</div>
	<div class="main-container lg:mb-0 mb-40 px-2">
		<slot />
	</div>
</div>

{#if $navigating}
	<style>
		* {
			pointer-events: none;
		}
		.main-container {
			animation: loadIt 1s ease-in-out infinite;
		}
		@keyframes loadIt {
			0% {
				filter: saturate(0.5) contrast(1);
			}
			50% {
				filter: saturate(0) contrast(0.5);
			}
			100% {
				filter: saturate(0.5) contrast(1);
			}
		}
	</style>
{/if}

<style>
	.main-container {
		width: calc(100% - 120px);
	}
	nav.custom a.active {
		border-bottom: 2px solid #d8b4fe;
		color: #d8b4fe !important;
		border-radius: 0;
	}
	.main-container {
		width: 100%;
	}
	@media screen and (min-width: 992px) {
		nav.custom a.active {
			background-color: #393939;
			color: #d8b4fe !important;
			border-radius: 8px;
			border: none;
		}
	}
</style>
