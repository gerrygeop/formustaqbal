<section>
	<header>
		<h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
			{{ __('Info Tambahan') }}
		</h2>
	</header>

	<form method="post" action="{{ route('profile.update.information') }}" class="mt-6 space-y-6">
		@csrf
		@method('patch')

		<div>
			<x-input-label for="phone" :value="__('No Telp')" />
			<x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->profile->phone)" required />
			<x-input-error class="mt-2" :messages="$errors->get('phone')" />
		</div>

		<div>
			<x-input-label for="gender" :value="__('Jenis Kelamin')" />
			<label for="P" class="flex items-center space-x-2">
				<input id="P" name="gender" type="radio" value="P" @checked(old('gender', $user->profile->gender))
					class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 rounded-md shadow-sm">
				<span>Perempuan</span>
			</label>
			<label for="L" class="flex items-center space-x-2">
				<input id="L" name="gender" type="radio" value="L" @checked(old('gender', $user->profile->gender))
					class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 rounded-md shadow-sm">
				<span>Laki-laki</span>
			</label>
			<x-input-error class="mt-2" :messages="$errors->get('gender')" />
		</div>

		<div>
			<x-input-label for="bio" :value="__('Bio')" />
			<x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->profile->bio)" />
			<x-input-error class="mt-2" :messages="$errors->get('bio')" />
		</div>

		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('Save') }}</x-primary-button>

			@if (session('status') === 'profiles-information-updated')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
					class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
