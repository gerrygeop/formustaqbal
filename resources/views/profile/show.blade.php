<x-app-layout>
	<div class="max-w-7xl mx-auto space-y-6">
		<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div>
				<div class="px-4 sm:px-0">
					<div class="flex items-start justify-between">
						<div class="flex items-start space-x-4">
							<img src="https://i.postimg.cc/WzjSQ1Gz/dummy-profile-pic.png" alt="" class="h-14 w-14 rounded">
							<div>
								<h3 class="text-base font-semibold leading-7 text-gray-900">{{ $user->name }}</h3>
								<p class="max-w-2xl text-sm leading-6 text-gray-500">{{ $user->username ?? $user->email }}</p>
							</div>
						</div>

						<a href="{{ route('profile.edit') }}" class="px-4 py-1.5 border rounded-md shadow-sm">Edit</a>
					</div>
				</div>
				<div class="mt-6 border-t border-gray-100">
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
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">No. Telp</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->phone ?? '-' }}
							</dd>
						</div>
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Bio</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->bio ?? '-' }}
							</dd>
						</div>
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Gender</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->gender ?? '-' }}
							</dd>
						</div>
						<div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
							<dt class="text-sm font-medium leading-6 text-gray-900">Poin</dt>
							<dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
								{{ $user->profile->point ?? '-' }}
							</dd>
						</div>
					</dl>
				</div>
			</div>

		</div>
	</div>
</x-app-layout>
