@php
  global $posts;
  $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
@endphp

@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <div class="uk-container">
    <section class="uk-section">
      @include('components.latest-coverage-list', ['latest_coverage' => $posts, 'archive' => true])
    </section>

    <nav class="uk-flex uk-margin-bottom">
      {!! get_previous_posts_link('Newer Articles') !!}
      {!! get_next_posts_link('Older Articles') !!}
    </nav>
  </div>
@endsection
