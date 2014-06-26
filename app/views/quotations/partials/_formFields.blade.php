<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#valid_until" ).datepicker({ format: "dd-mm-yyyy" });

    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
                var line = ''
        <?php if ( isset($item_request) && ! Session::has('create') ) { ?>
                document.getElementById('item_request').value = "<?php echo $item_request->id; ?>"
                document.getElementById('form-container').style.display = 'block';
                document.getElementById('div_item_request_select').style.display = 'none';
                document.getElementById('item_request_name').innerHTML = "<?php echo $item_request->name; ?>";
                document.getElementById('item_request_created').innerHTML = "<?php echo $item_request->created_at->format('d-m-Y'); ?>";
                // set attributes array
                <?php $attributes = isset($attributes) ? $attributes : null; ?>
                var attributes = <?php echo json_encode($attributes); ?>;
                console.log(attributes)
                if ( attributes != null){
                    setAttributes(attributes);
                }
        <?php } ?>
        // if validation fails during new record creation
        <?php if (Session::has('create_revalidate')){ ?>
                document.getElementById('form-container').style.display = 'block';
                document.getElementById('div_item_request_select').style.display = 'none';
                document.getElementById('btn-add-quotation').style.display = 'none';
                document.getElementById("selecthelper").style.visibility = 'hidden';
                document.getElementById('item_request_select').disabled = true;
                document.getElementById('item_request_name').innerHTML = "<?php echo Session::has('item_request')
                ? Session::get('item_request')['name'] . ' | ID: ' . Session::get('item_request')['id'] : null ; ?>";
                document.getElementById('item_request_created').innerHTML = "<?php echo Session::has('item_request')
                ? Session::get('item_request')['created_at']->format('d-m-Y') : null ; ?>";
        <?php } ?>
        // if validation fails during record update
        <?php if (Session::has('revalidate')){ ?>
                // set attributes array
                <?php $attributes = Session::has('attributes') ? json_encode(Session::get('attributes')) : null; ?>
                var attributes = <?php echo $attributes; ?>;
                // set attribute values array
                <?php $values = Session::has('values') ? json_encode(Session::get('values')) : null; ?>
                var values = <?php echo $values; ?>;

                if ( attributes != null){
                    setAttributes(attributes, values);
                }

         // load model form for editing
        <?php } elseif (isset($reload)){ ?>
                var attributes = <?php echo isset($attributes) ? $attributes : null; ?>;
                var values = <?php echo isset($values) ? $values : null; ?>;
                if ( attributes != null){
                    if ( values == null){
                        var values = []
                        for (var i = 0; i <= attributes.length; i++)
                        {
                            values[i] = '';
                        }
                    }
                   setAttributes(attributes, values);
                }

        <?php } ?>
    });

    /**
     * Takes the attributes and values arrays and creates form field
     * elements for each attribute defined
     *
     * @param attributes
     * @param values
     */
    function setAttributes(attributes, values = null)
    {
        var attributeCount = attributes.length;
        // if model has defined attributes
        if ( attributeCount )
        {
            // ensure values array is defined with at least empty strings
            if (values == null){
                var values = [];
                for (var i = 0; i <= attributes.length; i++){
                    values[i] = '';
                }
            }
            // loop through each attribute and create form elements
            for (var i = 0; i < attributeCount; i++)
            {
                var newdiv = document.createElement('div');
                var divId = 'attribute' + i;
                var inner = "<label for='attributes" + i + "' class='col-lg-2 control-label'>" + attributes[i] + ":</label><div class='col-lg-10'>"
                    + "<input type='text' id='" + ('attributes' + i )  +"' class='form-control' name ='" + attributes[i] + "' value='" + values[i] +  "'>"
                    + "</div>";
                inner += '<input type="hidden"  value="' + attributes[i] + '" name="attributes[]" >';
                newdiv.innerHTML = inner;
                document.getElementById('product-attributes').appendChild(newdiv);
                newdiv.className = 'form-group';
                newdiv.id = divId;
            }
            // show attribute container div
            document.getElementById('product-attributes').style.display = "block";
        }
    }
</script>

@if (isset($errors))
    @if ( count($errors) )
    <div class="errors alert alert-danger">
        @foreach ($errors->all('<li>:message</li>') as $message)
        {{ $message }}
        @endforeach
    </div>
    @endif
@endif

    {{ Form::hidden('item_request', null, ['id'=>'item_request']) }}
        <fieldset>
          <legend>Complete the fields below to add a new quotation</legend>

         <div class="panel panel-primary"><br/>
          <!-- Item Request data -->
          <div class="form-group">
            {{ Form::label('item_request_name', 'Item Request', ['class'=>'col-lg-2 control-label']) }}
            <div class="col-lg-6">
                <pre  id="item_request_name">{{ isset($quotation->itemRequest['name']) ? $quotation->itemRequest['name'] : null }} | ID: {{ isset($quotation->itemRequest['id']) ? $quotation->itemRequest['id'] : null }}
                </pre>
                {{-- Form::text('item_request_name', isset($quotation->itemRequest['name']) ? $quotation->itemRequest['name'] : null, ['id' => 'item_request_name', 'class' => 'form-control col-lg-7']) --}}
              <span class="help-block">Item Request that this quotation is attached to.</span>
            </div>

            <div class="col-lg-3 col-lg-offset-0">
               <pre id="item_request_created">{{ isset($quotation->itemRequest['created_at']) ? $quotation->itemRequest['created_at']->format('d-m-Y') : null }}</pre>
               <span class="help-block">Date item request was created</span>
            </div>
          </div>
        </div>
          <div class="well bs-component">
              <h4>Supplier and General Product Description</h4><br/>
          <!-- Supplier -->
          <div class="form-group">
            {{ Form::label('supplier_id', 'Supplier / Validity Date', ['class'=>'col-lg-2 control-label']) }}
            <div class="col-lg-7">
                {{ Form::select('supplier_id', $suppliers, null, ['id' => 'supplier', 'class' => 'form-control']) }}
              <span class="pull-right">* Required</span>
              <span class="help-block">Supplier from which this quotation was received.</span>
                {{ $errors->first('supplier', '<span class="label label-warning">:message</span>') }}
            </div>

              <!-- validity date -->
              <div class="col-lg-3">
                  {{ Form::input('date','valid_until', isset($valid_until) ? $valid_until : null, ['id'=>'valid_until','class'=>'form-control']) }}
                  <span class="pull-right">* Required</span>
                  <span class="help-block">Date for which this quotation is valid for.</span>
                  {{ $errors->first('valid_until', '<span class="label label-warning">:message</span>') }}
              </div>
          </div>

          @if ( isset($quotation) )
          <div class="form-group">
              {{ Form::label('attachments', 'Attachments', ['class'=>'col-lg-2 control-label']) }}
              <div class="col-lg-10">
                  <ul class="">
                      @foreach ($quotation->attachments as $attachment)
                     <li><a href="{{ $attachment->attachment->url() }}" target="_blank" class="list-item">{{ $attachment->attachment->originalFilename() }}</a></li>
                      @endforeach
                  </ul>
              </div>
          </div>
          @endif
          <div class="form-group">
            {{ Form::label('attachment', 'Add Attachment', ['class'=>'col-lg-2 control-label']) }}
              <div class="col-lg-10">
                  {{ Form::file('attachment') }}
              </div>
          </div>

          <!-- productName -->
           <div class="form-group">
               {{ Form::label('product_name', 'Product Name/Code', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                  {{ Form::text('product_name', null, ['id'=>'product_name','class'=>'form-control input-append', 'placeholder'=>'Product Name']) }}
                   <span class="pull-right @brand-primary">* Required</span>
                   <span class="help-block">Product name given from the supplier</span>
                    {{ $errors->first('product_name', '<span class="label label-warning">:message</span>') }}
                </div>

              <!-- productCode -->
                <div class="col-lg-3">
                  {{ Form::text('product_code', null, ['id'=>'product_code','class'=>'form-control','placeholder'=>'Product Code']) }}
                  <span class="help-block">Supplier product code</span>
                    {{ $errors->first('product_code', '<span class="label label-warning">:message</span>') }}
                </div>
          </div>

          <!-- description -->
          <div class="form-group">
            <label for="description" class="col-lg-2 control-label">Description</label>
            <div class="col-lg-10">
                {{ Form::textarea('product_description', null, ['id'=>'product_description','class'=>'form-control','rows'=>4,'placeholder'=>'Product Description']) }}
              <span class="pull-right">* Required</span>
              <span class="help-block">Product description, including any relevant product specs or attributes</span>
                {{ $errors->first('product_description', '<span class="label label-warning">:message</span>') }}
            </div>
          </div>
      </div>


            <!-- attributes -->
          <div id="product-attributes" class="well bs-component" style="display:none">
              <h4>Product Attributes <span class="label label-warning">Required</span></h4><br/>
          </div>

        <div class="well bs-component">
         <h4>Packing, Pricing & Delivery</h4><br/>

          <!-- uom -->
              <div class="form-group">
                <label for="uom" class="col-lg-2 control-label">UOM / Price</label>
                <div class="col-lg-5">
                  {{ Form::text('uom', null, ['id'=>'uom','class'=>'form-control','placeholder'=>'UOM']) }}
                   <span class="pull-right">* Required</span>
                  <span class="help-block">Purchase unit of measure</span>
                    {{ $errors->first('uom', '<span class="label label-warning">:message</span>') }}
                </div>
              <!-- uom price-->
                <div class="col-lg-3">
                    {{ Form::text('uom_price', null, ['id'=>'uom_price','class'=>'form-control','placeholder'=>'Price']) }}
                   <span class="pull-right">* Required</span>
                  <span class="help-block">Purchase price per unit of measure</span>
                    {{ $errors->first('uom_price', '<span class="label label-warning">:message</span>') }}
                </div>
               <!-- min qty-->
                <div class="col-lg-2">
                    {{ Form::text('min_qty', null, ['id'=>'min_qty','class'=>'form-control','placeholder'=>'Minimum Qty']) }}
                  <span class="help-block">Minimum qty that must be purchased</span>
                    {{ $errors->first('min_qty', '<span class="label label-warning">:message</span>') }}
                </div>
              </div>

              <!-- packing -->
              <div class="form-group">
                <label for="packaging" class="col-lg-2 control-label">Packaging / Price</label>
                <div class="col-lg-5">
                   {{ Form::text('packaging', null, ['id'=>'packaging','class'=>'form-control','placeholder'=>'Packaging']) }}
                   <span class="pull-right">* Required</span>
                  <span class="help-block">Inner pack type/quantity</span>
                    {{ $errors->first('packaging', '<span class="label label-warning">:message</span>') }}
                </div>
              <!-- pack price-->
                <div class="col-lg-5">
                   {{ Form::text('pack_price', null, ['id'=>'pack_price','class'=>'form-control','placeholder'=>'Pack Price']) }}
                   <span class="pull-right">* Required</span>
                  <span class="help-block">Purchase price per inner pack</span>
                    {{ $errors->first('pack_price', '<span class="label label-warning">:message</span>') }}
                </div>
              </div>


            <!-- delivery notes -->
            <div class="form-group">
                <label for="delivery_notes" class="col-lg-2 control-label">Delivery Notes</label>
                <div class="col-lg-10">
                    {{ Form::textarea('delivery_notes', null, ['id'=>'delivery_notes','class'=>'form-control','rows'=>4,'placeholder'=>'Delivery Notes']) }}
                    <span class="pull-right">* Required</span>
                    <span class="help-block">Notes, comments, and delivery options and/or restrictions</span>
                    {{ $errors->first('delivery_notes', '<span class="label label-warning">:message</span>') }}
                </div>
            </div>
        </div>
            <!-- Notes & Commnets -->
            <div class="form-group">
                <label for="notes" class="col-lg-2 control-label">Notes and Comments</label>
                <div class="col-lg-10">
                    {{ Form::textarea('notes', null, ['id'=>'notes','class'=>'form-control','rows'=>4,'placeholder'=>'Notes and comments']) }}
                    <span class="help-block">Any relevant notes and/or comments </span>
                    {{ $errors->first('notes', '<span class="label label-warning">:message</span>') }}
                </div>
            </div>

            <!-- Supplier -->
            <div class="form-group">
                {{ Form::label('status', 'Status', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-lg-5">
                    {{ Form::select('status', $statuses, null, ['id' => 'status', 'class' => 'form-control']) }}
                    <span class="pull-right">* Required</span>
                    <span class="help-block">Status of this quotation</span>
                    {{ $errors->first('status', '<span class="label label-warning">:message</span>') }}
                </div>
            </div>

            <div class="form-group pull-left">
                <div class="col-lg-10 col-lg-offset-2">
                    {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('quotations.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
                    {{ Form::close() }}
                </div>
            </div>

            <!-- TODO : create a confirmation dialog for model deletions -->
        @if ( isset($quotation) )
            <div class="form-group pull-right">
                {{ Form::open(array('method' => 'DELETE', 'route' => array('quotations.destroy', $quotation->id), 'class'=>'form-inline')) }}
                {{ Form::submit('Delete', array('class' => 'btn btn-danger pull-right')) }}
                {{ Form::close() }}
            </div>
        @endif

            <!-- end form -->
        </fieldset>

    <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div>


