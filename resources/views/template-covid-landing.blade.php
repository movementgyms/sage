{{--
  Template Name: Covid Landing (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-covid-landing')
  @endwhile
@endsection
