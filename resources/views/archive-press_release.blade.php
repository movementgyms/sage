@php
  global $posts;
  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
@endphp

@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="uk-container">
    <section class="uk-section">
      @include('components.press-release-list', ['press_releases' => $posts])
    </section>

    <nav class="uk-flex uk-margin-bottom">
      {!! get_previous_posts_link('Newer Press Releases') !!}
      {!! get_next_posts_link('Older Press Releases') !!}
    </nav>
  </div>
@endsection
