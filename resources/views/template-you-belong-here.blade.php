{{--
  Template Name: You Belong Here (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-you-belong-here')
  @endwhile
@endsection
