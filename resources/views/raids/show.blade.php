@extends('layouts.app')

@section('content')
  <div class="raid-header-banner {{ Str::slug($raid->location) }}" >
    <div class="raid-header-overlay"></div>
    <div class="container raid-header-inner">
      <h1>{{ $raid->location }}</h1>
      <div class="raid-header-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
          <path
            d="M4 0c-2.2 0-4 1.8-4 4s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4zm0 1c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm-.5 1v2.22l.16.13.5.5.34.38.72-.72-.38-.34-.34-.34v-1.81h-1z"/>
        </svg>
        <span>{{ $raid->start_at->format('H:i - l jS F Y') }}</span>
      </div>
      <div class="raid-header-item">
        <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" viewBox="0 0 8 8">
          <path d="M4 0c-1.1 0-2 1.12-2 2.5s.9 2.5 2 2.5 2-1.12 2-2.5-.9-2.5-2-2.5zm-2.09 5c-1.06.05-1.91.92-1.91 2v1h8v-1c0-1.08-.84-1.95-1.91-2-.54.61-1.28 1-2.09 1-.81 0-1.55-.39-2.09-1z" />
        </svg>
        <span>{{ $raid->leader->name }}</span>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row justify-content-start">
      <div class="col-md-3">
        <button class="btn btn-lg btn-primary" @click="$store.commit('showCreateSignupModal', true)">
          Sign up
        </button>
      </div>
    </div>
    <div class="row justify-content-center mt-2">
      <div class="col-sm-12">
        <tabs>
          <tab name="Info">
            <div class="card custom-card">
              <h2 class="card-header text-primary">Description</h2>
              <div class="card-body">
                <p class="card-text">
                  {!! nl2br(e($raid->description)) !!}
                </p>
              </div>
            </div>
            <div class="card custom-card">
              <h2 class="card-header text-primary">Loot rules</h2>
              <div class="card-body">
                <p class="card-text">
                  {!! nl2br(e($raid->loot_rules)) !!}
                </p>
              </div>
            </div>
          </tab>
          <tab name="Signups">
            <signups></signups>
          </tab>
          @if($raid->soft_reserves)
            <tab name="Soft Reserves">
              <soft-reserves></soft-reserves>
            </tab>
          @endif
        </tabs>
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <create-signup-modal></create-signup-modal>
  <edit-signup-modal></edit-signup-modal>
  <delete-signup-modal></delete-signup-modal>
@endsection

@section('script')
  <script>
    @auth
      $store.commit('canEdit', {{ auth()->user()->id === $raid->leader->id }});
    @endauth
    $store.commit('setRaid', {
      id : {{ $raid->id }},
      faction: @json($raid->faction),
      location: @json($raid->location),
      description: @json($raid->description),
      loot_rules: @json($raid->loot_rules),
      open: {{ $raid->open }},
      starts_at: "{{ $raid->start_at }}",
      leader: "{{ $raid->leader->name }}",
      soft_reserves: {{ $raid->soft_reserves == '1' ? 'true' : 'false' }}
    });

    $store.commit('setSignups', @json($raid->raiders))
  </script>
@endsection



