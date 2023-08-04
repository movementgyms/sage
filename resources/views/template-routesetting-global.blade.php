{{--
  Template Name: Routesetting (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-routesetting-global', [
      'routesetter' => $default_featured_routesetter,
      'image'       => $default_image,
    ])
  @endwhile
@endsection
