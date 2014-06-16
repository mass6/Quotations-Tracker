

<div class="row">
          <div class="col-lg-10">
            <div class="well bs-component">
            {{ Form::open(array('route'=>'quotations.store', 'class'=>'form-horizontal', 'role'=>'form')) }}              
                <fieldset>
                  <legend>Complete the fields below to add a new quotation</legend>

                  <!-- Supplier -->
                  <div class="form-group">
                    <label for="supplier" class="col-lg-2 control-label">Supplier</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select">
                        <option>Galaxy</option>
                        <option>36S</option>
                      </select>  
                      <span class="pull-right">* Required</span>
                      <span class="help-block">Supplier from which this quotation was received.</span>
                    </div>
                  </div>
                  
                  <!-- productName -->
                   <div class="form-group">
                        <label for="productName" class="col-lg-2 control-label">Product Name/Code</label>
                        <div class="col-lg-7">
                          <input class="form-control input-append" required="required" name="productName" id="productName" placeholder="Product Name" type="text">
                           <span class="pull-right @brand-primary">* Required</span>
                           <span class="help-block">Product name given from the supplier</span>
                        </div>                   

                             
                      <!-- prodcutCode -->
                       
                        <div class="col-lg-3">
                          <input class="form-control" name="prodcutCode" id="prodcutCode" placeholder="Product Code" type="text">
                          <span class="help-block">Supplier product code</span>
                        </div>
                  </div>
                  
                  <!-- description -->
                  <div class="form-group">
                    <label for="description" class="col-lg-2 control-label">Description</label>
                    <div class="col-lg-10">
                      <textarea class="form-control" rows="3" id="textArea"></textarea>
                      <span class="pull-right">* Required</span>
                      <span class="help-block">Product description, including any relevant product specs or attributes</span>
                    </div>
                  </div>

                  <!-- uom -->
                  <div class="form-group">
                    <label for="uom" class="col-lg-2 control-label">UOM / Price</label>
                    <div class="col-lg-5">
                      <input type="text" class="form-control" name="uom" placeholder="UOM">
                       <span class="pull-right">* Required</span>              
                      <span class="help-block">Purchase unit of measure</span>
                    </div>  
                  <!-- uom price-->
                    <div class="col-lg-5">
                    <span class="input-group-addon">$</span>
                      <input type="text" class="form-control" name="uom_price" placeholder="Price">
                       <span class="pull-right">* Required</span>              
                      <span class="help-block">Purchase unit of measure</span>
                    </div>                      
                  </div>

                  <!-- packing -->
                  <div class="form-group">
                    <label for="packaging" class="col-lg-2 control-label">Packaging / Price</label>
                    <div class="col-lg-5">
                      <input type="text" class="form-control" name="packaging" placeholder="Packaging">
                       <span class="pull-right">* Required</span>              
                      <span class="help-block">Inner pack type/quantity</span>
                    </div>  
                  <!-- pack price-->
                    <div class="col-lg-5">
                      <span class="input-group-addon">$</span>
                      <input type="text" class="form-control" name="pack_price" placeholder="Pack Price">
                       <span class="pull-right">* Required</span>              
                      <span class="help-block">Purchase price per inner pack</span>
                    </div>                      
                  </div>

                  <!-- Supplier -->
                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input class="form-control" id="inputPassword" placeholder="Password" type="password">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Checkbox
                        </label>
                      </div>
                    </div>
                  </div>

                  <!-- Supplier -->
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Radios</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input name="optionsRadios" id="optionsRadios1" value="option1" checked="" type="radio">
                          Option one is this
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input name="optionsRadios" id="optionsRadios2" value="option2" type="radio">
                          Option two can be something else
                        </label>
                      </div>
                    </div>
                  </div>

                  <!-- Supplier -->
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Selects</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      <br>
                      <select multiple="" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>

                  <!-- Supplier -->
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                  
                  <!-- end form -->

                </fieldset>
              </form>
            <div style="display: none;" id="source-button" class="btn btn-primary btn-xs">&lt; &gt;</div></div>
          </div>          
        </div>