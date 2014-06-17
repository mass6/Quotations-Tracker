<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>
    $(function() {
        $( "#valid_until" ).datepicker();
    });
</script>

    {{ Form::open(array('route'=>'quotations.store', 'class'=>'form-horizontal', 'role'=>'form')) }}
        <fieldset>
          <legend>Complete the fields below to add a new quotation</legend>

          <!-- Supplier -->
          <div class="form-group">
            {{ Form::label('supplier', 'Supplier / Validity Date', ['class'=>'col-lg-2 control-label']) }}
            <div class="col-lg-7">
                {{ Form::select('supplier', $suppliers, null, ['id' => 'supplier', 'class' => 'form-control']) }}
              <span class="pull-right">* Required</span>
              <span class="help-block">Supplier from which this quotation was received.</span>
            </div>

              <!-- validity date -->
              <div class="col-lg-3">
                  {{ Form::input('date','valid_until', null, ['id'=>'valid_until','class'=>'form-control']) }}

                  <span class="pull-right">* Required</span>
                  <span class="help-block">Date for which this quotation is valid for.</span>
              </div>
          </div>

          <!-- productName -->
           <div class="form-group">
               {{ Form::label('productName', 'Product Name/Code', ['class'=>'col-lg-2 control-label']) }}
                <div class="col-lg-7">
                  {{ Form::text('productName', null, ['id'=>'productName','class'=>'form-control input-append', 'placeholder'=>'Product Name']) }}
                   <span class="pull-right @brand-primary">* Required</span>
                   <span class="help-block">Product name given from the supplier</span>
                </div>


              <!-- prodcutCode -->

                <div class="col-lg-3">
                  {{ Form::text('prodcutCode', null, ['id'=>'prodcutCode','class'=>'form-control','placeholder'=>'Product Code']) }}
                  <span class="help-block">Supplier product code</span>
                </div>
          </div>

          <!-- description -->
          <div class="form-group">
            <label for="description" class="col-lg-2 control-label">Description</label>
            <div class="col-lg-10">
                {{ Form::textarea('description', null, ['id'=>'description','class'=>'form-control','rows'=>4,'placeholder'=>'Product Description']) }}
              <span class="pull-right">* Required</span>
              <span class="help-block">Product description, including any relevant product specs or attributes</span>
            </div>
          </div>

            <!-- attributes -->
          <div id="product-attributes" style="display:none">

          </div>

          <!-- uom -->
          <div class="form-group">
            <label for="uom" class="col-lg-2 control-label">UOM / Price</label>
            <div class="col-lg-5">
              {{ Form::text('uom', null, ['id'=>'uom','class'=>'form-control','placeholder'=>'UOM']) }}
               <span class="pull-right">* Required</span>
              <span class="help-block">Purchase unit of measure</span>
            </div>
          <!-- uom price-->
            <div class="col-lg-3">
                {{ Form::text('uom_price', null, ['id'=>'uom_price','class'=>'form-control','placeholder'=>'Price']) }}
               <span class="pull-right">* Required</span>
              <span class="help-block">Purchase price per unit of measure</span>
            </div>
           <!-- min qty-->
            <div class="col-lg-2">
                {{ Form::text('min_qty', null, ['id'=>'min_qty','class'=>'form-control','placeholder'=>'Minimum Qty']) }}

              <span class="help-block">Minimum qty that must be purchased</span>
            </div>
          </div>

          <!-- packing -->
          <div class="form-group">
            <label for="packaging" class="col-lg-2 control-label">Packaging / Price</label>
            <div class="col-lg-5">
               {{ Form::text('packaging', null, ['id'=>'packaging','class'=>'form-control','placeholder'=>'Packaging']) }}
               <span class="pull-right">* Required</span>
              <span class="help-block">Inner pack type/quantity</span>
            </div>
          <!-- pack price-->
            <div class="col-lg-5">
               {{ Form::text('pack_price', null, ['id'=>'pack_price','class'=>'form-control','placeholder'=>'Pack Price']) }}
               <span class="pull-right">* Required</span>
              <span class="help-block">Purchase price per inner pack</span>
            </div>
          </div>

            <!-- delivery notes -->
            <div class="form-group">
                <label for="delivery_notes" class="col-lg-2 control-label">Delivery Notes</label>
                <div class="col-lg-10">
                    {{ Form::textarea('delivery_notes', null, ['id'=>'delivery_notes','class'=>'form-control','rows'=>4,'placeholder'=>'Delivery Notes']) }}
                    <span class="pull-right">* Required</span>
                    <span class="help-block">Notes, comments, and delivery options and/or restrictions</span>
                </div>
            </div>

            <!-- description -->
            <div class="form-group">
                <label for="notes" class="col-lg-2 control-label">Notes and Comments</label>
                <div class="col-lg-10">
                    {{ Form::textarea('notes', null, ['id'=>'notes','class'=>'form-control','rows'=>4,'placeholder'=>'Notes and comments']) }}
                    <span class="help-block">Any relevant notes and/or comments </span>
                </div>
            </div>

            <div class="form-group">
                {{ Form::submit( $submit, ['class' => 'btn btn-primary']) }} {{ link_to_route('quotations.index', 'Cancel', null, array('class'=>'btn btn-warning')) }}
            </div>


            <!-- end form -->

        </fieldset>

    <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div>


