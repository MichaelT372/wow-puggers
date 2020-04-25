@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <button class="btn btn-primary" data-toggle="modal" data-target="#signupRaid">Sign up</button>
      </div>
    </div>
    <div class="row justify-content-center pt-2">
      <div class="col-md-8">
        <h1>Where: {{ $raid->location }}</h1>
        <p>Description: {{ $raid->description }}</p>
        <p>Loot rules: {{ $raid->loot_rules }}</p>
        <p>Leader: {{ $raid->leader->name }}</p>
        <p>Starts at: {{ $raid->start_at }}</p>
      </div>
    </div>
    <div class="row justify-content-center pt-2">
      <div class="col-md-8">
        <h1>Signups</h1>
        @forelse($raid->raiders as $raider)
          <p>{{ $raider->character_name }}</p>
        @empty
          <p>No signups yet!</p>
        @endforelse

        @json($raid->raiders)
      </div>
    </div>
  </div>
@endsection

@section('modal')
  <raid-signup-modal
    :id="{{ $raid->id }}"
    location="{{ $raid->location }}"
    :soft-reserves="{{ $raid->soft_reserves == '1' ? 'true' : 'false' }}"
  ></raid-signup-modal>
@endsection



