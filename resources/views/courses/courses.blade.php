<x-app-layout>
	<div class="max-w-4xl mx-auto">
		<div class="grid grid-cols-1 gap-y-14">

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-800 leading-0 dark:text-slate-100">
						Daftar Kelas {{ $subject }}
					</h3>
				</div>

				<div class="grid grid-cols-1 gap-4">

					@forelse ($courses as $course)
						<a href="{{ route('courses.show', $course) }}"
							class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm border border-transparent hover:border-yellow-500 sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100 h-full">

								<div class="flex items-center justify-between">
									<div class="flex items-center gap-x-4">
										<div class="w-12 h-12 bg-white border flex items-center justify-center rounded-full">
											<div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
												<span class="text-2xl text-white font-bold">1</span>
											</div>
										</div>
										<h2 class="font-semibold text-2xl text-yellow-500 dark:text-gray-50">
											{{ $course->name }}
										</h2>
									</div>
									<div class="text-gray-700 flex items-center gap-x-2">
										<span>{{ $course->modules_count }} Level</span>
									</div>
								</div>

							</div>
						</a>

					@empty
						<div class="col-span-full bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
							<div class="p-6 text-gray-900 dark:text-gray-100">
								<div class="flex items-center justify-center space-x-2">
									<h2 class="text-lg text-slate-600 dark:text-gray-50">
										Belum ada daftar kelas yang bisa ditampilkan
									</h2>
								</div>
							</div>
						</div>
					@endforelse

				</div>
			</section>

		</div>
	</div>
</x-app-layout>
