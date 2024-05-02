<script>
	import { scale } from 'svelte/transition';
	import { afterUpdate } from 'svelte';
    export let showMessage = false;
    export let message = '';
    export let type = 'error';
    afterUpdate(()=>{
        console.log('upda');
        if(showMessage){
            setTimeout(()=>{
                showMessage = false;
            } , 3000)
        }
    });
</script>
{#if showMessage}
    <div transition:scale={{duration:200}} class=" {type=='error' ? '-bg--error' : '-bg--success'}  rounded-lg p-3 fixed top-5 right-5 z-50 flex cursor-pointer max-w-full" on:click={()=>showError = false}>
        <p>{message}</p>
        <i class="fi fi-rr-rectangle-xmark ms-3"></i>
    </div>
{/if}