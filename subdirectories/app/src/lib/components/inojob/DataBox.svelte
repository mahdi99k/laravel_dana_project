<script>
    export let label = '';
    export let data = '';
    export let responsive = true;
</script>

<div class="{responsive ? '2xl:w-3/12 lg:w-4/12 w-6/12 ' : (!responsive ? 'w-full' : responsive)} flex flex-col xl:p-7 sm:p-4 p-2">
    <span class="-text--purple lg:text-base text-xs">{label}</span>
    <span class="lg:text-lg text-sm mt-1">{data || 'ثبت نشده'}</span>
</div>