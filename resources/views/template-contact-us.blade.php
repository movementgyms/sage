{{--
  Template Name: Contact Us (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-contact-us')
  @endwhile
@endsection
