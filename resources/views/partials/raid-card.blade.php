@php
  switch($raid->location) {
    case 'Blackwing Lair':
      $bgImage = 'images/blackwing-lair.jpg';
      break;
    case 'Molten Core':
    default:
      $bgImage = 'images/molten-core.jpg';
      break;
  }
@endphp

<div class="col-4 mb-4 raid-card-col">
  <a href="{{ route('raids.show', ['raid' => $raid->id]) }}">
    <div class="raid-card" style="background-image: url({{ $bgImage }})">
      <div class="raid-card-header">
        <div class="faction">
          <wow-icon
            type="{{ $raid->faction }}"
            :size="35"
          ></wow-icon>
        </div>
        <div class="raid-controls">
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M6 0l-1 1 2 2 1-1-2-2zm-2 2l-4 4v2h2l4-4-2-2z" />
          </svg>
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path d="M3 0c-.55 0-1 .45-1 1h-1c-.55 0-1 .45-1 1h7c0-.55-.45-1-1-1h-1c0-.55-.45-1-1-1h-1zm-2 3v4.81c0 .11.08.19.19.19h4.63c.11 0 .19-.08.19-.19v-4.81h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1v3.5c0 .28-.22.5-.5.5s-.5-.22-.5-.5v-3.5h-1z" />
          </svg>
        </div>
      </div>
      <div class="raid-card-text">
        <h5 class="raid-card-title">
          {{ $raid->location }}
        </h5>
        <div class="raid-card-item">
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path
              d="M4 0c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4zm0 1c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-.5 1v2.22l.16.13.5.5.34.38.72-.72-.38-.34-.34-.34v-1.81h-1z"/>
          </svg>
          {{ Carbon\Carbon::parse($raid->start_at)->format('H:h - l jS F Y') }}
        </div>
        <div class="raid-card-item">
          <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
            <path
              d="M5.5 0c-.51 0-.95.35-1.22.88.45.54.72 1.28.72 2.13 0 .29-.03.55-.09.81.19.11.38.19.59.19.83 0 1.5-.9 1.5-2s-.67-2-1.5-2zm-3 1c-.83 0-1.5.9-1.5 2s.67 2 1.5 2 1.5-.9 1.5-2-.67-2-1.5-2zm4.75 3.16c-.43.51-1.02.82-1.69.84.27.38.44.84.44 1.34v.66h2v-1.66c0-.52-.31-.97-.75-1.19zm-6.5 1c-.44.22-.75.67-.75 1.19v1.66h5v-1.66c0-.52-.31-.97-.75-1.19-.45.53-1.06.84-1.75.84s-1.3-.32-1.75-.84z"
            />
          </svg>
          {{ count($raid->raiders) }}
        </div>
      </div>
    </div>
  </a>
</div>
