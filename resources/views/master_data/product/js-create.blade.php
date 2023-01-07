<script type="text/javascript">
    isInput=false;
    
    $(document).ready(function(){
        // $('.input-value').val('');
        $('.input-select').val('').trigger('change');
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
        $('.select2bs4').select2({
            placeholder: "-- Select a modifier --"
        });
    });
    
    $(document).on('change','#category_code', function(){
        isModifier=$(this).find(':selected').attr('data-isModifier')
        if(isModifier==1){
            $('.select2bs4').val('').trigger('change');
            $('.select-modifier').removeClass('d-none');
            $('.select2bs4').select2({
                placeholder: "-- Select a modifier --"
            });
        }else{
            $('.select2bs4').val('').trigger('change');
            $('.select-modifier').addClass('d-none');
        }
    });
    
    $('#brand_code').select2({
        placeholder: '-- Select Brand --',
        allowClear: true
    });
    
    $('#category_code').select2({
        placeholder: '-- Select Category --',
        allowClear: true
    });

    $('#tag_code').select2({
        tags: true,
        tokenSeparators: [','],
        // selectOnClose: true,
        // allowClear: true,

    });

    $('#supplier_code').select2({
        placeholder: '-- Select Supplier -- ',
        allowClear: true,
    });
        
    // $(document).on('keyup','.select2-selection--multiple',function(){
    //     $(this).closest('.form-group').find('.delete_attribute').addClass('d-none');
    // });


    
    // function addAtrribute(){
    //     banyakAttribute=$('#kolomAttribute').length;
    // }
    
    $(document).ready(function(){
        $('input[type=number]').val('0');
    });

    listAttribute=1;
    $(document).on('click','.add-attribute',function(){
        html = `{!! $html !!}`
        $('#kolomAttribute').append(html);

        $('#level_attribute'+listAttribute+'').select2({
            placeholder: 'Choose an attribute',
            allowClear : true
        });
        $('#level_attribute'+listAttribute+'').val('').trigger('change');

        $('#detail_attribute'+listAttribute+'').select2({
            tags: true,
            tokenSeparators: [',', ' '],
            selectOnClose: true,    
        }).on("select2:select", function(e) {
            level=$(this).closest('select').attr('data-list');
            value=e.params.data.id;
            // if(e.params.data.isNew){
            //     $(this).find('[value="'+e.params.data.id+'"]').replaceWith('<option selected value="'+e.params.data.id+'">'+e.params.data.text+'</option>');
            // }else{
                
            // }
            // addVariant(level,value);
            loopDataVariant(level,value);
            showButtonAddValue();
        }).on("select2:unselecting", function(e) {    
            
        });
        listAttribute++;
    });

    $(document).on('click', '.delete_attribute', function () {
            $(this).closest('.addAttribute').remove();
        })

    // function addVariantToTable(dataLevel,combine_array){
    // }
        
    // console.log(cartesian([8,10], ['merah','kuning'], ['katun','kanvas'],['tes1','tes2']));

    // variantGlobalName='';
    // $(document).on('keypress','.bootstrap-tagsinput',function(e){
    //     checkLabel=$(this).closest('.form-group').find('label');
    //     level=$(this).closest('.form-group').find('select').attr('data-list');
    //     value=$(this).closest('.form-group').find('.input-attribute').val();
    //     if(checkLabel.length==0){
    //         if (e.which === 13 || e.which === 44 ) {
    //             rowAttribute(level,variantGlobalName);             
    //         }
    //     }
    // });
    
    // $("select").on("select2:select", function (evt) {
    //     var element = evt.params.data.element;
    //     var $element = $(element);
    //     $element.detach();
    //     $(this).append($element);
    //     $(this).trigger("change");
    // });
    
    // $(document).on("keydown", ".input-value", function(event) { 
    //     return event.key != "Enter";
    // });
    
    hargaProduct_BuyPrice=0;
    hargaProduct_Price=0;
    
    function changeTotalVariant(){
        banyakVariant=$('#tableVariant').find('.tbodyHeader');
        if(banyakVariant.length>1){
            document.getElementById('totalVariant').innerHTML="This product has "+banyakVariant.length+" variants.";
        }else{
            document.getElementById('totalVariant').innerHTML="This product has "+banyakVariant.length+" variant.";
        }
    }

    $(document).on('click','.btn-submit', function(){
        // var checkrequired = $('input,textarea,select').filter('[required]:visible')
        // var isValid = true;
        // $(checkrequired).each( function() {
        //         if ($(this).parsley().validate() !== true) isValid = false;
        // });

        // if(!isValid){
        // return;
        // }
        
        var form            = $('#form');
            url             = "{{ $action }}";
            product_name    = $('#product_name').val();
            product_picture = $('#product_picture');
            brand_code      = $('#brand_code').val();
            category_code   = $('#category_code').val();
            modifier_code   = $('#modifier_code').val();
            tag_code        = $('#tag_code').val();
        if(varian){
            options=1;
        }else{
            options=0;
        }
        supplier_code     = $('#supplier_code').val();
        product_buyPrice  = $('#product_buyPrice').val();
        current_inventory = $('#current_inventory').val();
        reorder_quantity  = $('#reorder_quantity').val();
        product_tax       = $('#product_tax').val();
        product_price     = $('#product_price').val();
        attribute         = $('#kolomAttribute').find('.level_attribute');
        cariAttr          = $('#kolomAttribute').find('.detail_attribute');
        rowVariant        = $("#tableVariant").find('.tbodyHeader');

        levelattr=[];
        $.each(attribute,function(index,value){
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
                "ValueCheck"       : listValue[0].value,
                "product_barcode"  : listValue[1].value,
                "product_buyPrice" : listValue[2].value,
                "product_price"    : listValue[3].value,
                "current_inventory": listValue[4].value,
                "reorder_quantity" : listValue[5].value,
                "product_tax"      : listValue[6].value,
            });
        }); 
        
        $.ajax({
            url:url,
            data:{
                "product_name"     : product_name,
                "brand_code"       : brand_code,
                "category_code"    : category_code,
                "tag_code"         : tag_code,
                "modifier_code"    : modifier_code,
                "options"          : options,
                "supplier_code"    : supplier_code,
                "product_buyPrice" : product_buyPrice,
                "current_inventory": current_inventory,
                "reorder_quantity" : reorder_quantity,
                "product_tax"      : product_tax,
                "product_price"    : product_price,
                "level_attribute"  : levelattr,
                "detail_attribute" : detailattr,
                "variant_list"     : listVariant,
            },
            type:'post',
        }).done(function(data){
            // suksesAddProduct();
            // function done(){
            //     urlIndex="{{route('product.index')}}";
            //     window.location.href=urlIndex;
            // }
            // setTimeout(done,500);
        }).fail(function(data){
            // gagalAddProduct();

            console.log(data)
        });
    });
    
    function gagalAddProduct(){
        Swal.fire(
        'Failed :(',
        'Failed to Add New Product!',
        'error'
        )
    }
    
    function suksesAddProduct(){
        Swal.fire(
        'Success!',
        'Success Add New Product!',
        'success'
        )
    }
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    
    //edit
    $(document).on('keyup','#product_buyPrice', function(){
        value=$(this).val();
        if(!value){
            value=0;
        }
        changePrice();
        document.getElementById("textSupplyPrice").innerHTML=ribuan(value);
    });
    
    $(document).on('change','.input-number',function(){
        if(!this.value){
            value=0;
            $(this).val(value);
        }
    });
    
    $(document).on('keyup','#markup_price',function(){
        changePrice();
    });
    
    function changePrice(){
        buyPrice=$("#product_buyPrice").val();
        markupPrice=$("#markup_price").val();
        if(!markupPrice){markupPrice=0;}
        if(!buyPrice){buyPrice=0;}
        hasilMarkup=parseFloat(buyPrice)+((parseFloat(buyPrice)*parseFloat(markupPrice))/100);
        hargaProduct_BuyPrice=parseFloat(buyPrice);
        hargaProduct_Price=parseFloat(hasilMarkup);
        cariMarkup=(parseFloat(hasilMarkup*100)/parseFloat(buyPrice))/100;
    
        console.log(cariMarkup);
        $('#product_price').val(hasilMarkup);
        // $('#Markup_Price').val(cariMarkup);
    }
        
</script>