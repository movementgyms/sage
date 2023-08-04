{{--
  Template Name: Why El Cap (Global)
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @if ($show_rebrand_message)
      <div class="rebrand-message__container uk-container uk-flex uk-flex-center uk-margin-large-top uk-margin-large-bottom">
        <div class="uk-width-5-6 uk-width-1-1@m">
          @include('partials.rebrand-message')
        </div>
      </div>
    @else
      @include('partials.the-content')
    @endif
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
