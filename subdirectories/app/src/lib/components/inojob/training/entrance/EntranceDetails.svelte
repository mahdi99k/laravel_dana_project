<script>
    export let showEntranceDetails;
    import DownloadBox from '../../DownloadBox.svelte';
	import DataBox from '../../DataBox.svelte';
	import ScoreDeletEdit from '../../ScoreDeletEdit.svelte';
    import { fade, slide } from 'svelte/transition';
    $: score = [];
	import axios from 'axios';
	import { API_URL, deleteScore, getCookie } from '../../../../main';
	import EntranceEdit from './EntranceEdit.svelte';
    export let showEntranceEdit = false;
    import {createEventDispatcher } from 'svelte';
    let dispatch = createEventDispatcher();
    async function getScores(){
        const api_token = getCookie('api_token');
        await axios.get(`${API_URL}/getScores/training/entrance` , {headers: {Authorization:`Bearer ${api_token}`}})
        .then(function(response){
            scores = response.data.data;
            // console.log(scores);
        })
    }
    export let scores = [];
    const deleteThis = async (id) => {
		await deleteScore(id);
		scores = scores.filter((data) => data.id != id);
	};
    const editThis = (detail) => {
		score = detail;
        showEntranceEdit = true;
        showEntranceDetails = false;
    }
    const editData = (detail)=>{
        scores[scores.indexOf(score)]  =detail;
        console.log(scores[scores.indexOf(score)] , detail);
    }

    
</script>
{#if showEntranceDetails}
    <button on:click={()=>{dispatch('handleClick')}} class="rounded-xl block w-full bg--primary text-lg h-14 text-white">
        افزودن 
    </button>
    {#each scores as score}
        <div transition:slide={{duration:200}} class="bg-table--title border border-input--border p-5 rounded-xl my-5">
            <div class="flex flex-wrap">
                <DataBox label="رشته" data={score.attributes.data.major } />
                <DataBox label="سال" data={score.attributes.data.year} />
                <DataBox label="رتبه کشوری" data={score.attributes.data.rank} />
                <DataBox label="منطقه" data={score.attributes.data.area} />
                <DataBox label="رتبه منطقه" data={score.attributes.data.area_rank} />
                <DownloadBox url={score.attributes.file1}/>

            </div>
            <ScoreDeletEdit on:editThis={()=>editThis(score)} on:deleteThis={()=>deleteThis(score.id)} status={score.attributes.status}/>
        </div>
    {/each}
{/if}

{#if showEntranceEdit}
    <div transition:fade={{duration:300}}>
	    <EntranceEdit {showEntranceEdit} on:handleClickCancel={()=>{showEntranceDetails = true; showEntranceEdit = false;}} bind:score on:handleClick={({detail})=>{editData(detail);showEntranceDetails = true; showEntranceEdit = false;}}/>
    </div>
{/if}
