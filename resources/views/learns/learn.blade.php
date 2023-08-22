<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900" x-data="{ listMenu: false }">

		<div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-b-gray-700/60 py-5 px-8 z-[51]">
			<div class="flex items-center justify-between">
				<a href="{{ route('courses.show', $module->course) }}"
					class="flex items-center gap-x-2 text-gray-800 dark:text-gray-50">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
					</svg>
					<p class="font-semibold text-base hidden md:block">{{ $module->course->name }}</p>
				</a>

				<button type="button" class="text-gray-800 dark:text-white" x-on:click="listMenu = !listMenu">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6">
						<path stroke-linecap="round" stroke-linejoin="round"
							d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
					</svg>
				</button>
			</div>
		</div>

		<div class="relative h-fit flex">

			<div class="max-w-4xl mx-auto w-full px-4 mb-28 py-10 sm:px-0">
				<h2 class="text-3xl text-gray-800 dark:text-white font-semibold">
					{{ $currentSubmodule->title }}
				</h2>

				<article class="py-10 prose dark:prose-invert lg:prose-xl">
					{!! $currentSubmodule->material->content !!}
				</article>
			</div>

			{{-- List modules --}}
			<div x-cloak :class="listMenu ? 'translate-x-0' : 'translate-x-96'"
				class="fixed right-0 p-6 overflow-y-auto border-l w-96 h-full bg-white dark:bg-slate-700 dark:border-l-gray-700/60 transition duration-300">

				<h3 class="font-semibold text-xl text-gray-800 dark:text-white">
					Daftar Submodul
				</h3>

				<div class="border-t my-6"></div>

				<div class="">
					<p class="font-bold mb-4 text-lg text-gray-700 dark:text-gray-50">
						{{ $module->title }}
					</p>

					<div class="pl-6 flex flex-col space-y-4">
						@foreach ($module->submodules->sortBy('list_sort') as $submodule)
							<x-nav-module href="{{ route('courses.learn', [$module, $submodule]) }}" :active="$currentSubmodule->id === $submodule->id">
								{{ $submodule->title }}
							</x-nav-module>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="fixed bottom-0 inset-x-0 z-[60]">
			<div
				class="w-full flex items-center justify-between bg-white dark:bg-gray-800 py-4 px-4 md:px-10 border-t dark:border-t-gray-700/60">
				@if ($prevSubmodule)
					<a href="{{ route('courses.learn', [$module, $prevSubmodule]) }}"
						class="px-6 py-1 text-gray-700 hover:text-richblack font-medium bg-gray-50 border border-gray-300 rounded hover:bg-gray-200">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
						</svg>
					</a>
				@else
					<p class="px-6 py-1 text-gray-400 font-medium bg-gray-50 border border-gray-200 rounded">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
							stroke="currentColor" class="w-5 h-5">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
						</svg>
					</p>
				@endif

				@if ($nextSubmodule)
					<a href="{{ route('courses.learn', [$module, $nextSubmodule]) }}"
						class="px-6 py-1 text-white hover:text-white font-semibold capitalize bg-amber-500 border-b-2 border-r-2 border-amber-600 rounded hover:bg-amber-500/80">
						Lanjut
					</a>
				@else
					<p class="px-6 py-1 text-gray-400 font-medium uppcase bg-gray-50 border border-gray-200 rounded">Lanjut</p>
				@endif
			</div>
		</div>

	</section>
</x-app-layout>
