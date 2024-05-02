<script>
	import { USER } from '$lib/main';
	import AddOrder from '$lib/components/inojob/AddOrder.svelte';
	import InojobList from '$lib/components/inojob/InojobList.svelte';
    import OrderList from '$lib/components/inojob/OrderList.svelte';
    import { fade, slide } from 'svelte/transition';
    import { getUser } from "$lib/main.js";
	import { onMount } from 'svelte';
	import Input from '$lib/components/forms/Input.svelte';
    let showAdd = false;
    let showOrder = true;
    let showList = false;
    
    // console.log(USER);
</script>


<div in:fade={{duration:200 , delay:200}} out:fade={{duration:200}} class="bg-base--gray rounded-lg p-5 mt-5">
    <!-- <div class="bg-table--title rounded-lg p-3 flex justify-between h-20 items-center mb-8">
        <span class="texxt-white text-xl">اولویت جایگاه شغلی</span>
        <i class="text-2xl"></i>
    </div> -->
    <!-- <OrderList/> -->
    <OrderList />
        
</div>


