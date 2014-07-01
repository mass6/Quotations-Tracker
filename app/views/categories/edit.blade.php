@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

	<h3>Edit Category:  {{ $category->name}} [{{ $category->id }}]</h3>


	{{ Form::model($category, ['route' => array('categories.update', $category->id), 'method' =>  'PUT']) }}

		<?php $submit = 'Update' ?>

		@include('categories.partials._formFields')

	{{ Form::close() }}
</div>
@stop