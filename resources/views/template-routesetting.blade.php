{{--
  Template Name: Routesetting (Location Specific)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-routesetting-global', [
      'routesetter' => $featured_routesetter ?? null,
      'routesetters' => $featured_routesetters ?? null,
      'routesetting_file' => $routesetting_file ?? null,
      'image'       => $image ?? null,
    ])
  @endwhile
@endsection
