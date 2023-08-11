<x-app-layout>
	<div class="max-w-7xl mx-auto">
		<div class="grid grid-cols-1 gap-y-14">

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">
						Pelajaran Saya
					</h3>
				</div>

				{{-- Progress card --}}
				<div class="grid grid-cols-2 gap-4">
					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100">
							<div class="flex items-center space-x-2">
								<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Arab</h2>
								<img src="{{ asset('logo/Arabic.svg') }}" alt="Arabic" class="h-8 w-auto">
							</div>
							<span class="text-sm text-green-400">Level 2</span>

							<div class="flex items-center justify-between mt-4">
								<span>Progress bar</span>
								<button class="px-4 py-1 rounded bg-green-600">Lanjut</button>
							</div>
						</div>
					</div>

					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100">
							<div class="flex items-center space-x-2">
								<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Inggris</h2>
								<img src="{{ asset('logo/English.svg') }}" alt="English" class="h-8 w-auto">
							</div>
							<span class="text-sm text-red-400">Level 4</span>

							<div class="flex items-center justify-between mt-4">
								<span>Progress bar</span>
								<button class="px-4 py-1 rounded bg-red-600">Lanjut</button>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="col-span-1">
				<div class="flex mb-3">
					<h3 class="text-lg text-slate-500 leading-0 dark:text-slate-300">
						Bahasa Lainnya
					</h3>
				</div>

				{{-- Bahasa lain --}}
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100 h-full">

							<div class="flex flex-col justify-between gap-y-4 h-full">
								<div>
									<div class="flex items-center space-x-2">
										<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Arab</h2>
										<img src="{{ asset('logo/Arabic.svg') }}" alt="Arabic" class="h-8 w-auto">
									</div>
									<span class="text-sm">Dasar</span>
									<p class="text-gray-700 mt-3">
										Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ipsa, rem, omnis excepturi accusantium ratione
										fugiat voluptatum quaerat laborum inventore praesentium tempora saepe nihil eius.
									</p>
								</div>

								<div class="flex items-center justify-between">
									<span>20 Modul</span>
									<span>103 Siswa terdaftar</span>
								</div>
							</div>

						</div>
					</div>

					<div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
						<div class="p-6 text-gray-900 dark:text-gray-100 h-full">

							<div class="flex flex-col justify-between gap-y-4 h-full">
								<div>
									<div class="flex items-center space-x-2">
										<h2 class="text-2xl text-slate-800 dark:text-gray-50">Bahasa Inggris</h2>
										<img src="{{ asset('logo/English.svg') }}" alt="English" class="h-8 w-auto">
									</div>
									<span class="text-sm">Dasar</span>
									<p class="text-gray-700 mt-3">
										Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio molestiae
										voluptatum velit culpa ea id, a quisquam vitae. Consequuntur temporibus et.
									</p>
								</div>

								<div class="flex items-center justify-between">
									<span>20 Modul</span>
									<span>103 Siswa terdaftar</span>
								</div>
							</div>

						</div>
					</div>

				</div>
			</section>

		</div>
	</div>
</x-app-layout>
