@extends('layouts.app')

@section('content')

  <ul class="list-group">
    @foreach ( $result['repository_list'] as $repository )
      <li class="list-group-item"><a href="{{ route('repository.detail', ['r' => $repository['full_name']]) }}">{{ $repository['full_name'] }}</a></li>
    @endforeach
  </ul>

@endsection
