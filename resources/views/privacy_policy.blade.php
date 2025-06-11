<?php $layout = ($_SERVER['SERVER_NAME'] == config('app.domain2')) ? 'thc.layouts.app' : 'layouts.app' ?>
@extends($layout, ['title' => 'Privacy Policy', 'activePage' => 'privacypolicy'])

@section('content')

@endsection