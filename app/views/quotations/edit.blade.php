@extends('layouts.default')

@section('content')
<div class="container">
    <h3>Edit Quotation:  {{ $quotation->itemRequest['name'] }} [{{ $quotation->id }}]</h3>

    <div class="row" id="form-container" style="display:block;">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::model($quotation, ['route'=>['quotations.update', $quotation->id], 'method'=>'PUT','class'=>'form-horizontal','role'=>'form']) }}
                <?php $submit = 'Update' ?>
                @include('quotations.partials._form')

            </div>
        </div>
    </div>

</div>

<!--<script type="text/javascript" src="{{ URL::asset('js/settings/load-quotation.js') }}"></script>-->

@stop