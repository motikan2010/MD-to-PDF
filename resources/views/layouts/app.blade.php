<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', '') }}</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@if( env('GITHUB_RIBBON') )
  <a href="https://github.com/motikan2010/MD-to-PDF"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
@endif
<div class="container">

  <nav class="navbar navbar-expand-md bg-white border-bottom box-shadow">
    <a href="{{ route('index') }}" class="my-0 mr-md-auto navbar-brand d-flex"><strong>{{ config('app.name', '') }}</strong></a>

    <div class="navbar-collapse collapse">
      <div class="ml-5 col-md-7">
        <form class="form-inline mx-2 my-auto d-inline" action="{{ route('repository.detail') }}">
          <input class="form-control w-75" type="text" name="r" value="{{ app('request')->input('r') }}" placeholder="GitHub Organization/Repository" />
          <button class="ml-1 btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>

      <ul class="navbar-nav ml-auto">
        @if( session('user') === null )
          <li class="nav-item">
            <a class="btn btn-outline-primary" href="{{ route('login') }}">Login</a>
          </li>
        @else
          <li class="nav-item">
            <span class="ml-1 text-dark navbar-brand">{{ session('user')['name'] }}</span>
          </li>
          <li class="nav-item">
            <a class="ml-1 btn btn-outline-primary" href="{{ route('repository.index') }}">Repository</a>
          </li>
          <li class="nav-item">
            <a class="ml-1 btn btn-outline-danger" href="{{ route('logout') }}">Logout</a>
          </li>
        @endif
      </ul>
    </div>

  </nav>

  <div class="mt-2">
    @yield('content')
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@yield('js')
</body>
</html>
