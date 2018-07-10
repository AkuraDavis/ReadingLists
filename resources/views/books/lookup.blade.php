<div class="card-deck justify-content-center">
@foreach ($api_data['items'] as $item)
    <a href="{{ isset($item['volumeInfo']['canonicalVolumeLink']) ? $item['volumeInfo']['canonicalVolumeLink'] : '#' }}" class="card-deck-link" target="_blank">
    <div class="card flex-md-row mb-3 card-shadow">
        <img class="card-img-left flex-auto d-none d-md-block"
             src="{{ isset($item['volumeInfo']['imageLinks']['thumbnail']) ? $item['volumeInfo']['imageLinks']['thumbnail'] : 'http://via.placeholder.com/128x197?text=No+Image' }}"
             alt="Book Image">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div class="flex-column col-10 align-items-center">
                <div class="align-items-start card-title">
                    <h5 class="d-inline-flex mr-2">{{ $item['volumeInfo']['title'] }}</h5>
                    <span class="d-inline-flex">by {{ implode($item['volumeInfo']['authors'], ', ') }}</span>
                </div>
                <p class="card-text">
                    Published on {{ isset($item['volumeInfo']['publishedDate']) ? $item['volumeInfo']['publishedDate'] : 'N/A' }}
                    <br/>
                    <span class="small">{{ isset($item['volumeInfo']['description']) ? substr($item['volumeInfo']['description'], 0, 125).'...' : 'N/A' }}</span>
                    <br/>
                </p>
            </div>
            <span data-feather="external-link" class="external-icon"></span>
        </div>
    </div>
    </a>
@endforeach
</div>