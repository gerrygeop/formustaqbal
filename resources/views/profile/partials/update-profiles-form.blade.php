<section>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			{{ __('Profile Information') }}
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			{{ __("Update your account's profile information and email address.") }}
		</p>
	</header>

	<form method="post" action="{{ route('profile.update.information') }}" class="mt-6 space-y-6">
		@csrf
		@method('patch')

		<div>
			<x-input-label for="phone" :value="__('No Telp')" />
			<x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required />
			<x-input-error class="mt-2" :messages="$errors->get('phone')" />
		</div>

		<div>
			<x-input-label for="gender" :value="__('Jenis Kelamin')" />
			<label for="P" class="flex items-center space-x-2">
				<x-text-input id="gender" name="gender" type="radio" :value="old('gender', $user->gender)" />
				<span>Perempuan</span>
			</label>
			<label for="L" class="flex items-center space-x-2">
				<x-text-input id="gender" name="gender" type="radio" :value="old('gender', $user->gender)" />
				<span>Laki-laki</span>
			</label>
			<x-input-error class="mt-2" :messages="$errors->get('gender')" />
		</div>

		<div>
			<x-input-label for="bio" :value="__('Bio')" />
			<x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->bio)" />
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
