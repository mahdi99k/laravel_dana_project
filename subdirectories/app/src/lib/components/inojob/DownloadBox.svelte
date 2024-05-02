<script>
	export let label = 'دانلود فایل پیوست';
	export let url = '';
</script>

<div class="w-full lg:h-16 h-10 mb-2">
	<a
		target="_blank"
		href="https://inova.ir{url}"
		class="flex bg--primary rounded-lg h-full w-full justify-center items-center md:text-base text-sm"
		download="test"
	>
		<span>{label}</span>
		<i class="fi fi-rr-cloud-download-alt ms-1" />
	</a>
</div>
