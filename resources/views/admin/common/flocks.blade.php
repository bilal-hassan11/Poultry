@foreach($flocks AS $fl)
    <option value="{{ $fl->hashid }}">{{ $fl->name }}</option>
@endforeach