@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if(session()->has('sent_email'))
          <div class="alert alert-success" role="alert">
            Your message has been sent.
          </div>
        @endif

        <h1 class="text-primary">Contact</h1>
        <p>
          Please fill out the form below with any questions, comments or suggestions. Alternatively, you can find me
          ingame as Mikiz on EU-Gandling Alliance.
        </p>
      </div>
    </div>

    <div class="row justify-content-center my-4">
      <div class="col-md-8">
        <form action="{{ route('contact.email') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="email">Your Email Address</label>
            <input type="email" name="email" class="form-control" id="email" required>
          </div>
          <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="name" class="form-control" id="name" required>
          </div>
          <div class="form-group">
            <label for="message">Your Message</label>
            <textarea class="form-control" name="message" id="message" rows="10" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
