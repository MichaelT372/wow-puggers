@extends('layouts.app')

@section('content')
  <section class="intro">
    <div class="container">
      <div class="row">
        <div class="col mt-4">
          <div class="jumbotron text-light bg-dark">
            <h1 class="display-4 text-primary">WoW Puggers</h1>
            <p class="lead">A site for organising your World of Warcraft Classic raids.</p>
            @auth
              <a class="btn btn-primary btn-lg" href="{{ route('raids.index') }}" role="button">My Raids</a>
            @else
              <a class="btn btn-primary btn-lg" href="{{ route('register') }}" role="button">Register now</a>
              <p class="small mt-2">Already registered? <a href="{{ route('login') }}">Login</a></p>
            @endauth
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container mt-4">
    <div class="row">
      <div class="col-6">
        <img class="homepage-img img-fluid" src="/images/signups.jpg" alt="signups">
      </div>
      <div class="col-6">
        <h3 class="text-primary">Manage Signups</h3>
        <p>
          Get a nice overview of who has signed up to your raid.
          Confirm and edit signups easily to tailor your raid composition. For Molten Core you'll be able
          to keep track of how many douses your raid has too.
        </p>
      </div>
    </div>
  </div>

  <div class="container my-4">
    <div class="row">
      <div class="col-6">
        <h3 class="text-primary">Use Soft Reserves</h3>
        <p>
          You can enable soft reserves for your raid so anyone signing up can select an item to soft reserve.
          Everyone can see who has soft reserved what in a nice filterable table. No more spreadsheets!
        </p>
      </div>
      <div class="col-6">
        <img class="homepage-img img-fluid" src="/images/soft-reserves.jpg" alt="signups">
      </div>
    </div>
  </div>
@endsection
