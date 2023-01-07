<script type="text/javascript">

    var varian=false;
    $(document).on('click','#option0',function(){
        if(varian){
            varian=false;
            $('#kolomVariant').empty();
            $('#kolomNoVariant').append(`<x-product.kolom-option0/>
            `);
        }
    });

    $(document).on('click','#option1',function(){
        if(!varian){
            $('.input-noVariant').val('');
            varian=true;
            $('#kolomNoVariant').empty();
            $('#kolomVariant').append(`{!! $option1 !!}
            `);

            $('#level_attribute0').select2({
                placeholder: 'Choose an attribute',
                allowClear : true
            });

            $('#level_attribute0').val('').trigger('change');

            $('#detail_attribute0').select2({
                tags           : true,
                tokenSeparators: [',', ' '],
                selectOnClose  : true,
            }).on("select2:select", function(e) {
                level=$(this).closest('select').attr('data-list');
                value=e.params.data.id;
                loopDataVariant(level,value);
                showButtonAddValue();
            }).on("select2:unselecting", function(e) {    
                
            });
        }
    });

    function loopDataVariant(level=null,value){
        banyakLevel=$('#kolomAttribute').find('tr');
        if(banyakLevel.length==1){
            // $('.btn-addVariant').addClass('d-none');
            $('#tableVariant').append(`<x-product.loop-variant/>`);
    
            changeTotalVariant();
        }else{
            $('.btn-addVariant').removeClass('d-none');
        }
    }

    $(document).on('click','.tescollapse .header',function(){
        $(this).toggleClass("openrow").nextUntil('.header').css('display', function(i, v) {
            return this.style.display === 'table-row' ? 'none' : 'table-row';
        });
    })

    $(document).on('click','.input-detailVariant',function(e){

    });

    dataLevel=[];
    var combine_array;
    $(document).on('click','.btn-openModalVariant',function(){
        dataLevel.splice(0);
        banyakLevel=$('#kolomAttribute').find('tr');
        console.log(banyakLevel);

        
        $.each(banyakLevel, function(index,value){
            dataselect=$(this).find('.input-attribute').val();
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
                                    <input type="checkbox" checked="" class="checkVariant select-all" id="headercheck">
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
            jumlah++;
            // console.log(this.toString().replace(',',' / '));
            varian=this;
            namaVariant=this.join(' / ');
            
            $('#daftarVariant').append(`
            <tr>
                <td style="text-align: center; vertical-align: middle; width:1%;">
                    <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                            <input type="checkbox" checked="" name="variant_list[]" class="checkVariant checkboxlistitem" id="checkboxSuccess`+index+`" value="`+varian+`">
                            <label for="checkboxSuccess`+index+`">
                            </label>
                        </div>
                    </div>   
                </td>    
                <td>
                    <img src="{{ asset('AdminLTE/dist/img/boxed-bg.png') }}" style="width:50px;" class="img-thumbnail">
                    &nbsp;
                    `+namaVariant+`  <span class="badge badge-secondary">New</span>
                </td>    
            </tr>
            `)
        })

        // document.getElementById('jumlahVariant').innerHTML=jumlah;
        $('#variantModal').modal('show');
    });

    $(document).on('change','#headercheck', function () {
        $('#daftarVariant').find('input:checkbox').not(this).prop('checked', this.checked);
        var checkboxes = $('#daftarVariant').find('.checkboxlistitem');
        var checkedboxes = checkboxes.filter(':checked');
        document.getElementById('jumlahVariant').innerHTML=checkedboxes.length;
    });
    
    $(document).on('change','.checkboxlistitem', function() {
        var checkboxes = $('#daftarVariant').find('.checkboxlistitem');
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

    function showButtonAddValue(){
        dataVariant1=[];
        banyakLevel=$('#kolomAttribute').find('tr');
        
        $.each(banyakLevel, function(index,value){
            dataselect=$(this).find('.input-attribute').select2('data');
            dataVariant1.push(dataselect);
        });
    
        combine_array = cartesian(dataVariant1);
    
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

        $(document).on('click','.btn-addVariant',function(){
            // addVariantToTable(dataLevel,combine_array);
            var checkboxes = $('#daftarVariant').find('.checkboxlistitem');
            $('#tableVariant').find('tbody').remove();
            $.each(checkboxes, function(index,value){
                valueCheck=$(this).val();
                convert=valueCheck.replace(/,/g, ' / ');
                if(this.checked){
                    $('#tableVariant').append(`
                    <tbody class="tbodyHeader">
                        <tr class="header">
                            <td>
                                `+convert+`
                                <input type="hidden" value="`+valueCheck+`" class="input-detailVariant">
                            </td>
                            <td>
                                <input type="text" class="form-control input-detailVariant" name="product_barcode" onkeypress="return isNumberKey(event)">
                            </td>
                            <td>
                                <input type="text" class="form-control input-detailVariant" name="product_buyPrice" onkeypress="return isNumberKey(event)" value="`+hargaProduct_BuyPrice+`">
                            </td>
                            <td>
                                <input type="text" class="form-control input-detailVariant" name="product_price" onkeypress="return isNumberKey(event)" value="`+hargaProduct_Price+`">
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
                                                            <input type="number" class="input-detailVariant input-noVariant form-control" name="current_inventory" onkeypress="return isNumberKey(event)" value="0">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="input-detailVariant input-noVariant form-control" name="reorder_quantity" onkeypress="return isNumberKey(event)" value="0">
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
                                                                <td><input type="number" class="form-control input-detailVariant input-noVariant" id="markup_price"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border-top:1px solid #dee2e6;">Retail Price</td>
                                                                <td style="border-top:1px solid #dee2e6;">
                                                                    <input type="number" class="form-control input-detailVariant input-noVariant" name="product_price" onkeypress="return isNumberKey(event)" value="0">
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
    
    $(document).on('click','.delete_attribute', function(){
        $(this).closest('tr').remove();
    });
        
    }

</script>