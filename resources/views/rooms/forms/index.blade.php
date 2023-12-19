<x-app-layout>
	<div class="max-w-[90rem] mx-auto">
		<div class="py-8" x-data="{ tab: window.location.hash ? window.location.hash.substring(1) : 'list' }" id="tab_wrapper">

			<div class="grid grid-cols-1 lg:grid-cols-5 gap-y-4 lg:gap-y-0 lg:gap-x-4">

				<div class="col-span-1">
					@include('rooms.partials._navigation')
				</div>

				<section class="col-span-1 lg:col-span-4">
					<div>
						<div class="flex items-center justify-end gap-x-4">
							<a href="{{ route('rooms.form.create', $room) }}"
								class="text-gray-900 bg-yellow-500 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/50 font-medium shadow-sm shadow-yellow-600 rounded-md text-sm px-5 py-2 text-center inline-flex items-center">
								Input Nilai
							</a>
							<a href="{{ route('rooms.form.export-excel', $room) }}"
								class="text-gray-900 bg-yellow-500 hover:bg-yellow-500/90 focus:ring-4 focus:ring-yellow-500/50 font-medium shadow-sm shadow-yellow-600 rounded-md text-sm px-5 py-2 text-center inline-flex items-center">
								Export
							</a>
						</div>

						@include('rooms.forms.table', $users)
					</div>
				</section>

			</div>
		</div>

	</div>
</x-app-layout>
