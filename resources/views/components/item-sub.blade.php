@props(['active' => false, 'module', 'chapter'])

<div
	class="flex-shrink-0 w-7 h-7 rounded-full bg-gray-100 inline-flex items-center justify-center ring-1 ring-inset ring-gray-300/50 relative z-10">
	@if ($active)
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-green-600">
			<path fill-rule="evenodd"
				d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z"
				clip-rule="evenodd" />
		</svg>
	@else
		<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
			class="w-4 h-4 text-gray-400">
			<path stroke-linecap="round" stroke-linejoin="round"
				d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
		</svg>
	@endif
</div>
<div class="flex-grow pl-4 rtl:pr-4">
	@if ($active)
		<a href="{{ route('courses.learn', [$module, $chapter]) }}" class="leading-relaxed text-gray-800 hover:underline">
			{{ $chapter->title }}
		</a>
		{{-- <p class="leading-relaxed text-gray-400">
			{{ $chapter->title }}
		</p> --}}
	@else
		<p class="leading-relaxed text-gray-400">
			{{ $chapter->title }}
		</p>
	@endif
</div>
