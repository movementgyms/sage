{{--
  Template Name: Instructors
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.the-content')
    @include('partials.content-instructors')
    @if (!empty($content_blocks))
      @include('components.top-accent')
      <div class="bg-dots">
        <div class="content-blocks">
          @include('partials.content-blocks')
        </div>
      </div>
    @endif
  @endwhile
@endsection
