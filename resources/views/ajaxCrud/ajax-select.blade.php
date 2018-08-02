@if(!empty($chiefs))
    @foreach($chiefs as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
@endif