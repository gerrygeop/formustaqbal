@props(['color' => 'gray'])

@switch($color)
	@case('green')
		<span
			class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
			{{ $slot }}
		</span>
	@break

	@case('red')
		<span
			class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
			{{ $slot }}
		</span>
	@break

	@case('yellow')
		<span
			class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
			{{ $slot }}
		</span>
	@break

	@default
		<span
			class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
			{{ $slot }}
		</span>
@endswitch
