
<div class="form-group pull-right clearfix">
    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('item-requests.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
</div>
<div class="clearfix"></div>

<div class="form-group">
    {{ Form::label('customer_id', 'Customer:') }}
    {{ Form::select('customer_id', $customersList, null, ['class'=>'form-control', 'id'=>'customer'] ) }}
    {{ $errors->first('customer_id', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('reference', 'Request Reference:') }}
    {{ Form::text('reference', null, ['class' => 'form-control']) }}
    {{ $errors->first('reference', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('name', 'Product Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control']) }}
    {{ $errors->first('name', '<span class="label label-warning">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('description', 'Description:') }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows'=>'5', 'id' => 'description']) }}
    {{ $errors->first('description', '<span class="label label-warning">:message</span>') }}
</div>

@if ( isset($item_request) )
<div class="form-group">
    {{ Form::label('attachments', 'Attachments') }}
        <ul class="">
            @foreach ($item_request->attachments as $attachment)
            <li><a href="{{ $attachment->attachment->url() }}" target="_blank" class="list-item">{{ $attachment->attachment->originalFilename() }}</a></li>
            @endforeach
        </ul>

</div>
@endif
<div class="form-group">
    {{ Form::label('attachment', 'Add Attachment') }}
    {{ Form::file('attachment') }}
</div>

<div class="form-group">
    <input id="assignattributes" type="button" class="btn btn-success" value="Assign attributes" onClick="showAttributes();">
    <hr/>
</div>

<div id="assigned-attributes" class="container col-sm-11 col-sm-offset-1 form-group" style="display:none;">

    <div id="dynamicInput" class="form-group">

    </div>
    <hr class="row clearfix" />
    <div class="form-group">
        <input type="button" class="btn btn-info btn-sm" value="Add additional attribute" onClick="addInput('dynamicInput');">
        <hr/>
    </div>

</div>

{{ Form::hidden('hasattributes', 0, ['id'=>'hasattributes']) }}

<div class="form-group">
    {{ Form::label('category_id', 'Product Category:') }}
    {{ Form::select('category_id', $categoriesList, null, ['class'=>'form-control', 'id'=>'category', 'placeholder' => 1] ) }}
    {{ $errors->first('category_id', '<span class="label label-warning">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('estimated_volume', 'Estimated Volumes:') }}
    {{ Form::text('estimated_volume', null, ['class' => 'form-control']) }}
    {{ $errors->first('estimated_volume', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('current_uom', 'Current UOM:') }}
    {{ Form::text('current_uom', null, ['class' => 'form-control']) }}
    {{ $errors->first('current_uom', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('current_price', 'Current Price:') }}
    {{ Form::text('current_price', null, ['class' => 'form-control']) }}
    {{ $errors->first('current_price', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('status', 'Status:') }}
    {{ Form::select('status', $statuses, null, ['class'=>'form-control', 'id'=>'status'] ) }}
    {{ $errors->first('status', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('assigned_to', 'Assigned To:') }}
    {{ Form::select('assigned_to', $usersList, null, ['class'=>'form-control', 'id'=>'assigned_to']) }}
    {{ $errors->first('assigned_to', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('notes', 'Notes:') }}
    {{ Form::textarea('notes', null, ['class' => 'form-control', 'rows'=>'5', 'id' => 'notes']) }}
    {{ $errors->first('notes', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group pull-left margin-top-200">
    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('item-requests.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
    {{ Form::close() }}
</div>

@if ( isset($item_request) )
<div class="form-group pull-right margin-top-200"
        {{ Form::open(array('method' => 'DELETE', 'route' => array('item-requests.destroy', $item_request->id), 'class'=>'form-inline')) }}
        {{ Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) }}
        {{ Form::close() }}
</div>
@endif


<script type="text/javascript">
    $(document).ready(function () {
        <?php if (isset($attributes)){ ?>
            var attributesObj = JSON.parse('<?php echo json_encode($attributes); ?>')
        <?php } else { ?>
        var attributesObj = 'd';
        <?php } ?>
        console.log(attributesObj)
        if (attributesObj !== 'd'){
            setAttributes(attributesObj);
        }
    });
</script>

<script type="text/javascript">
    var serial = 1;
    var counter = 1; // current count/index of attribute
    var limit = 10; // max amount of attributes allowed

    function showAttributes(attributes)
    {
        var div = document.getElementById('assigned-attributes');
        var bttn = document.getElementById('assignattributes');
        var att = document.getElementById('hasattributes');

        if (div.style.display == 'none')
        {
            div.style.display = 'block';
            bttn.value = "Remove attributes";
            bttn.className = 'btn btn-warning';
            att.value = 1;

            if (counter == 1)
            {
                addInput('dynamicInput');
            }
        } else
        {
            div.style.display = 'none';
            bttn.value = "Assign attributes";
            bttn.className = 'btn btn-info';
            att.value = 0;
        }
    }

    function setAttributes(attributes){
        console.log(attributes)
        //var attributeCount = Object.keys(attributes).length;
        var attributeCount = attributes.length;
        console.log(attributeCount);
        //var asgnatts = <?php //echo json_encode($attvals); ?> ;
<!--        var attlist = --><?php //echo json_encode($attributesList); ?><!-- ;-->
        //var numatts = Object.keys(attlist).length;
        //var lastatt = Object.keys(attlist)[numatts -1];
        if (attributeCount)
        {
            var div = document.getElementById('assigned-attributes');
            var bttn = document.getElementById('assignattributes');
            var hasattributes = document.getElementById('hasattributes');

            div.style.display = 'block';
            bttn.value = "Remove attributes";
            bttn.className = 'btn btn-warning';
            hasattributes.value = 1;

            for (var i = 1; i <= attributeCount; i++ )
            {
                counter++;
                var newdiv = document.createElement('div');
                var divId = 'attribute' + i;

                var inner = "<label for='attributes" + i + "'>Attribute:</label>"
                        + "<input type='text' id='" + ('attributes' + i)  +"' class='form-control' name ='attributes[]' value='" + attributes[i-1] + "'>";
                    inner += "<input type='button' class='btn btn-danger btn-sm pull-right clearfix' value='delete' onclick='deleteAttribute(\"" + divId + "\")' >";

                newdiv.innerHTML = inner;
                document.getElementById('dynamicInput').appendChild(newdiv);
                newdiv.className = 'form-group';
                newdiv.id = divId;
                serial++;
            }
        }
    }

    function addInput(divName){
        if ((counter - 1) == limit)  {
            alert("You have reached the limit of adding " + limit + " attributes");
        }
        else {
            var newdiv = document.createElement('div');
            var divId = 'attribute' + serial;
            var inner = "<label for='attributes" + serial + "'>Attribute:</label>"
                + "<input type='text' id='attributes" + serial + "' class='form-control' name ='attributes[]'>";
            inner += "<input type='button' class='btn btn-danger btn-sm pull-right clearfix' value='delete' onclick='deleteAttribute(\"" + divId + "\")' >";
            newdiv.innerHTML = inner;
            document.getElementById(divName).appendChild(newdiv);
            newdiv.className = 'form-group';
            newdiv.id = divId;
            serial++;
            counter++;
        }
    }

//    function setRequired(cbx)
//    {
//        //alert("works!: " + cbx);
//        var chbx = document.getElementById(cbx);
//        if(chbx.checked == true)
//        {
//            chbx.value = "required";
//        }
//        else
//        {
//            chbx.value = "optional";
//        }
//        //alert('Required: ' + chbx.value);
//    }

//    function dump(obj) {
//        var out = '';
//        for (var i in obj) {
//            out += i + ": " + obj[i] + "\n";
//        }
//
//        alert(out);
//
//        // or, if you wanted to avoid alerts...
//
//        var pre = document.createElement('pre');
//        pre.innerHTML = out;
//        document.body.appendChild(pre)
//    }

    function deleteAttribute(id){
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        counter--;
    }

</script>