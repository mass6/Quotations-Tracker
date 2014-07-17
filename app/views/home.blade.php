@extends(Config::get('view.layout'))

@section('content')
	<div class="container">
		<div class="jumbotron">
		  <h1>36S Insight Portal</h1>
		  <p>Welcome to Insight. Please choose an option from the menu on the left.</p>
		</div>
	<div>
        <div class="clearfix"></div>
        <p>{{ Config::get('app.layout'); }}</p>
@stop