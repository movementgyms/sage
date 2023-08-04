{{--
  Template Name: Home Page (Location Specific)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-location-home')
  @endwhile
@endsection
