@extends('layouts.app')

@section('content')

  <ul>
    @foreach ( $result['repository_list'] as $repository )
      <li><a href="{{ route('repository.detail', ['r' => $repository['full_name']]) }}">{{ $repository['name'] }}</a></li>
    @endforeach
  </ul>

@endsection
