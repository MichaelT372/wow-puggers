@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <button class="btn btn-primary" data-toggle="modal" data-target="#createRaid">Create a raid</button>

        @auth
          <h2>Your raids</h2>
          @forelse($raids as $raid)
            <p>
              <a href="{{ route('raids.show', ['raid' => $raid->id]) }}">
                {{ $raid->location }}
              </a>
            </p>
          @empty
            <p>You don't have any raids yet!</p>
          @endforelse
          {{ $raids->links() }}
        @endauth
    </div>
  </div>
@endsection

@section('modal')
  <create-raid-modal></create-raid-modal>
@endsection
