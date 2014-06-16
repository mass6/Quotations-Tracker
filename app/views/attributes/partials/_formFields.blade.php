
<div class="form-group">
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control','id'=>'name']) }}
    {{ $errors->first('name', '<span class="label label-warning">:message</span>') }}
</div>

<div id="mydiv" class="form-group">
    {{ Form::label('description', 'Description:') }}
    {{ Form::textarea('description', null, ['class' => 'form-control', 'onfocus' => 'pop("mydiv")']) }}
    {{ $errors->first('description', '<span class="label label-warning">:message</span>') }}
</div>

<div class="form-group">
    {{ Form::label('type', 'Type:') }}
    {{ Form::select('type', ["text"=>"Text", "textarea"=>"Text Area", "boolean"=>"Yes/No", "select"=>"Select"]
    , null, ['class'=>'form-control', 'id'=>'type'] ) }}
    {{ $errors->first('type', '<span class="label label-warning">:message</span>') }}
</div>


<div id="attribute-options" class="container col-sm-11 col-sm-offset-1 form-group" style="display:none;">

	<div id="dynamicInput" class="form-group">

    </div>

    <div class="form-group">
     <input type="button" class="btn btn-info" value="Add additional value option" onClick="addInput('dynamicInput');">
        <hr/>
 	</div>

</div>

<div class="container pull-left form-group">
    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('attributes.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
</div>

<script type="text/javascript">
    $(document).ready(function () {
		$('#type').on('change',function(){
	        if( $(this).val()==="select"){
	            $("#attribute-options").show();
                addInput('dynamicInput');
	        }
	        else{
	        $("#attribute-options").hide()
	        }
	    });
         setValues( <?php echo isset($attribute->values) ? $attribute->values : null ?> );

        //var txt = <?php //echo $vals; ?>;
        //var namediv = document.getElementById('name');
        //namediv.value = txt;
     });


</script>
<script type="text/javascript">
	var counter = 1;
	var limit = 10;

    function setValues(values) {
        if (values.length && $('#type').val()==="select")
        {
            $("#attribute-options").show();
        }

        for (i = 0; i < values.length; i++ )
        {
            var newdiv = document.createElement('div');
            var divId = 'input' + counter;
            newdiv.innerHTML ="<label for='option" + (i + 1) + "'>Option:</label>"
                + "<input type='text' class='form-control' name='myInputs[]' value='" + values[i] + "'>"
                + "<input type='button' class='btn btn-danger btn-sm pull-right clearfix' value='delete' onclick='removeValue(\"" + divId + "\")' >";
            document.getElementById('dynamicInput').appendChild(newdiv);
            newdiv.className = 'form-group';
            newdiv.id = divId;
            counter++;
        }


    }
    function addInput(divName){
	     if (counter == limit)  {
	          alert("You have reached the limit of adding " + counter + " inputs");
	     }
	     else {
	          var newdiv = document.createElement('div');
              var divId = 'input' + counter;
	          newdiv.innerHTML = "<label for='option" + counter + "'>Option:</label>"
	          + "<input type='text' class='form-control' name='myInputs[]' placeholder='Specify value' >"
              + "<input type='button' class='btn btn-danger btn-sm pull-right clearfix' value='delete' onclick='removeValue(\"" + divId + "\")' >";
	          document.getElementById(divName).appendChild(newdiv);
	          newdiv.className = 'form-group';
              newdiv.id = divId;
	          counter++;
	     }
	}

    function removeValue(value){
        var elem = document.getElementById(value);
        elem.parentNode.removeChild(elem);
    }


</script>


