@foreach($options as $o)
@php $k = isset($o['k']) ? $o['k'] : $o['v']; @endphp
<option value="{{ $k }}"{!! isset($value) && $value == $k ? ' selected="selected"' : '' !!}>{{ $o['v'] }}</option>
@endforeach
