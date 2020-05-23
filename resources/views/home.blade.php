@extends('layouts.app')

@section('content')
  <section class="intro">
    <div class="container">
      <div class="row">
        <div class="col mt-4">
          <div class="jumbotron text-light bg-dark">
            <h1 class="display-4">WoW Puggers</h1>
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
        <h3>Signups</h3>
        <p>
          This site was made as a hobby project by Mikiz who plays on Gandling-EU Alliance as an alternative to Discord
          or spreadsheet based signup systems that many PUG groups on Gandling use.
        </p>
        <p>
          I hope you find the site useful and if you have any feedback or suggestions you can contact me ingame.
        </p>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row">
      <div class="col-6">
        <h3>Soft reserves</h3>
        <p>
          This site was made as a hobby project by Mikiz who plays on Gandling-EU Alliance as an alternative to Discord
          or spreadsheet based signup systems that many PUG groups on Gandling use.
        </p>
        <p>
          I hope you find the site useful and if you have any feedback or suggestions you can contact me ingame.
        </p>
      </div>
      <div class="col-6">
        <img class="homepage-img img-fluid" src="/images/soft-reserves.jpg" alt="signups">
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="row">
      <div class="col">
        <p class="small">
          This site was made as a hobby project by Mikiz who plays on Gandling-EU Alliance as an alternative to Discord
          or spreadsheet based signup systems that many PUG groups on use. I hope you find the site useful and if you have any feedback or suggestions you can contact me ingame.
        </p>
      </div>
    </div>
  </div>
@endsection
