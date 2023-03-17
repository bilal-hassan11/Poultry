@foreach($companies AS $cm)
    <option value="{{ $cm->hashid }}">{{ $cm->name }}</option>
@endforeach