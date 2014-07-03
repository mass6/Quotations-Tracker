@extends('layouts.main')

@section('content')
    <h1>{{ isset($heading) ? $heading : 'Future Page Heading' }}<small> - Coming soon!</small></h1>

@stop