@extends('layout.app')

@section('title', '')


@section('content')
<form action="{{route('posts.store')}}" method="POST">
  {{--CSRF protecter melicious 3rd party--}}
  @csrf
  <div><input type="text" name="title"></div>
  <div><textarea name="content"></textarea></div>
  <div><input type="submit" value="create"></div>
</form>
@endsection