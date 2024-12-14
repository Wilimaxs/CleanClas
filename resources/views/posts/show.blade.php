@extends('layout.app')

<!-- get dummy data from controler or route  -->
@section('title', )

<!-- get dummy data from controler or route  -->
@section('content')


<!-- condition rendering -->
@if ($post['is_new'])
  <div>a new blog post! using if</div>
@else
<div>a new blog old! using elseif/else</div>
@endif


<!-- condition rendering alternatif-->
@unless ($post['is_new'])
  <div>it is an old post... using unless</div>
@endunless

<!-- just get dummy data -->
<!-- <h1>{{ $post['nip'] }}</h1>
<p>{{ $post['nama'] }}</p>
<p>{{ $post['tlp'] }}</p>
<p>{{ $post['pass'] }}</p> -->

<h1>{{ $post['nis'] }}</h1>
<p>{{ $post['nama'] }}</p>
<p>{{ $post['nip'] }}</p>
<p>{{ $post['id_kelas'] }}</p>
<p>{{ $post['pass'] }}</p>
<p>{{ $post['tlp'] }}</p>


<!-- condition rendering alternatif-->
@isset($post['has_comments'])
  <div>the post has some comments... using isset</div>
@endisset

@endsection