@foreach($items AS $item)
    <option value="{{ $item->hashid }}">{{ $item->name }}</option>
@endforeach