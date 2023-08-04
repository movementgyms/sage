{{--
  Template Name: Newsletter Subscriptions (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.content-newsletter-subscriptions')
  @endwhile
@endsection
