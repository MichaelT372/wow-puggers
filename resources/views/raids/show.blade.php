@extends('layouts.app')

@php
  if ($raid->location === 'Molten Core') {
    $bg = 'url(/images/molten-core.jpg)';
  } else if ($raid->location === 'Blackwing Lair') {
    $bg =  'url(/images/blackwing-lair.jpg)';
  } else if ($raid->location === "Zul'Gurub") {
    $bg =  'url(/images/zul-gurub.jpg)';
  } else if ($raid->location === "Onyxia") {
    $bg =  'url(/images/onyxia.jpg)';
  } else {
    $bg =  '';
  }
@endphp

@section('content')
  <div style="
    background-image: {{ $bg }};
    background-size: cover;
    background-position: center;
    height: 220px;
    position: relative;"
   >
    <div style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; bottom: 0; right: 0; background-color: rgba(0,0,0,0.3)"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mt-4">{{ $raid->location }}</h1>
          <div class="raid-card-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
              <path
                d="M4 0c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4zm0 1c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-.5 1v2.22l.16.13.5.5.34.38.72-.72-.38-.34-.34-.34v-1.81h-1z"/>
            </svg>
            {{ $raid->start_at }}
          </div>
          <div class="raid-card-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
              <path
                d="M5.5 0c-.51 0-.95.35-1.22.88.45.54.72 1.28.72 2.13 0 .29-.03.55-.09.81.19.11.38.19.59.19.83 0 1.5-.9 1.5-2s-.67-2-1.5-2zm-3 1c-.83 0-1.5.9-1.5 2s.67 2 1.5 2 1.5-.9 1.5-2-.67-2-1.5-2zm4.75 3.16c-.43.51-1.02.82-1.69.84.27.38.44.84.44 1.34v.66h2v-1.66c0-.52-.31-.97-.75-1.19zm-6.5 1c-.44.22-.75.67-.75 1.19v1.66h5v-1.66c0-.52-.31-.97-.75-1.19-.45.53-1.06.84-1.75.84s-1.3-.32-1.75-.84z"
              />
            </svg>
            {{ $raid->leader->name }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-start">
      <div class="col-md-3">
        <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#signupRaid">Sign up</button>
      </div>
    </div>

    <div class="row justify-content-center mt-4">
      <div class="col-sm-12">
        <tabs>
          <tab name="Info">
            <h3>Description</h3>
            {{ $raid->description }}
            <hr>
            <h3>Loot rules</h3>
            {{ $raid->loot_rules }}
          </tab>

          <tab name="Signups">
            <signups></signups>
          </tab>

          <tab name="Soft Reserves">
            <soft-reserves></soft-reserves>
          </tab>
        </tabs>
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <raid-signup-modal
    :id="{{ $raid->id }}"
    location="{{ $raid->location }}"
    faction="{{ $raid->faction }}"
    :soft-reserves="{{ $raid->soft_reserves == '1' ? 'true' : 'false' }}"
  ></raid-signup-modal>
@endsection

@section('script')
  <script>
    $store.commit('setRaid', {
      id : {{ $raid->id }},
      faction: "{{ $raid->faction }}",
      location: "{{ $raid->location }}",
      description: @json($raid->description),
      loot_rules: @json($raid->loot_rules),
      open: {{ $raid->open }},
      starts_at: "{{ $raid->start_at }}",
      leader: "{{ $raid->leader->name }}"
    });

    $store.commit('setSignups', @json($raid->raiders))
  </script>
@endsection



