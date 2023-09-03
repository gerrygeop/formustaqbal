<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b dark:border-gray-700/60">
	<!-- Primary Navigation Menu -->
	<div class="mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between lg:justify-end h-16">
			<div class="flex lg:hidden">
				<div class="shrink-0 flex items-center">
					<a href="{{ route('dashboard') }}">
						<x-app-logo class="h-9 w-auto" />
					</a>
				</div>
			</div>

			<div class="block lg:hidden">
				<h3 class="font-semibold text-xl text-yellow-600 tracking-wide dark:text-yellow-400">Formustaqbal</h3>
			</div>

			<!-- Settings Dropdown -->
			<div class="hidden lg:flex lg:items-center lg:ml-6">
				@if (auth()->user()->profile)
					<div class="flex items-center mr-8 px-2 py-1 rounded-full border">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
							class="w-5 h-5 text-amber-500 mr-2">
							<path fill-rule="evenodd"
								d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
								clip-rule="evenodd" />
						</svg>
						<span class="text-sm text-gray-700 font-semibold">{{ auth()->user()->profile->point }} Point</span>
					</div>
				@endif
				<x-dropdown align="right" width="48">
					<x-slot name="trigger">
						<button
							class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
							<div>{{ Auth::user()->name }}</div>

							<div class="ml-1">
								<svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
									<path fill-rule="evenodd"
										d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
										clip-rule="evenodd" />
								</svg>
							</div>
						</button>
					</x-slot>

					<x-slot name="content">

						<div class="py-2">
							<x-dropdown-link :href="route('profile.edit')">
								{{ __('Setting') }}
							</x-dropdown-link>

							<!-- Authentication -->
							<form method="POST" action="{{ route('logout') }}">
								@csrf

								<x-dropdown-link :href="route('logout')"
									onclick="event.preventDefault();
                                                    this.closest('form').submit();">
									{{ __('Log Out') }}
								</x-dropdown-link>
							</form>
						</div>

					</x-slot>
				</x-dropdown>
			</div>

			<!-- Hamburger -->
			<div class="-mr-2 flex items-center lg:hidden">
				<button @click="open = ! open"
					class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
					<svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
						<path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
						<path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
							stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Responsive Navigation Menu -->
	<div :class="{ 'block': open, 'hidden': !open }" class="fixed inset-x-0 bg-white border-t shadow-lg hidden lg:hidden">
		<div class="px-4 pt-2 pb-4">
			<a href="{{ route('profile.show') }}">
				<div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
				<div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
			</a>

			@if (auth()->user()->profile)
				<div class="flex items-center mt-4 border rounded-full w-fit px-2 py-1">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
						class="w-5 h-5 text-amber-500 mr-2">
						<path fill-rule="evenodd"
							d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z"
							clip-rule="evenodd" />
					</svg>
					<span class="text-gray-700 font-semibold text-sm">{{ auth()->user()->profile->point }} Point</span>
				</div>
			@endif
		</div>

		<div class="pt-4 pb-3 space-y-1 border-t border-gray-200 dark:border-gray-600">
			<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="w-6 h-6 mr-2">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
				</svg>

				{{ __('Dashboard') }}
			</x-responsive-nav-link>

			@can('teacher')
				<x-responsive-nav-link :href="route('teacher.room')" :active="request()->routeIs('teacher.*')">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6 mr-2">
						<path stroke-linecap="round" stroke-linejoin="round"
							d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
					</svg>

					{{ __('Class') }}
				</x-responsive-nav-link>
			@endcan

			@cannot('teacher')
				<x-responsive-nav-link :href="route('courses.my')" :active="request()->routeIs('courses.*')">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="w-6 h-6 mr-2">
						<path stroke-linecap="round" stroke-linejoin="round"
							d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
					</svg>

					{{ __('Courses') }}
				</x-responsive-nav-link>
			@endcannot

			<x-responsive-nav-link :href="route('leader.index')" :active="request()->routeIs('leader.*')">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 14" fill="none" stroke-width="1" stroke="currentColor"
					class="w-6 h-6 mr-2">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M4.0127 13.5H1.3877C0.975195 13.5 0.637695 13.1625 0.637695 12.75V5.25C0.637695 4.8375 0.975195 4.5 1.3877 4.5H4.0127C4.4252 4.5 4.7627 4.8375 4.7627 5.25V12.75C4.7627 13.1625 4.4252 13.5 4.0127 13.5ZM9.4502 0H6.8252C6.4127 0 6.0752 0.3375 6.0752 0.75V12.75C6.0752 13.1625 6.4127 13.5 6.8252 13.5H9.4502C9.8627 13.5 10.2002 13.1625 10.2002 12.75V0.75C10.2002 0.3375 9.8627 0 9.4502 0ZM14.8877 6H12.2627C11.8502 6 11.5127 6.3375 11.5127 6.75V12.75C11.5127 13.1625 11.8502 13.5 12.2627 13.5H14.8877C15.3002 13.5 15.6377 13.1625 15.6377 12.75V6.75C15.6377 6.3375 15.3002 6 14.8877 6Z" />
				</svg>

				{{ __('Leaderboard') }}
			</x-responsive-nav-link>

			<x-responsive-nav-link :href="route('profile.edit')">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
					stroke="currentColor" class="w-6 h-6 mr-2">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
					<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
				</svg>

				{{ __('Setting') }}
			</x-responsive-nav-link>
		</div>

		<!-- Responsive Settings Options -->
		<div class="pt-2 pb-4 border-t border-gray-200 dark:border-gray-600">
			<!-- Authentication -->
			<form method="POST" action="{{ route('logout') }}">
				@csrf

				<x-responsive-nav-link :href="route('logout')"
					onclick="event.preventDefault();
                                        this.closest('form').submit();">
					<span class="text-red-600">{{ __('Log Out') }}</span>
				</x-responsive-nav-link>
			</form>
		</div>
	</div>
</nav>
