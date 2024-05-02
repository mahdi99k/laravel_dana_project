<script>
	import { loading } from '../../main';
    import { slide } from 'svelte/transition';
    export let showFirst;
    export let phone = '';
    export let error;
    export let myBtnFirst;
    let prevLoading = '';
    import { createEventDispatcher } from 'svelte';
    let dispatch = createEventDispatcher();
    
    // console.log(error , 'error');
    function sendPhone(){
        phone = "0"+phone.toString();
        
        if(phone.length != 11 || (!phone.startsWith('09') && !phone.startsWith('۰۹')) ){
            error = 'شماره تلفن خود را به درستی وارد نمایید';
            return;
        }
        prevLoading = loading(myBtnFirst);
        dispatch('sendPhone');
    }
    function btnLoading(node){
        myBtnFirst = node;
    }
    if(!showFirst){
        myBtnFirst.innerHTML = prevLoading;
        myBtnFirst.style.filter = 'saturate(1)';
        myBtnFirst.disabled = false;
    }
    
</script>
{#if showFirst}
<form class="flex flex-col w-full" transition:slide={{ duration: 300 }} on:submit|preventDefault={()=>{sendPhone()}}>
    <img src="img/logo.svg" alt="logo" class="mb-5 w-28">
    <h2 class="text-xl text-white">ورود / ثبت‌نام</h2>
    <span class="text-text--gray my-5">لطفا شماره موبایل خود را وارد کنید</span>
    <input type="number" bind:value={phone} class="input rounded-xl h-14 border-white bg-transparent focus:outline-none w-full text-sm text-white" placeholder="برای مثال: 09123456789">
    {#if error != null}
        <span class="-text--error">{error}</span>
    {/if}
    <button type="submit" use:btnLoading class="bg--primary w-full mt-7 rounded-xl h-14 text-white" >تایید
        <!-- <span class="loading loading-dots loading-md"></span> -->
    </button>
</form>
{/if}

