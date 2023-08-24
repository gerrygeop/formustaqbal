<aside
	class="fixed hidden md:flex md:flex-col w-80 h-screen py-4 overflow-y-auto bg-white dark:bg-gray-800 border-r dark:border-gray-700/60">
	<a href="/" class="flex items-center space-x-2 px-4">
		<x-app-logo class="w-auto h-16" />
		<h4 class="text-2xl text-slate-800 dark:text-accent font-bold">Formustaqbal</h4>
	</a>

	<nav class="flex-1 flex flex-col justify-between mt-16 px-5">
		<div class="space-y-3 ">
			<x-sidelink href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
					<path fill-rule="evenodd"
						d="M2.25 2.25a.75.75 0 000 1.5H3v10.5a3 3 0 003 3h1.21l-1.172 3.513a.75.75 0 001.424.474l.329-.987h8.418l.33.987a.75.75 0 001.422-.474l-1.17-3.513H18a3 3 0 003-3V3.75h.75a.75.75 0 000-1.5H2.25zm6.54 15h6.42l.5 1.5H8.29l.5-1.5zm8.085-8.995a.75.75 0 10-.75-1.299 12.81 12.81 0 00-3.558 3.05L11.03 8.47a.75.75 0 00-1.06 0l-3 3a.75.75 0 101.06 1.06l2.47-2.47 1.617 1.618a.75.75 0 001.146-.102 11.312 11.312 0 013.612-3.321z"
						clip-rule="evenodd" />
				</svg>

				<span class="mx-2 text-sm font-medium">Dashboard</span>
			</x-sidelink>

			<x-sidelink href="{{ route('courses.my') }}" active="{{ request()->routeIs('courses.*') }}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
					<path
						d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002-.34.18a.75.75 0 01-.707 0A50.009 50.009 0 007.5 12.174v-.224c0-.131.067-.248.172-.311a54.614 54.614 0 014.653-2.52.75.75 0 00-.65-1.352 56.129 56.129 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805z" />
					<path
						d="M13.06 15.473a48.45 48.45 0 017.666-3.282c.134 1.414.22 2.843.255 4.285a.75.75 0 01-.46.71 47.878 47.878 0 00-8.105 4.342.75.75 0 01-.832 0 47.877 47.877 0 00-8.104-4.342.75.75 0 01-.461-.71c.035-1.442.121-2.87.255-4.286A48.4 48.4 0 016 13.18v1.27a1.5 1.5 0 00-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.661a6.729 6.729 0 00.551-1.608 1.5 1.5 0 00.14-2.67v-.645a48.549 48.549 0 013.44 1.668 2.25 2.25 0 002.12 0z" />
					<path
						d="M4.462 19.462c.42-.419.753-.89 1-1.394.453.213.902.434 1.347.661a6.743 6.743 0 01-1.286 1.794.75.75 0 11-1.06-1.06z" />
				</svg>


				<span class="mx-2 text-sm font-medium">Courses</span>
			</x-sidelink>

			<x-sidelink href="{{ route('leader.index') }}" active="{{ request()->routeIs('leader.*') }}">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 14" fill="currentColor" class="w-5 h-5">
					<path id="Vector"
						d="M4.0127 13.5H1.3877C0.975195 13.5 0.637695 13.1625 0.637695 12.75V5.25C0.637695 4.8375 0.975195 4.5 1.3877 4.5H4.0127C4.4252 4.5 4.7627 4.8375 4.7627 5.25V12.75C4.7627 13.1625 4.4252 13.5 4.0127 13.5ZM9.4502 0H6.8252C6.4127 0 6.0752 0.3375 6.0752 0.75V12.75C6.0752 13.1625 6.4127 13.5 6.8252 13.5H9.4502C9.8627 13.5 10.2002 13.1625 10.2002 12.75V0.75C10.2002 0.3375 9.8627 0 9.4502 0ZM14.8877 6H12.2627C11.8502 6 11.5127 6.3375 11.5127 6.75V12.75C11.5127 13.1625 11.8502 13.5 12.2627 13.5H14.8877C15.3002 13.5 15.6377 13.1625 15.6377 12.75V6.75C15.6377 6.3375 15.3002 6 14.8877 6Z" />
				</svg>

				<span class="mx-2 text-sm font-medium">Leaderboard</span>
			</x-sidelink>
		</div>

		<div class="space-y-10">
			<x-sidelink href="{{ route('profile.show') }}" active="{{ request()->routeIs('profile.show') }}"
				class="shadow border">
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="w-6 h-6">
					<path stroke-linecap="round" stroke-linejoin="round"
						d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
				</svg>

				<span class="mx-2 text-sm font-medium">Profile</span>
			</x-sidelink>

			<div class="border-t pt-4">
				<p class="text-xs text-gray-600">Copyrights &copy; {{ date('Y') }} | Supported by <a
						href="https://wanagroup.tech/" target="_blank" rel="noopener noreferrer"
						class="text-indigo-600 font-semibold">Wana Group</a></p>
			</div>
		</div>
	</nav>
</aside>
