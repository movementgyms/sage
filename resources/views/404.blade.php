@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="uk-container uk-margin-large-bottom">
      {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
    </div>
  @endif
@endsection
