{{--
  Template Name: Home Page
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @if ($show_rebrand_message)
      <div class="uk-container rebrand-message__container uk-flex uk-flex-center uk-margin-large-top uk-margin-large-bottom">
        <div class="uk-width-5-6 uk-width-1-1@m">
          @include('partials.rebrand-message', ['show_rebrand_message_cta' => true])
        </div>
      </div>
    @else
      @include('partials.the-content')
    @endif
    @include('partials.content-home')
  @endwhile
@endsection
