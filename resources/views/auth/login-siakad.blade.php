<x-guest-layout>
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<form method="POST" action="{{ route('siakad.login.store') }}">
		@csrf

		<!-- Email Address -->
		<div>
			<x-input-label for="username" value="NIM" />
			<x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
				autofocus autocomplete="username" />
			<x-input-error :messages="$errors->get('username')" class="mt-2" />
		</div>

		<!-- Password -->
		<div class="mt-4">
			<x-input-label for="password" :value="__('Password')" />
			<x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
				autocomplete="current-password" />

			<x-input-error :messages="$errors->get('password')" class="mt-2" />
		</div>

		<div class="flex flex-col items-center justify-end space-y-4 mt-8">
			<x-primary-button>
				{{ __('Masuk') }}
			</x-primary-button>

			<p>
				Tidak punya NIM?
				<a
					class="underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none"
					href="{{ route('login') }}">
					{{ __('Login dengan Email') }}
				</a>
			</p>
		</div>
	</form>
</x-guest-layout>
