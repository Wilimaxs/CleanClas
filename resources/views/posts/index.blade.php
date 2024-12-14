@extends('layout.app')

{{-- get dummy data from controler or route  --}}
@section('title', 'blog posts')

{{-- get dummy data from controler or route  --}}
@section('content')
{{--<!-- check array empty or not -->
<!-- @if (count($posts)) -->
<!-- loop in template -->
  <!-- with key -->
  <!-- @foreach ($posts as $key =>  $post)
    <div>{{$key}}.{{ $post['title'] }}</div>
  @endforeach -->
  <!-- no key -->
  <!-- @foreach ($posts as $post)
    <div>{{ $post['title'] }}</div>
  @endforeach
@else
No post found!
  @endif -->

  <!--  mixxing if and foreache use forelse -->
  <!-- check array empty or not --!>--}}

  {{--partial temple with include like nomalisasi--}}
  @forelse ($posts as $key =>  $post)
      @include('posts.partials.post')
  @empty
    No post found!
  @endforelse
@endsection