<div>
    @if(count($additionalPhotos))
        @foreach($additionalPhotos as $item)
            <img src="{{ url('storage/additional_photos/'.$item->filename) }}" alt="" width="200px"> <br><br>
        @endforeach
    @else
        <p>No additional photos!</p>
    @endif
</div>
