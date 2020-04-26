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
        <h1>{{ $raid->location }}</h1>
        <p><b>Starts at:</b> {{ $raid->start_at }} <b>Leader:</b> {{ $raid->leader->name }} </p>
        <p><b>Description:</b> {{ $raid->description }}</p>
        <p><b>Loot rules:</b> {{ $raid->loot_rules }}</p>
      </div>
    </div>

    <div class="row justify-content-center pt-2">
      <div class="col-md-8">
        <raid-signups
          faction="{{ $raid->faction }}"
          location="{{ $raid->location }}"
          :all-signups="{{ $raid->raiders }}"
        ></raid-signups>
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



