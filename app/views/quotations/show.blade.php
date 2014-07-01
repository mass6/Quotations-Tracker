@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Quotation:  {{ $quotation->itemRequest['name'] }} [{{ $quotation->id }}]</h3>

    <div class="row" id="form-container" style="display:block;">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::model($quotation, ['url'=>[''], 'method'=>'POST','class'=>'form-horizontal','role'=>'form']) }}

                <p><strong>Quotation ID:</strong> {{ $quotation['id'] }}</p>
                <p><strong>Created By:</strong> {{ $quotation->createdBy->first_name }}</p>
                <p><strong>Created At:</strong> {{ $quotation['created_at'] }}</p><br/>
                <p><strong>Product Name:</strong> {{ $quotation->product_name }}</p>
                <p><strong>Product Code:</strong> {{ $quotation->product_code }}</p>
                <p><strong>Supplier:</strong> {{ $quotation->supplier->name }}</p>
                <p><strong>Validity:</strong> {{ $quotation->valid_until->format('d-m-Y') }}</p>

                <p><strong>Attributes:</strong> </p>

                <div>
                    <ul>
                        @for ($i = 0; $i < count($attributes); $i++)

                            <li>{{ $attributes[$i] . ': ' . $attribute_values[$i] }}</li>
                        @endfor

                    </ul>
                </div>

                <p><strong>UOM:</strong> {{ $quotation->uom }}</p>

                <p><strong>Attachments:</strong> </p>
                <div>
                    <ul class="">
                        @foreach ($quotation->attachments as $attachment)
                        <li><a href="{{ $attachment->attachment->url() }}" target="_blank" class="list-item">{{ $attachment->attachment->originalFilename() }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{ Form::close() }}
                <div class="form-group">
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('quotations.destroy', $quotation->id), 'class'=>'form-inline')) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) }}
                    {{ Form::close() }}
                    {{ link_to_route('quotations.edit', 'Edit', array($quotation->id), array('class' => 'btn btn-primary')) }} {{ link_to_route('quotations.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
                </div>
            </div>

            <!-- Comments -->
            <div class="container col-lg-6">
                <div class="row">
                    <h2 class="">Comments</h2>
                    @if (Session::has('comment_message'))
                    <div class="row alert {{ Session::get('success') ? 'alert-success' : 'alert-danger' }} clearfix" data-dismiss="alert">
                        {{ Session::get('comment_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                    @endif

                    @if ( count($quotation->comments) )
                        <div class="well bs-component">
                            @foreach ($quotation->comments as $comment)
                            <div>
                                <h5>{{ $comment->user->first_name .' on ' . $comment->created_at }}</h5>
                                <div class="well bs-component">
                                    <p>{{ $comment->body }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <?php $type = 'Quotation'; ?>
                    <?php $id = $quotation['id']; ?>
                    @include('comments._form')
                </div>
            </div>

        </div>
    </div>

</div>

<!--<script type="text/javascript" src="{{ URL::asset('js/settings/load-quotation.js') }}"></script>-->

@stop