{{--
  Template Name: Location Redirect Landing (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-location-redirect-landing')
  @endwhile
@endsection
