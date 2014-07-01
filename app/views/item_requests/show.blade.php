@extends('layouts.main')

@section('content')
<div class="container">
    <h3>Item Request:  {{ $item_request->itemRequest['name'] }} [{{ $item_request->id }}]</h3>

    <div class="row" id="form-container" style="display:block;">
        <div class="col-lg-10">
            <div class="well bs-component">

                {{ Form::model($item_request, ['url'=>[''], 'method'=>'POST','class'=>'form-horizontal','role'=>'form']) }}

                <p><strong>Item Request No:</strong> {{ $item_request['id'] }}</p>
                <p><strong>Customer:</strong> {{ $item_request->customer->name}}</p>
                <p><strong>Created:</strong> {{ $item_request->created_at->format('d-m-Y')}}</p>
                <p><strong>Created By:</strong> {{ $item_request->createdBy->first_name }}</p>
                <p><strong>Status:</strong> {{ $item_request->status }}</p>
                <p><strong>Assigned To:</strong> {{ $item_request->assignedTo->first_name }}</p>

                <p><strong>Attributes:</strong> </p>

                @if ( isset($attributes) )
                <div>
                    <ul>
                        @foreach ($attributes as $attribute)

                            <li>{{ $attribute }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif



                <p><strong>Attachments:</strong> </p>
                <div>
                    <ul class="">
                        @foreach ($item_request->attachments as $attachment)
                        <li><a href="{{ $attachment->attachment->url() }}" target="_blank" class="list-item">{{ $attachment->attachment->originalFilename() }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{ Form::close() }}
                <div class="form-group">
                    {{ link_to_route('item-requests.edit', 'Edit', array($item_request->id), array('class' => 'btn btn-primary')) }} {{ link_to_route('item-requests.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
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

                        <div class="well bs-component">
                            @foreach ($item_request->comments as $comment)
                            <div>
                                <h5>{{ $comment->user->first_name .' on ' . $comment->created_at }}</h5>
                                <div class="well bs-component">
                                    <p>{{ $comment->body }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <?php $type = 'ItemRequest'; ?>
                        <?php $id = $item_request['id']; ?>
                        @include('comments._form')
                    </div>
                </div>






            </div>
        </div>
    </div>

</div>

<!--<script type="text/javascript" src="{{ URL::asset('js/settings/load-quotation.js') }}"></script>-->

@stop