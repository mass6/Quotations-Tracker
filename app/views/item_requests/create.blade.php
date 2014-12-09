@extends('layouts.main')

@section('content')

<div class="container col-md-6 col-md-offset-3">

    <h1>Create Item Request</h1>

    <?php $submit = 'Create Request' ?>
    {{ Form::open(array('route' => 'item-requests.store', 'files'=>true, 'class'=>'dropzone', 'id'=>'dropzone_example')) }}
        @include('item_requests.partials._formFields')
    {{ Form::close() }}


<!--    <div class="form-group">-->
<!--        <div class="fallback">-->
<!--            <input name="file" type="file" multiple />-->
<!--        </div>-->
<!--    </div>-->

    <div id="dze_info" class="hidden">

        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-title">Dropzone Uploaded Files Info</div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="40%">File name</th>
                    <th width="15%">Size</th>
                    <th width="15%">Type</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4"></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

@stop

@section('bottomlinks')
<script src="{{ URL::asset('js/bootstrap-datepicker.js') }}"></script>
<!--<script src="{{ URL::asset('js/fileinput.js') }}"></script>--><!-- 
<script src="{{ URL::asset('js/dropzone/dropzone.js') }}"></script> -->
<!--<script src="{{ URL::asset('js/neon-demo.js') }}"></script>-->
@stop