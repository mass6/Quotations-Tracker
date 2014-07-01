@extends('layouts.main')

@section('content')
<div class="container">
    <h1>New Quotation</h1>
    <legend>Complete the fields below to add a new quotation</legend>

    <div class="row" id="form-container">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::open(array('route'=>'quotations.store', 'class'=>'form-horizontal', 'role'=>'form', 'files'=>true)) }}
                <?php $submit = 'Create Quotation' ?>
                @include('quotations.partials._formFields')

            </div>
        </div>
    </div>

</div>

<!--<script type="text/javascript" src="{{ URL::asset('js/quotations/select.js') }}"></script>-->

@stop