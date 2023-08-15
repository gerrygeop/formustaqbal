@props(['type' => 1])

@php
	switch ($type) {
	    case 1:
	        $value = 'Multiple Choice';
	        break;
	    case 2:
	        $value = 'Essay';
	        break;
	    case 3:
	        $value = 'Listening';
	        break;
	    case 4:
	        $value = 'Speaking';
	        break;
	
	    default:
	        $value = 'Lisan';
	        break;
	}
@endphp

<span>
	{{ $value }}
</span>
