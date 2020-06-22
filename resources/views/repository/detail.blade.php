@extends('layouts.app')

@section('content')
  <div id="app"></div>
  <ul>
    @foreach ( $result['repository_info'] as $repository )
      <li>{{ $repository['name'] }}{{ $repository['type'] === 'dir' ? '/' : '' }}</li>
      <li><a href="{{ route('repository.convert', ['r' => $result['repository_name'], 'f' => $repository['name']]) }}">{{ $repository['name'] }}</a></li>
    @endforeach
  </ul>

@endsection

@section('js')<script src="{{ mix('js/repository-detail.js') }}" defer></script>
@endsection
