<!-- inheritance -->
@extends('layout.app')

<!-- get passing title -->
@section('title', 'index page')

<!-- MORE ABOUT LOOP  -->
@section('content')
<h1>hewlsaaa world</h1>

<div>
  @for ($i = 0; $i < 10; $i++)
    <div>The current Value is {{ $i }}</div>
  
  @endfor
</div>

<div>
  @php 
  $done = false 
  @endphp
  
  @while (!$done)
  <div>I'm not done</div>

  @php
    if (random_int(0,1) === 1)
    $done = true
  @endphp
  @endwhile

</div>
@endsection
