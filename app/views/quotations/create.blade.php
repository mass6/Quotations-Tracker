@extends('layouts.default')

@section('content')
<div class="container">
    <h1>New Quotation</h1>
    <hr/>
    {{ Form::open( array(
    'route' => 'quotations.select',
    'method' => 'post',
    'id' => 'form-select-request',
    'class' => 'form-container'
    ) ) }}

    <fieldset>
    <div id="div_item_request_select" class="well bs-component form-group col-lg-10">
        <div class="col-lg-10">
            {{ Form::label( 'item_request_select', 'Item Request:', ['class' => 'control-label'] ) }}
        </div>

        <div class="col-lg-7">
            {{ Form::select( 'item_request_select', $itemRequests,null, array(
            'id' => 'item_request_select',
            'required' => true,
            'class' => 'form-control'
            ) ) }}
            <span id="selecthelper" class="help-block">Select an item request to attach the new quotation to</span>
        </div>

        <div class="col-lg-3">
            {{ Form::submit( 'New Quotation', array(
            'id' => 'btn-add-quotation',
            'class' => 'btn btn-primary'
            ) ) }}
        </div>
    </div>
    </fieldset>
    {{ Form::close() }}

    <div class="row" id="form-container" style="display:none;">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::open(array('route'=>'quotations.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
                <?php $submit = 'Create Quotation' ?>
                @include('quotations.partials._form')

            </div>
        </div>
    </div>

</div>

<script type="text/javascript" src="{{ URL::asset('js/quotations/select.js') }}"></script>

@stop