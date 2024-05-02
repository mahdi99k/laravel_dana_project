<script>
	import { fade, slide } from 'svelte/transition';
	import SearchSelect from "$lib/components/forms/SearchSelect.svelte";
	import { USER} from "$lib/main";
	import MultiSelect from '$lib/components/forms/MultiSelect.svelte';
	import axios from 'axios';
	import { API_URL , getCookie } from '$lib/main';
	import { afterUpdate } from 'svelte';
    
        
</script>

<div class="bg-base--gray rounded-lg mx-auto p-5 mt-5" in:fade={{duration:200 , delay:200}} out:fade={{duration:200}}>
    <div  class="flex items-center justify-between gap-3 flex-wrap">
        <div class="lg:w-5/12 w-full">
            <img src="/img/inojob/score-bg.svg" alt="score background" class="w-full">
        </div>
        <div class="lg:w-6/12 flex flex-col w-full">
            <h2 class="lg:text-2xl text-lg">
                با کامل کردن فرم‌ها امتیاز خود را افزایش دهید
            </h2>
            <p class="text-text--gray lg:text-lg text-sm mt-2">
                فرم های سمت راست را کامل کنید تا امتیاز بگیرید و شانس خود را برای استخدام افزایش دهید.
            </p>
            <div class="flex flex-col mt-10">
                <div class="flex items-center">
                    <div class="rounded-full bg-table--item w-12 h-12 grid place-items-center ratio-square">
                        <i class="fi fi-rr-rocket text-3xl text-base--icon"></i>
                    </div>
                    <div class="ms-5">
                        <span class="lg:text-xl text-lg block mb-3">امتیاز دریافت کن</span>
                        <span class="text-text--gray lg:text-base text-sm">هر فرم دارای امتیاز می باشد و امتیاز آن و امتیاز کسب شده توسط شما ، در زیر هر فرم قابل مشاهده می باشد. </span>
                    </div>
                </div>
                <div class="flex items-center mt-20">
                    <div class="rounded-full bg-table--item w-12 h-12 grid place-items-center ratio-square">
                        <i class="fi fi-rr-chart-pie-alt text-3xl text-base--icon"></i>
                    </div>
                    <div class="ms-5">
                        <span class="lg:text-xl text-lg block mb-3">فرم‌های مرحله‌ای</span>
                        <span class="text-text--gray lg:text-base text-sm">بعضی از فرم‌ها مرحله ای هستند و با گذراندن مراحل کامل می شوند.</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="w-5/12">
    </div>
</div>