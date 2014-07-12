@extends('layouts.main')

@section('links')
<link rel="stylesheet" href="{{ URL::asset('js/dropzone/dropzone.css') }}">
@stop

@section('content')
<div class="container">
    <h3>Edit Quotation: <span>{{ $quotation->product_name }}</span></h3>

    <div class="row" id="form-container" style="display:block;">
        <div class="col-lg-10">
            <div class="well bs-component">

                <div class="well bs-component">
                    @if ( count($quotation->itemRequests) )
                    <div class="col-lg-5">
                        <h4>Linked Item Requests</h4>
                        <ul class="list-unstyled">
                            @foreach ($quotation->itemRequests as $request)
                            {{ Form::open(array('route' => array('detach-request', $quotation->id, $request->id), 'method'=>'PATCH')) }}
                            <li>#{{ $request->id }} : {{ $request->name }} {{ Form::submit('remove', ['class'=>'btn btn-warning btn-xs',
                                'onclick' => "if(!confirm('Are you sure you wish to remove this item request?')){return false;};"]) }}</li>
                            {{ Form::close() }}
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="col-lg-6 col-lg-offset-1">
                        <h4>Link to Item Requests</h4>
                        <div class="form-group">
                            {{ Form::open(array('route' => array('attach-request', $quotation->id), 'method'=>'PATCH')) }}
                            {{ Form::select('item-request-attach', $item_requests_list, null , ['class'=>'form-control'] ) }}<br/>
                            {{ Form::submit('Attach Request', ['class'=>'btn btn-primary btn-sm']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>


                {{ Form::model($quotation, ['route'=>['quotations.update', $quotation->id], 'method'=>'PUT','class'=>'form-horizontal','role'=>'form', 'files'=>true]) }}
                <?php $submit = 'Update' ?>
                @include('quotations.partials._formFields')

            </div>
        </div>
    </div>

</div>



@stop

@section('bottomlinks')
<script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<!--<script src="{{ URL::asset('js/dropzone/dropzone.js') }}"></script>-->
@stop