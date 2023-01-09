<script type="text/javascript">
    isInput=false;
    hideButtons=true;
    
    function hideButton(){
        if(hideButtons){
            $(".btn-openModalVariant").addClass("d-none");
        }else{
            $(".btn-openModalVariant").removeClass("d-none");
        }
    }
    
    $(document).ready(function(){
        
        // // // initialize
        // mytagsinput.tagsinput({
        //             itemValue: 'id',
        //                 itemText: 'text',
        //             });
    
        // //add my tags object
        // mytagsinput.tagsinput();
        // mytagsinput.value="asdasdas";
        
    
    
        //Fixing jQuery Click Events for the iPad
        var ua = navigator.userAgent,
            event = (ua.match(/iPad/i)) ? "touchstart" : "click";
    
            if ($('.table').length > 0) {
                $('.table .header').on(event, function() {
                    $(this).not('.input-detailVariant').toggleClass("openrow").nextUntil('.header').css('display', function(i, v) {
                        return this.style.display === 'table-row' ? 'none' : 'table-row';
                    });
            });
        }

        // show data
        $("#product_code").val('{{$product->product_code}}');
        $("#product_name").val('{{$product->product_name}}');
        $("#category_code").val('{{$product->category_code}}').trigger('change');
        $("#brand_code").val('{{$product->brand_code}}').trigger('change');
        $("#supplier_code").val('{{$product->supplier_code}}').trigger('change');
        $("#product_buyPrice").val('{{$product->product_buyPrice}}');
    

        // var checkTag=JSON.parse(tag.replace(/&quot;/g,'"'));
        // $.each(checkTag,function(iTag,vTag){
        //     $('#tag_code').tagsinput('add',vTag['tag_name']);   
            // $('#tag_code').select2(
                
            // 'add',vTag['tag_name']
            // {
            //     tags: true,
            //     tokenSeparators: [',', ' '],
            //     selectOnClose: true,

            //     //             insertTag: function (data, tag) {
            //     // // Insert the tag at the end of the results
            //     // data.push(tag);
            //     //   }
            // });
        // }); 
            
        checkVariant='{{$levelAttribute->attribute_code}}';
        if(checkVariant!=''){
            // $("#kolomVariant").append(`
            //     <strong>Variants</strong>
            //         <div class="row">
            //             <div class="col-md-4">
            //                 <p>Choose up to three variable attributes for this product to create and manage Barcode Code's and their inventory levels.</p>
            //                 <br>
            //             </div>
            //             <div class="col-md-8">
            //                 <table class="table" width="100%">
            //                     <thead>
            //                         <th width="1%;">Attribute&nbsp;(e.g.&nbsp;Colour)</th>
            //                         <th colspan="2">Value (e.g. Red, Blue, Green) </th>
            //                     </thead>
            //                     <tbody id="kolomAttribute">
                                   
            //                     </tbody>
            //                     <tfoot>
            //                         <tr>
            //                             <td colspan="2" style="border-top:0px;">
            //                                 <a class="text-success add-attribute pointer"><i class="fas fa-plus-square"></i> Add another attribute</a>
            //                             </td>
            //                         </tr>
            //                         <tr>
            //                             <td colspan="2" style="border-top:0px;">
            //                                 <button class="btn-success btn float-right btn-openModalVariant" type="button">Done</button>
            //                             </td>
            //                         </tr>
            //                     </tfoot>
            //                 </table>
            //                 <h5>
            //                     <strong id="totalVariant">This product has 0 variant.</strong>
            //                 </h5>
            //                 <div class="table-responsive">
            //                     <table class="table tescollapse" width="100%" id="tableVariant">
            //                         <thead>
            //                             <th width="300px;">Variant Name</th>
            //                             <th>Barcode Code</th>
            //                             <th>Supply Price</th>
            //                             <th>Retail Price
            //                                 <br>
            //                                 <small>
            //                                     Excluding Tax
            //                                 </small>
            //                             </th>
            //                             <th width="1%;">
            //                                 Enabled
            //                             </th>
            //                             <th width="1%;"></th>
            //                         </thead>
            //                     </table>
            //                 </div>
            //             </div>
            //     </div>
            // `);
            var cariLevelAttribute = '{{$product->LevelAttribute}}';
            var levelAttribute = cariLevelAttribute.split(",");
            $.each(levelAttribute, function(index,value){
                $('#kolomAttribute').append(`
                    <tr data-level="`+index+`">
                        <td>
                            <div class="form-group">
                                <select name="select-attribute[]" id="select-attribute`+index+`"  class="form-control input-select select-attribute" required>
                                    @foreach ($attribute as $item)
                                        <option value="{{$item->Attribute_Code}}" `+(value==`{{$item->Attribute_Code}}` ? "selected" : "")+`>{{$item->Attribute_Name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td colspan="2">
                            <div class="form-group">
                                <select name="Detail_Attribute[]" data-list="0" id="Detail_Attribute`+index+`" multiple="multiple" class="input-attribute detail-attribute form-control" required></select>
                            </div>
                        </td>
                    </tr>
                `);
    
                $('#level_attribute'+index+'').select2({
                    placeholder: 'Choose an attribute',
                    allowClear : true
                });     
    
                $('#detail_attribute'+index+'').select2({
                    tags: true,
                    allowClear : false,
                    tokenSeparators: [","],
                    createTag: function (tag) {
                        return {
                            id: tag.term,
                            text: tag.term,
                            // add indicator:
                            isNew : true
                        };
                    }
                }).on("select2:select", function(e) {
                    level=$(this).closest('select').attr('data-list');
                    value=e.params.data.id;
                    // loopDataVariant(level,value);
                    showButtonAddValue();
                }).on("select2:unselecting", function(e) {    
                    
                });
    
                //cari detail attribute
                var cariDetailAttribute = '{{$product->DetailAttribute}}';
                var cariDetailAttribute2 = cariDetailAttribute.split("-");
                // var detailAttribute = cariDetailAttribute2.split(",");
                var detailAttribute;
                $.each(cariDetailAttribute2, function(k,v){
                    if(index==k){
                        detailAttribute = v.split(",");
                    }
                });
    
                $.each(detailAttribute, function(k1,v1){
                    var newOption = new Option(v1, v1, true, true);
                    // Append it to the select
                    $("#Detail_Attribute"+index+"").append(newOption).trigger('change');
                });
    
            });
    
            var obj='{{$productVariant}}';
            var result=JSON.parse(obj.replace(/&quot;/g,'"'));
            $.each(result, function(index,value){
                var replaceCommas=value['Variant_Name'];
                // var variantName=replaceCommas.replace(/,/gi, ' / ');
                variantName = "";
                $('#tableVariant').append(`
                    <tbody class="tbodyHeader isOld">
                        <tr class="header">
                            <td>`+variantName+` <input type="hidden" class="input-detailVariant" value="`+value['ListVariant']+`"></td>
                            <td><input type="text" class="form-control input-detailVariant" name="Product_Barcode" onkeypress="return isNumberKey(event)" value="`+value['Product_BarCode']+`"></td>
                            <td>
                                <input type="text" class="form-control input-detailVariant" name="product_buyPrice" onkeypress="return isNumberKey(event)" value="`+value['product_buyPrice']+`">
                            </td>
                            <td>
                                <input type="text" class="form-control input-detailVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="`+value['Product_Price']+`">
                            </td>
                            <td class="text-center">
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch`+value+`" checked>
                                        <label class="custom-control-label" for="customSwitch`+value+`"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm" type="button">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <ul class="nav nav-tabs" id="myTab`+value['Variant_Code']+`" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="inventory`+value['Variant_Code']+`-tab" data-toggle="tab" href="#inventory`+value['Variant_Code']+`" role="tab" aria-controls="inventory" aria-selected="true">Inventory</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tax`+value['Variant_Code']+`-tab" data-toggle="tab" href="#tax`+value['Variant_Code']+`" role="tab" aria-controls="tax" aria-selected="false">Tax</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="price`+value['Variant_Code']+`-tab" data-toggle="tab" href="#price`+value['Variant_Code']+`" role="tab" aria-controls="price" aria-selected="false">Price</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent`+value['Variant_Code']+`">
                                    <div class="tab-pane fade show active" id="inventory`+value['Variant_Code']+`" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table class="table" width="100%">
                                                <thead>
                                                    <th>Outlet</th>
                                                    <th>Current Inventory</th>
                                                    <th>Re-order Quantity</th>
                                                </thead>
                                                <tbody>
                                                    <td>Main Outlet</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" disabled class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" id="Current`+value['Variant_Code']+`">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="input-detailVariant input-noVariant form-control" name="Reorder_Quantity" onkeypress="return isNumberKey(event)" id="Reorder`+value['Variant_Code']+`">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </div>
                                    <div class="tab-pane fade" id="tax`+value['Variant_Code']+`" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="cold-md-6">
                                                <div class="table-responsive">
                                                    <table class="table" width="100%">
                                                        <thead>
                                                            <th>Outlet</th>
                                                            <th>Tax</th>
                                                        </thead>
                                                        <tbody>
                                                            <td>Main Outlet</td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="number" class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" id="Tax`+value['Variant_Code']+`">
                                                                    <input type="hidden" class="form-control input-detailVariant input-noVariant" name="Variant_Code" onkeypress="return isNumberKey(event)" value="`+value['Variant_Code']+`">
                                                                </div>
                                                            </td>
                                                        </tbody>
                                                    </table>
                                                </div>        
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="price`+value['Variant_Code']+`" role="tabpanel" aria-labelledby="contact-tab">
                                        <div class="row">
                                            <div class="cold-md-6">
                                                <div class="table-responsive">
                                                    <table class="table tablePrice" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>Supply Price</td>
                                                                <td class="text-right" id="textSupplyPrice">Rp. 0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Markup Price</td>
                                                                <td><input type="number" class="form-control input-noVariant" id="Markup_Price"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                                                <td style="border-top:1px solid #dee2e6;">
                                                                    <input type="number" class="form-control input-noVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="0">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                `);
            function gantiValue(){
                document.getElementById("Current"+value['Variant_Code']+"").value=value['Current_Inventory'];
                document.getElementById("Reorder"+value['Variant_Code']+"").value=value['Reorder_Quantity'];
                document.getElementById("Tax"+value['Variant_Code']+"").value=value['Product_TaxRate'];
            }
            setTimeout(gantiValue, 1);
        });
        
        changeTotalVariant();
    
        }else{
            $('#kolomNoVariant').append(`
            <table class="table" width="100%">
                <thead>
                    <th>Outlet</th>
                    <th>Current Inventory</th>
                    <th>Re-order Quantity</th>
                </thead>
                <tbody>
                    <td>Main Outlet</td>
                    <td>
                        <div class="form-group">
                            <input type="number" disabled class="input-value input-noVariant form-control" name="Current_Inventory" id="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="number" class="input-value input-noVariant form-control" name="Reorder_Quantity" id="Reorder_Quantity" onkeypress="return isNumberKey(event)" value="0">
                        </div>
                    </td>
                </tbody>
            </table>
            `);
    
    
        }
            supplyPrice='{{1}}';
            function changeValue(){
                $("#Current_Inventory").val('{{1}}');
                $("#Reorder_Quantity").val('{{1}}');
                $("#Product_Price").val('{{1}}');
                $("#product_buyPrice").val('{{1}}');
                $("#Product_Tax").val('{{1}}');
                document.getElementById("textSupplyPrice").innerHTML=ribuan(supplyPrice);
                hideButton();
            }
            hargaproduct_buyPrice='{{1}}';
            hargaProduct_Price='{{1}}';
            
            
    
            setTimeout(changeValue,1);
    
    });
    
    
    // $(document).on('change','#category_code', function(){
    //     isModifier=$(this).find(':selected').attr('data-isModifier')
    //     if(isModifier==1){
    //         code=$('#product_code').val();
    //         $('#kolomModifier').empty();
    //         $('#kolomModifier').append(`
    //             <div class="form-group select-modifier">
    //                 <label for="">Choose Modifier</label>
    //                 <select class="select2bs4 form-control" id="modifier" name="modifier[]" multiple="multiple">
    //                     @foreach ($modifier as $item)
    //                         <option value="{{$item->modifier_code}}">{{$item->modifier_name}}</option>
    //                     @endforeach
    //                 </select>
    //             </div>
    //         `);
    
    //         $("#modifier").select2({
    //             placeholder: "Select a modifier"
    //         });
                
                
    //         var id=code;
    //         var urlModif = '{{ route("product.getModifier", ":id") }}';
    //             urlModif = urlModif.replace(':id', id);
    
    //         $.ajax({
    //             url:urlModif,
    //             data:id,
    //         }).done(function(data){
    //             var options = $('#modifier option');
    //             var setvalues = new Array();
    //             $.each(data, function( index, values ) {
    //                 setvalues.push(values.modifier_code);
    //             })
    //             $("#modifier").val(setvalues).trigger('change');
    //         });
    //         // $('#kolomModifier').empty();
    //     }else{
    //         $('#kolomModifier').empty();
    //     }
    // });

    $(document).on('change','#category_code', function(){
        isModifier=$(this).find(':selected').attr('data-isModifier')
        if(isModifier==1){
            // $('.select2bs4').val('').trigger('change');
            $('.select-modifier').removeClass('d-none');
            $('.select2bs4').select2({
                placeholder: "-- Select a modifier --"
            });
        }else{
            // $('.select2bs4').val('').trigger('change');
            $('.select-modifier').addClass('d-none');
        }
    });


    tag='{{$tag}}';
    var checkTag=JSON.parse(tag.replace(/&quot;/g,'"'));
    console.log( checkTag);
    // getTag=$(this).find(':selected').attr('data-role="tagsinput"')
    if(checkTag!=null){
            console.log(123);
            code=$('#product_code').val();
            // $('#tag_code').empty();
            // $('#tag_code').append(`
            //     <div class="form-group select-modifier">
            //         <label for="">Choose Modifier</label>
            //         <select class="select2bs4 form-control" id="modifier" name="modifier[]" multiple="multiple">
            //             @foreach ($modifier as $item)
            //                 <option value="{{$item->modifier_code}}">{{$item->modifier_name}}</option>
            //             @endforeach
            //         </select>
            //     </div>
            // `);
    

                
                
            var id=code;
            var urlModif = '{{ route("product.getModifier", ":id") }}';
                urlModif = urlModif.replace(':id', id);
    
            $.ajax({
                url:urlModif,
                data:id,
            }).done(function(data){
                var options = $('#modifier option');
                var setvalues = new Array();
                $.each(data, function( index, values ) {
                    setvalues.push(values.modifier_code);
                })
                $("#modifier").val(setvalues).trigger('change');
            });
            // $('#kolomModifier').empty();
        }else{
            $('#tag_code').empty();
        }
    $("#tag_code").select2({
            tags: true,
            placeholder: "Select Tags"
        });

    $('#brand_code').select2({
        placeholder: 'Select Brand',
        allowClear: true
    });
    
    $('#category_code').select2({
        placeholder: 'Select Category',
        allowClear: true
    });
    
    $('#supplier_code').select2({
        placeholder: 'Select Supplier',
        allowClear: true
    });
    
    function loopDataVariant(level=null,value){
        banyakLevel=$('#kolomAttribute').find('tr');
        if(banyakLevel.length==1){
            // $('.btn-addVariant').addClass('d-none');
            $('#tableVariant').append(`
            <tbody class="tbodyHeader">
                <tr class="header">
                    <td>`+value+` <input type="hidden" class="input-detailVariant" value="`+value+`"></td>
                    <td><input type="text" class="form-control input-detailVariant" name="Product_Barcode" onkeypress="return isNumberKey(event)"></td>
                    <td>
                        <input type="text" class="form-control input-detailVariant" name="product_buyPrice" onkeypress="return isNumberKey(event)" value="`+product_buyPrice+`">
                    </td>
                    <td>
                        <input type="text" class="form-control input-detailVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="`+Product_Price+`">
                    </td>
                    <td class="text-center">
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="customSwitch`+value+`" checked>
                                <label class="custom-control-label" for="customSwitch`+value+`"></label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm" type="button">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <ul class="nav nav-tabs" id="myTab`+value+`" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="inventory`+value+`-tab" data-toggle="tab" href="#inventory`+value+`" role="tab" aria-controls="inventory" aria-selected="true">Inventory</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tax`+value+`-tab" data-toggle="tab" href="#tax`+value+`" role="tab" aria-controls="tax" aria-selected="false">Tax</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="price`+value+`-tab" data-toggle="tab" href="#price`+value+`" role="tab" aria-controls="price" aria-selected="false">Price</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent`+value+`">
                            <div class="tab-pane fade show active" id="inventory`+value+`" role="tabpanel" aria-labelledby="home-tab">
                                <div class="table-responsive">
                                    <table class="table" width="100%">
                                        <thead>
                                            <th>Outlet</th>
                                            <th>Current Inventory</th>
                                            <th>Re-order Quantity</th>
                                        </thead>
                                        <tbody>
                                            <td>Main Outlet</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="number" class="input-detailVariant input-noVariant form-control" name="Reorder_Quantity" onkeypress="return isNumberKey(event)" value="0">
                                                </div>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>    
                            </div>
                            <div class="tab-pane fade" id="tax`+value+`" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="cold-md-6">
                                        <div class="table-responsive">
                                            <table class="table" width="100%">
                                                <thead>
                                                    <th>Outlet</th>
                                                    <th>Tax</th>
                                                </thead>
                                                <tbody>
                                                    <td>Main Outlet</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                                                        </div>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="price`+value+`" role="tabpanel" aria-labelledby="contact-tab">
                                <div class="row">
                                    <div class="cold-md-6">
                                        <div class="table-responsive">
                                            <table class="table tablePrice" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td>Supply Price</td>
                                                        <td class="text-right" id="textSupplyPrice">Rp. 0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Markup Price</td>
                                                        <td><input type="number" class="form-control input-detailVariant input-noVariant" id="Markup_Price"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                                        <td style="border-top:1px solid #dee2e6;">
                                                            <input type="number" class="form-control input-detailVariant input-noVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="0">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            `);
            
            changeTotalVariant();
        }else{
            $('.btn-addVariant').removeClass('d-none');
        }
    }
    
    $(document).on('click','.input-detailVariant',function(e){
    
    });
    
    $(document).on('click','.tescollapse .header',function(){
        $(this).toggleClass("openrow").nextUntil('.header').css('display', function(i, v) {
            return this.style.display === 'table-row' ? 'none' : 'table-row';
        });
    })
    
    // $(document).on('keyup','.select2-selection--multiple',function(){
    //     // $(this).closest('.form-group').find('.delete-attribute').addClass('d-none');
    // });
    
    function addAtrribute(){
        banyakAttribute=$('#kolomAttribute').length;
    }
    
    $('#select_attribute0').select2({
        placeholder: 'Choose an attribute',
        allowClear : true
    });
    var varian=false;
    $(document).on('click','#option1',function(){
        if(varian){
            $('.kolomNoVariant').removeClass('d-none');
            $('.input-noVariant').val('');
            varian=false;
        }
    });
    
    $(document).on('click','#option2',function(){
        if(!varian){
            $('.input-noVariant').val('');
            $('.kolomNoVariant').addClass('d-none');
            varian=true;
        }
    });
    
    $(document).ready(function(){
        $('input[type=number]').val('0');
    });
    
    listAttribute=99;
    $(document).on('click','.add-attribute',function(){
        $('#kolomAttribute').append(`
            <tr>
                <td>
                    <div class="form-group">
                        <select name="select-attribute[]" id="select-attribute`+listAttribute+`"  class="form-control input-select select-attribute" required>
                            @foreach ($attribute as $item)
                                <option value="{{$item->Attribute_Code}}">{{$item->Attribute_Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td>
                    <div class="form-group" style="display:flex; flex:wrap;">
                        <select name="Detail_Attribute[]" data-list="`+listAttribute+`" id="Detail_Attribute`+listAttribute+`" required class="input-attribute detail-attribute form-control" multiple="multiple" data-role="attributeinput"></select>
                        <button class="btn btn-secondary delete_attribute" id="delete`+listAttribute+`"  style="display:inline-block; margin-left:3px;" type="button"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
        `);
    
        // <button class="btn btn-secondary delete-attribute" id="delete`+listAttribute+`" type="button"><i class="fas fa-trash-alt"></i></button>
    
        $('#select-attribute'+listAttribute+'').select2({
            placeholder: 'Choose an attribute',
            allowClear : true
        });
        $('#select-attribute'+listAttribute+'').val('').trigger('change');
    
        $('#Detail_Attribute'+listAttribute+'').select2({
            tags: true,
            allowClear : false,
            tokenSeparators: [","],
            createTag: function (tag) {
                return {
                    id: tag.term,
                    text: tag.term,
                    // add indicator:
                    isNew : true
                };
            }
        }).on("select2:select", function(e) {
            level=$(this).closest('select').attr('data-list');
            value=e.params.data.id;
            // if(e.params.data.isNew){
            //     $(this).find('[value="'+e.params.data.id+'"]').replaceWith('<option selected value="'+e.params.data.id+'">'+e.params.data.text+'</option>');
            // }else{
                
            // }
            // addVariant(level,value);
            // loopDataVariant(level,value);
            showButtonAddValue();
        }).on("select2:unselecting", function(e) {    
            
        });
        listAttribute++;
    });
    
    dataLevel=[];
    var combine_array;
    $(document).on('click','.btn-openModalVariant',function(){
        dataLevel.splice(0);
        banyakLevel=$('#kolomAttribute').find('tr');
        
        $.each(banyakLevel, function(index,value){
            dataselect=$(this).find('.input-attribute').select2('data');
            if(dataselect.length>0){
                dataLevel.push(dataselect);
            }
        });
    
        $('#generateVariant').empty();
        combine_array = cartesian(dataLevel);
        $('#generateVariant').append(`
        Select the variants you want to use.
            <table class="table" style="width:100%;">
                <thead>
                    <tr>
                        <th style="vertical-align:middle; width:1%;"><br>
                            <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                    <input type="checkbox" checked="" class="checkVariant select-all" id="headercheck" >
                                    <label for="headercheck">
                                    </label>
                                </div>
                            </div>  
                        </th>
                        <th style="vertical-align:middle;">Variant Name</th>    
                    </tr>
                </thead>    
                <tbody id="daftarVariant">
                </tbody>
            </table>
        `);
        jumlah=0;
        $.each(combine_array,function(index,value){
            dataNama=[];
            $.each(value,function(i1,v1){
                dataNama.push(v1.text);
            });
            cek1=$('#tableVariant').find('.tbodyHeader.isOld');
            dataIsOld=false;
            $.each(cek1,function(index,value){
                cek2=$(this).find('.input-detailVariant')[0].value;
                cek3=dataNama.toString();
                if(cek3==cek2){
                    dataIsOld=true;
                }            
            });
            
            jumlah++;
            varian=dataNama.toString();
            namaVariant=dataNama.join(' / ');
            
            $('#daftarVariant').append(`
            <tr>
                <td style="text-align: center; vertical-align: middle; width:1%;">
                    <div class="form-group clearfix">
                        <div class="`+(dataIsOld==true ? "icheck-secondary" : "icheck-success")+` d-inline">
                            <input type="checkbox" `+(dataIsOld==true ? "disabled" : "")+` checked="" name="listVariant[]" class="checkVariant `+(dataIsOld==true ? "isOld" : "isNew")+`" id="checkboxSuccess`+index+`" value="`+varian+`">
                            <label for="checkboxSuccess`+index+`">
                            </label>
                        </div>
                    </div>   
                </td>    
                <td>
                    <img src="{{asset('img/no-image.png')}}" style="width:50px;" class="img-thumbnail">
                    &nbsp;
                    `+namaVariant+`  `+(dataIsOld==true ? "" : "<span class='badge badge-secondary'>New</span>")+`
                </td>    
            </tr>
            `)
        })
        cekJumlahIsNew();
        $('#variantModal').modal('show');
    });
    
    function cekJumlahIsNew(){
        var checkboxes = $('#daftarVariant').find('.isNew');
        var checkedboxes = checkboxes.filter(':checked');
        document.getElementById('jumlahVariant').innerHTML=checkedboxes.length;
    }
    
    $(document).on('change','#headercheck', function () {
        // $('#daftarVariant').find('input:checkbox').not(this).prop('checked', this.checked);
        cariCheckbox=$('#daftarVariant').find('input:checkbox').not(this);
        header=$('#headercheck').prop('checked');
        $.each(cariCheckbox, function(index,value){
            isDisabled=$(this).prop('disabled');
            // console.log(isDisabled);
            if(!isDisabled){   
                $(this).prop('checked', header); 
            }
        });
        cekJumlahIsNew();
    });
    
    $(document).on('change','.isNew', function() {
        var checkboxes = $('#daftarVariant').find('.isNew');
        var checkedboxes = checkboxes.filter(':checked');
    
        if(checkboxes.length === checkedboxes.length) {
            $('#headercheck').prop('checked', true);
        } else {
            $('#headercheck').prop('checked', false);
        }
    
        document.getElementById('jumlahVariant').innerHTML=checkedboxes.length;
    });
    
    function cartesian(dataLevel) {
        var r = [], arg = dataLevel, max = arg.length-1;
        function helper(arr, i) {
            for (var j=0, l=arg[i].length; j<l; j++) {
                var a = arr.slice(0); // clone arr
                a.push(arg[i][j])
                if (i==max) {
                    r.push(a);
                } else
                    helper(a, i+1);
            }
        }
        helper([], 0);
        return r;
    };
    
    
    $(document).on('click','.btn-addVariant',function(){
        // addVariantToTable(dataLevel,combine_array);
        var checkboxes = $('#daftarVariant').find('.isNew');
        $('#tableVariant').find('.tbodyHeader.isNew').remove();
        $.each(checkboxes, function(index,value){
            valueCheck=$(this).val();
            convert=valueCheck.replace(/,/g, ' / ');
            if(this.checked){
                $('#tableVariant').append(`
                <tbody class="tbodyHeader isNew">
                    <tr class="header">
                        <td>
                            `+convert+`
                            <input type="hidden" value="`+valueCheck+`" class="input-detailVariant">
                        </td>
                        <td>
                            <input type="text" class="form-control input-detailVariant" name="Product_Barcode" onkeypress="return isNumberKey(event)">
                        </td>
                        <td>
                            <input type="text" class="form-control input-detailVariant" name="product_buyPrice" onkeypress="return isNumberKey(event)" value="`+hargaproduct_buyPrice+`">
                        </td>
                        <td>
                            <input type="text" class="form-control input-detailVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="`+hargaProduct_Price+`">
                        </td>
                        <td class="text-center">
                            <div class="form-group">
                                <div class="custom-control custom-switch custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch`+index+`" checked>
                                    <label class="custom-control-label" for="customSwitch`+index+`"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm" type="button">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <ul class="nav nav-tabs" id="myTab`+index+`" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="inventory`+index+`-tab" data-toggle="tab" href="#inventory`+index+`" role="tab" aria-controls="inventory" aria-selected="true">Inventory</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tax`+index+`-tab" data-toggle="tab" href="#tax`+index+`" role="tab" aria-controls="tax" aria-selected="false">Tax</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="price`+index+`-tab" data-toggle="tab" href="#price`+index+`" role="tab" aria-controls="price" aria-selected="false">Price</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent`+index+`">
                                <div class="tab-pane fade show active" id="inventory`+index+`" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table class="table" width="100%">
                                            <thead>
                                                <th>Outlet</th>
                                                <th>Current Inventory</th>
                                                <th>Re-order Quantity</th>
                                            </thead>
                                            <tbody>
                                                <td>Main Outlet</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" class="input-detailVariant input-noVariant form-control" name="Reorder_Quantity" onkeypress="return isNumberKey(event)" value="0">
                                                    </div>
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>    
                                </div>
                                <div class="tab-pane fade" id="tax`+index+`" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="cold-md-6">
                                            <div class="table-responsive">
                                                <table class="table" width="100%">
                                                    <thead>
                                                        <th>Outlet</th>
                                                        <th>Tax</th>
                                                    </thead>
                                                    <tbody>
                                                        <td>Main Outlet</td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="number" class="input-detailVariant input-noVariant form-control" name="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                                                            </div>
                                                        </td>
                                                    </tbody>
                                                </table>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="price`+index+`" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row">
                                        <div class="cold-md-6">
                                            <div class="table-responsive">
                                                <table class="table tablePrice" width="100%">
                                                    <tbody>
                                                        <tr>
                                                            <td>Supply Price</td>
                                                            <td class="text-right" id="textSupplyPrice">Rp. 0</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Markup Price</td>
                                                            <td><input type="number" class="form-control input-detailVariant input-noVariant" id="Markup_Price"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                                            <td style="border-top:1px solid #dee2e6;">
                                                                <input type="number" class="form-control input-detailVariant input-noVariant" name="Product_Price" onkeypress="return isNumberKey(event)" value="0">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                `);
               
            }else{
                console.log(2);
            }
        });
        $('#variantModal').modal('toggle');
        changeTotalVariant();
        showButtonAddValue();
    });
    
    // $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    
    $(document).on('click','.delete+attribute', function(){
        $(this).closest('tr').remove();
    });
    
    variantGlobalName='';
    $(document).on('keypress','.bootstrap-tagsinput',function(e){
        checkLabel=$(this).closest('.form-group').find('label');
        level=$(this).closest('.form-group').find('select').attr('data-list');
        value=$(this).closest('.form-group').find('.input-attribute').val();
        if(checkLabel.length==0){
            if (e.which === 13 || e.which === 44 ) {
                rowAttribute(level,variantGlobalName);             
            }
        }
    });
    
    function backToIndex(){
        url='{{route('product.index')}}';
        window.location.href=url;
    }
    
    function changeTotalVariant(){
        banyakVariant=$('#tableVariant').find('.tbodyHeader');
        if(banyakVariant.length>1){
            document.getElementById('totalVariant').innerHTML="This product has "+banyakVariant.length+" variants.";
        }else{
            document.getElementById('totalVariant').innerHTML="This product has "+banyakVariant.length+" variant.";
        }
    }
    
    $(document).on('click','.btn-submit', function(){
        var checkrequired = $('input,textarea,select').filter('[required]:visible')
        var isValid = true;
        $(checkrequired).each( function() {
                  if ($(this).parsley().validate() !== true) isValid = false;
        });
    
        if(!isValid){
          return;
        }
        
        var form=$('#form');
        url="{{route('product.store')}}";
        product_code=$('#product_code').val();
        product_name=$('#product_name').val();
        Product_Picture=$('#Product_Picture');
        brand_code=$('#brand_code').val();
        category_code=$('#category_code').val();
        Modifier=$('#Modifier').val();
        Tag_Code=$('#Tag_Code').val();
        Options=$("input[name=options]").val();
        supplier_code=$('#supplier_code').val();
        product_buyPrice=$('#product_buyPrice').val();
        Current_Inventory=$('#Current_Inventory').val();
        Reorder_Quantity=$('#Reorder_Quantity').val();
        Product_Tax=$('#Product_Tax').val();
        Product_Price=$('#Product_Price').val();
        cariAttr=$('#kolomAttribute').find('.detail-attribute');
        Attribute=$('#kolomAttribute').find('.select-attribute');
        rowVariant=$("#tableVariant").find('.tbodyHeader');
    
        levelattr=[];
        $.each(Attribute,function(index,value){
            levelattr.push($(this).val());
        });
    
        detailattr=[];
        $.each(cariAttr,function(index,value){
            detailattr.push($(this).val());
        });    
    
        listVariant=[];
        $.each(rowVariant,function(index,value){
            listValue=$(this).find('.input-detailVariant');
            listVariant.push({
                "ValueCheck":listValue[0].value,
                "Product_Barcode":listValue[1].value,
                "product_buyPrice":listValue[2].value,
                "Product_Price":listValue[3].value,
                "Current_Inventory":listValue[4].value,
                "Reorder_Quantity":listValue[5].value,
                "Product_Tax":listValue[6].value,
                "Variant_Code":listValue[7].value,
            });
        }); 
        
        $.ajax({
            url:url,
            data:{
                "product_code":product_code,
                "product_name":product_name,
                "brand_code":brand_code,
                "category_code":category_code,
                "Tag_Code":Tag_Code,
                "Modifier":Modifier,
                "Options":Options,
                "supplier_code":supplier_code,
                "product_buyPrice":product_buyPrice,
                "Current_Inventory":Current_Inventory,
                "Reorder_Quantity":Reorder_Quantity,
                "Product_Tax":Product_Tax,
                "Product_Price":Product_Price,
                "LevelAttribute":levelattr,
                "DetailAttribute":detailattr,
                "listVariant":listVariant,
            },
            type:'post',
        }).done(function(data){
            suksesEditProduct();
            function done(){
                urlIndex="{{route('product.index')}}";
                window.location.href=urlIndex;
            }
            setTimeout(done,500);
        }).fail(function(){
            gagalEditProduct();
        });
    });
    
    
    function suksesEditProduct(){
        Swal.fire(
        'Success!',
        'Success Edit Product!',
        'success'
        )
        // "{{session()->put('suksesEditProduct','sukses')}}";
    }
    
    function gagalEditProduct(){
        Swal.fire(
        'Failed :(',
        'Failed to Edit Product!',
        'error'
        )
    }
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function showButtonAddValue(){
        dataVariant1=[];
        banyakLevel=$('#kolomAttribute').find('tr');
        
        $.each(banyakLevel, function(index,value){
            dataselect=$(this).find('.input-attribute').select2('data');
            if(dataselect.length>0){
                dataVariant1.push(dataselect);
            }
        });
    
        combine_array = cartesian(dataVariant1);
        console.log(combine_array);
    
        $.each(combine_array,function(index,value){
            dataVariant2=[];
            $.each(value,function(i1,v1){
                dataVariant2.push(v1.text);
            });
            cek1=$('#tableVariant').find('.tbodyHeader');
            dataVariantIsNew=true;
            $.each(cek1,function(index,value){
                cek2=$(this).find('.input-detailVariant')[0].value;
                cek3=dataVariant2.toString();
                if(cek3==cek2){
                    dataVariantIsNew=false;
                }            
    
            });
        });
    
        if(dataVariantIsNew){
            $('.btn-openModalVariant').removeClass('d-none');
        }else{
            $('.btn-openModalVariant').addClass('d-none');
        }
        
    }
    
    //edit
    
    function hapusVariant(cekLevel,data){
        cek1=$('#tableVariant').find('.tbodyHeader');
        $.each(cek1,function(){
            cek2=$(this).find('.input-detailVariant')[0].value;
            cek4=cek2.split(",");
            if(cek4[cekLevel].toString()==data){
                $(this).closest('.tbodyHeader').remove();
            }
        });
        changeTotalVariant();
    }
    
    </script>
    