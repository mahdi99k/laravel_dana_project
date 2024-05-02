<script>
	export let data;
	export let active;
	let activeNow = 0;
</script>

<div class="flex items-start justify-center">
	{#each data as d, index}
		<div class="w-18 flex flex-col items-center">
			<div
				class="rounded-full w-10 h-10 border {index < active
					? 'border-score--up bg-score--up bg-opacity-12'
					: index == active
					? 'border-2 bg-opacity-12 bg-base--52 border-base--52'
					: 'border-base--52 bg-base--gray'} flex items-center justify-center mb-4"
			>
				<i class="fi {d.icon} text-xl mid" class:text-text--gray={active <= index} />
			</div>
			<span
				class="text-sm font-medium text-center w-full"
				class:text-text--gray={active <= index}>{d.name}</span
			>
		</div>
		{#if index + 1 != data.length}
			<div class="h-10 flex items-center justify-center mx-2">
				<div class="w-10 h-px bg-input--border" />
			</div>
		{/if}
	{/each}
</div>
