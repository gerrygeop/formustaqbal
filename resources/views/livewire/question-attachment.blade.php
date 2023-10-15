<div>
	@if (str($path)->endsWith('.mp3') || str($path)->endsWith('.ogg'))
		<audio controls class="bg-yellow-400 w-full">
			<source src="{{ asset('storage/' . $path) }}" type="audio/ogg">
			<source src="{{ asset('storage/' . $path) }}" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
	@else
		<img src="{{ asset('storage/' . $path) }}" alt="Image" class="h-48 w-auto border">
	@endif
</div>
