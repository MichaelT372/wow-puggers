@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-between align-items-center my-4">
      <div class="col-6 mr-auto">
        <h1>Your raids</h1>
      </div>
      <div class="col-6">
        <button class="btn btn-primary btn-lg float-right" @click="$store.commit('showCreateRaidModal', true)">
          Create a raid
        </button>
      </div>
    </div>
    <raid-cards></raid-cards>
  </div>
@endsection

@section('modal')
  <create-raid-modal></create-raid-modal>
  <edit-raid-modal></edit-raid-modal>
  <delete-raid-modal></delete-raid-modal>
@endsection

@section('script')
  <script>
    $store.commit('setRaids', @json($raids))
  </script>
@endsection
