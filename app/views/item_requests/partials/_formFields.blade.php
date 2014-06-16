
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
    {{ Form::select('category_id', $categoriesList, 1, ['class'=>'form-control', 'id'=>'category'] ) }}
    {{ $errors->first('category_id', '<span class="label label-warning">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('estimated_volume', 'Estimated Volumes:') }}
    {{ Form::text('estimated_volume', null, ['class' => 'form-control']) }}
    {{ $errors->first('estimated_volume', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('current_price', 'Current Price:') }}
    {{ Form::text('current_price', null, ['class' => 'form-control']) }}
    {{ $errors->first('current_price', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('status', 'Status:') }}
    {{ Form::select('status', ItemRequest::statuses(), null, ['class'=>'form-control', 'id'=>'status'] ) }}
    {{ $errors->first('status', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::label('assigned_to', 'Assigned To:') }}
    {{ Form::select('assigned_to', $usersList, null, ['class'=>'form-control', 'id'=>'assigned_to']) }}
    {{ $errors->first('assigned_to', '<span class="label label-warning">:message</span>') }}
</div>
<div class="form-group">
    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('item-requests.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
</div>


<script type="text/javascript">
    $(document).ready(function () {

        var attributesObj = JSON.parse('<?php echo isset($attributes) ? json_encode($attributes) : null; ?>');

        setAttributes(attributesObj);

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
        //var attributeCount = Object.keys(attributes).length;
        var attributeCount = attributes.length;
        //var asgnatts = <?php //echo json_encode($attvals); ?> ;
        var attlist = <?php echo json_encode($attributesList); ?> ;
        //var numatts = Object.keys(attlist).length;
        //var lastatt = Object.keys(attlist)[numatts -1];
        if (attributeCount)
        {
            var div = document.getElementById('assigned-attributes');
            var bttn = document.getElementById('assignattributes');
            var att = document.getElementById('hasattributes');

            div.style.display = 'block';
            bttn.value = "Remove attributes";
            bttn.className = 'btn btn-warning';
            att.value = 1;

            for (i = 0; i < attributeCount; i++ )
            {
                counter++;
                var newdiv = document.createElement('div');
                var divId = 'attribute' + serial;

                    var inner = "<label for='attributes" + serial + "'>Attribute:</label>"
                        + "<select id='" + ('attributes' + serial)  +"' class='form-control' name ='attributes[" + serial + "][0]'>";
                <?php foreach($attributesList as $key => $val) {?>

                if (attributes[i][0] == "<?php echo $key; ?>")
                    {
                        inner += "<option value='<?php echo $key ?>' selected='selected'><?php echo $val ?></option>";
                    } else
                    {
                        inner += "<option value='<?php echo $key ?>'><?php echo $val ?></option>";
                    }

                <?php } ?>


                    inner += "</select>";
                var cbxRequired = "required" + serial;
                if (attributes[i][1] === "required" )
                    {
                        inner += "<input type='checkbox' name='" + 'attributes[' + i + '][1]' + "'" + 'value="required" checked="checked" class="">Required<br>';
                    } else
                    {
                        inner += "<input type='checkbox' name='" + 'attributes[' + i + '][1]' + "'" + 'value="required" class="">Required<br>';
                    }


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
                + "<select id='" + ('attributes' + serial)  +"' class='form-control' name ='attributes[" + serial + "][0]'>";

            <?php foreach($attributesList as $key => $val) {?>
                inner += "<option value='<?php echo $key ?>'><?php echo $val ?></option>";
            <?php } ?>

            inner += "</select>";
            var cbxRequired = "required" + serial;

            inner += "<input type='checkbox' name='" + 'attributes[' + serial + '][1]' + "'" + 'value="required" class="">Required<br>';
            inner += "<input type='button' class='btn btn-danger btn-sm pull-right clearfix' value='delete' onclick='deleteAttribute(\"" + divId + "\")' >";
            newdiv.innerHTML = inner;
            document.getElementById(divName).appendChild(newdiv);
            newdiv.className = 'form-group';
            newdiv.id = divId;
            serial++;
            counter++;
        }
    }

    function setRequired(cbx)
    {
        //alert("works!: " + cbx);
        var chbx = document.getElementById(cbx);
        if(chbx.checked == true)
        {
            chbx.value = "required";
        }
        else
        {
            chbx.value = "optional";
        }
        //alert('Required: ' + chbx.value);
    }

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }

        alert(out);

        // or, if you wanted to avoid alerts...

        var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)
    }

    function deleteAttribute(id){
        var elem = document.getElementById(id);
        elem.parentNode.removeChild(elem);
        counter--;
    }

</script>