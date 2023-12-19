<x-app-layout>
	<div class="max-w-[90rem] mx-auto">
		<div class="py-8" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'list' }" id="tab_wrapper">

			<div class="grid grid-cols-1 lg:grid-cols-5 gap-y-4 lg:gap-y-0 lg:gap-x-4">

				<div class="col-span-1">
					@include('rooms.partials._navigation')
				</div>

				<section class="col-span-1 lg:col-span-4">
					<section class="mx-auto bg-white border rounded-md shadow-md dark:bg-gray-800 overflow-hidden">
						<form action="{{ route('rooms.form.store', $room) }}" method="POST">
							@csrf

							<div
								class="grid grid-cols-1 md:grid-cols-7 items-center gap-6 p-4 bg-gray-50 text-xs uppercase font-medium text-gray-600 border-b">
								<div class="col-span-1 md:col-span-2">
									<div>Nama</div>
								</div>
								<div class="col-span-1">
									Partisipasi
								</div>
								<div class="col-span-1">
									Tugas/Kuis
								</div>
								<div class="col-span-1">
									UTS
								</div>
								<div class="col-span-1">
									UAS
								</div>
								<div class="col-span-1">
									Nilai Akhir
								</div>
							</div>

							@foreach ($users as $user)
								<div class="py-2 px-4 border-b">

									<div class="grid grid-cols-1 md:grid-cols-7 items-center gap-4">
										<div class="col-span-1 md:col-span-2">
											<h2 class="font-semibold text-gray-700 capitalize">
												{{ $user->name }}
											</h2>
											<p class="font-normal text-sm text-gray-700 dark:text-white">{{ $user->username }}</p>
										</div>

										<input type="hidden" name="user_id[{{ $user->id }}]" value="{{ $user->id }}">

										<div class="col-span-1">
											<x-text-input id="partisipasi_{{ $user->id }}" name="partisipasi[{{ $user->id }}]" type="number"
												step="0.01" class="w-full" value="{{ $user->grade?->c1 ?? '0.00' }}" />
										</div>

										<div class="col-span-1">
											<x-text-input id="tugas_{{ $user->id }}" name="tugas[{{ $user->id }}]" type="number" step="0.01"
												class="w-full" value="{{ $user->grade?->c2 ?? '0.00' }}" />
										</div>

										<div class="col-span-1">
											<x-text-input id="uts_{{ $user->id }}" name="uts[{{ $user->id }}]" type="number" step="0.01"
												class="w-full" value="{{ $user->grade?->c3 ?? '0.00' }}" />
										</div>

										<div class="col-span-1">
											<x-text-input id="uas_{{ $user->id }}" name="uas[{{ $user->id }}]" type="number" step="0.01"
												class="w-full" value="{{ $user->grade?->c4 ?? '0.00' }}" />
										</div>

										<div class="col-span-1">
											<div class="w-full px-3 py-2 text-gray-800 bg-gray-100 border rounded-md">
												{{ $user->grade?->result ?? 0 }}
											</div>
										</div>
									</div>
								</div>
							@endforeach

							<div class="flex items-center justify-end mt-4 p-6">
								@if (session('status') === 'success')
									<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
										class="text-gray-600 dark:text-gray-400 mr-4">{{ __('Berhasil menyimpan data.') }}</p>
								@endif
								@if ($errors->any())
									<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
										class="text-red-600 dark:text-red-400 mr-4">{{ __('Format penyimpanan data salah.') }}</p>
								@endif
								<x-primary-button>Simpan</x-primary-button>
							</div>
						</form>
					</section>
				</section>

			</div>
		</div>

	</div>
</x-app-layout>
