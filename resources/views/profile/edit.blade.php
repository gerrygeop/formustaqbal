<x-app-layout>
	<div class="max-w-7xl mx-auto space-y-6">

		@if ($locals)
			<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
				<div class="max-w-xl">
					@include('profile.partials.update-local-form')
				</div>
			</div>
		@endif

		<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div class="max-w-xl">
				@include('profile.partials.update-profile-information-form')
			</div>
		</div>


		<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div class="max-w-xl">
				@include('profile.partials.update-profiles-form')
			</div>
		</div>

		<div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div class="max-w-xl">
				@include('profile.partials.update-password-form')
			</div>
		</div>

		{{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
			<div class="max-w-xl">
				@include('profile.partials.delete-user-form')
			</div>
		</div> --}}
	</div>
</x-app-layout>
