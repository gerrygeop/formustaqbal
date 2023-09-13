<x-app-layout>
	<div class="max-w-7xl mx-auto space-y-6">
		<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div>
				<div class="p-4 sm:p-6">
					<div class="flex flex-col md:flex-row items-start justify-between gap-y-6 md:gap-y-0">
						<div class="flex items-start space-x-4">
							<img src="https://i.postimg.cc/WzjSQ1Gz/dummy-profile-pic.png" alt="" class="h-14 w-14 rounded">
							<div>
								<h3 class="text-xl font-semibold leading-7 text-gray-900">{{ $user->name }}</h3>
								<p class="max-w-2xl text-sm leading-6 text-gray-500">{{ $user->username ?? $user->email }}</p>
							</div>
						</div>

						@if (auth()->id() == $user->id)
							<a href="{{ route('profile.edit') }}"
								class="w-full md:w-auto text-center px-5 py-1.5 border rounded-md shadow-sm overflow-hidden bg-slate-700 hover:bg-slate-800 text-white">
								Edit
							</a>
						@endif
					</div>
				</div>
				<div class="px-4 sm:px-6 border-t border-gray-100">
					<dl class="divide-y divide-gray-100">
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Full name</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->name }}
							</dd>
						</div>
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Username</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->username ?? '-' }}
							</dd>
						</div>
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->email ?? '-' }}
							</dd>
						</div>
					</dl>
				</div>
			</div>
		</div>

		@if ($user->siakad)
			<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
				<div class="bg-gray-50 dark:bg-gray-700 border-b border-b-gray-300">
					<div class="px-4 py-3">
						<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
							Akademik
						</h3>
					</div>
				</div>

				<div class="px-4 sm:px-6">
					<dl class="divide-y divide-gray-100">
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Fakultas</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->siakad->faculty->name ?? '-' }}
							</dd>
						</div>

						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Program Studi</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->siakad->department->name ?? '-' }}
							</dd>
						</div>

						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Lokal</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->siakad->local->name ?? '-' }}
							</dd>
						</div>
					</dl>
				</div>
			</div>
		@endif

		@if ($user->profile)
			<div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
				<div class="bg-gray-50 dark:bg-gray-700 border-b border-b-gray-300">
					<div class="px-4 py-3">
						<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
							Info Tambahan
						</h3>
					</div>
				</div>

				<div class="px-4 sm:px-6">
					<dl class="divide-y divide-gray-100">
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">No. Telp</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->phone ?? '-' }}
							</dd>
						</div>

						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Jenis Kelamin</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->gender ?? '-' }}
							</dd>
						</div>

						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900 dark:text-white">Bio</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->bio ?? '-' }}
							</dd>
						</div>
					</dl>
				</div>
			</div>
		@endif
	</div>
</x-app-layout>
