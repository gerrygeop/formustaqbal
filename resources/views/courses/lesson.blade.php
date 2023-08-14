<x-app-layout>
	<section class="fixed inset-0 overflow-y-auto z-50 bg-gray-50 dark:bg-gray-900">

		<div class="sticky top-0 bg-white dark:bg-gray-800 border-b dark:border-b-gray-700/60 py-5 px-8 z-[51]">
			<a href="{{ route('courses.show', $course) }}" class="flex items-center gap-x-2 text-gray-800 dark:text-gray-50">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
				</svg>
				<p class="font-semibold text-base hidden md:block">{{ $course->name }}</p>
			</a>
		</div>

		<div class="relative h-fit flex">

			<div class="max-w-4xl mx-auto w-full px-4 mb-28 py-10 sm:px-0">
				<h2 class="text-3xl text-gray-800 dark:text-white font-semibold">{{ $currentSubmodule->title }}</h2>

				<article class="py-10 prose dark:prose-invert lg:prose-xl">
					{!! $currentSubmodule->material->content !!}
				</article>
			</div>

			{{-- List modules --}}
			<div
				class="fixed right-0 p-6 overflow-y-auto border-l w-96 h-full bg-white dark:bg-slate-700 dark:border-l-gray-700/60">
				<h5 class="font-semibold text-xl text-gray-800 dark:text-white">
					Module
				</h5>

				<div>
					@foreach ($course->modules as $module)
						<p class="font-bold py-4 text-gray-800 dark:text-gray-50">
							> {{ $module->title }}
						</p>

						<div class="pl-6 flex flex-col space-y-4">
							@foreach ($module->submodules->sortBy('list_sort') as $submodule)
								<x-nav-module href="{{ route('courses.lesson', [$course, $submodule]) }}" :active="$currentSubmodule->id === $submodule->id">
									{{ $submodule->title }}
								</x-nav-module>
							@endforeach
						</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="fixed bottom-0 inset-x-0 z-[60]">
			<div
				class="flex items-center justify-between bg-white dark:bg-gray-800 py-4 px-10 w-full border-t dark:border-t-gray-700/60">
				@if ($prevSubmodule)
					<a href="{{ route('courses.lesson', [$course, $prevSubmodule]) }}"
						class="px-6 py-1 text-gray-700 hover:text-richblack font-medium bg-gray-50 border border-gray-300 rounded hover:bg-gray-200">Prev</a>
				@else
					<p class="px-6 py-1 text-gray-400 font-medium bg-gray-50 border border-gray-200 rounded">Prev</p>
				@endif

				@if ($nextSubmodule)
					<a href="{{ route('courses.lesson', [$course, $nextSubmodule]) }}"
						class="px-6 py-1 text-white hover:text-white font-semibold uppercase bg-amber-500 border-b-2 border-r-2 border-amber-600 rounded hover:bg-amber-500/80">
						Lanjut
					</a>
				@else
					<p class="px-6 py-1 text-gray-400 font-medium uppcase bg-gray-50 border border-gray-200 rounded">Lanjut</p>
				@endif
			</div>
		</div>

	</section>
</x-app-layout>
