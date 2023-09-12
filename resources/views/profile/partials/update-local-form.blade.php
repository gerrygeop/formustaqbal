<section>
	<header>
		<h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
			{{ __('Update Lokal') }}
		</h2>
	</header>

	<form method="post" action="{{ route('profile.update.local') }}" class="mt-6 space-y-6">
		@csrf
		@method('patch')

		<div>
			<x-input-label for="local" :value="__('Lokal')" />
			<select name="local" id="local"
				class="w-full mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-yellow-500 dark:focus:border-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 rounded-md shadow-sm">
				<option value="">-- Pilih --</option>

				@foreach ($locals as $local)
					@if ($user->siakad->local)
						<option value="{{ $local->id }}" @selected($user->siakad->local->id == $local->id)>
							{{ $local->name }}
						</option>
					@else
						<option value="{{ $local->id }}">
							{{ $local->name }}
						</option>
					@endif
				@endforeach
			</select>
			<x-input-error class="mt-2" :messages="$errors->get('local')" />
		</div>

		<div class="flex items-center gap-4">
			<x-primary-button>{{ __('Save') }}</x-primary-button>

			@if (session('status') === 'fill-local')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
					class="text-sm text-red-600 dark:text-red-400">
					Silahkan mengisi Lokal anda terlebih dahulu.
				</p>
			@endif

			@if (session('status') === 'profiles-local-updated')
				<p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
					class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
			@endif
		</div>
	</form>
</section>
