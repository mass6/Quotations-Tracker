@extends('layouts.main')

@section('links')
<link rel="stylesheet" href="{{ URL::asset('js/dropzone/dropzone.css') }}">
@stop

@section('content')

<h3>
    Dropzone - Drag n' Drop File Upload
    <br />
    <small>The upload script will generate random response status (error or success), files are not uploaded.</small>
</h3>

<br />

<form action="data/upload-file.php" class="dropzone" id="dropzone_example">
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>
</form>

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


@stop


@section('bottomlinks')

<script src="{{ URL::asset('js/fileinput.js') }}"></script>
<script src="{{ URL::asset('js/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('js/neon-demo.js') }}"></script>
@stop