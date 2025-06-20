<x-guest-layout>
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />

	<form method="POST" action="{{ route('login') }}">
		@csrf

		<!-- Email Address -->
		<div>
			<x-input-label for="email" :value="__('Email')" />
			<x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus
				autocomplete="username" />
			<x-input-error :messages="$errors->get('email')" class="mt-2" />
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

			{{-- <p>
				Belum punya akun?
				<a
					class="underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none"
					href="{{ route('register') }}">
					{{ __('Buat akun') }}
				</a>
			</p> --}}

			<a
				class="underline text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none"
				href="{{ route('siakad.login') }}">
				{{ __('Login dengan NIM') }}
			</a>
		</div>
	</form>
</x-guest-layout>
