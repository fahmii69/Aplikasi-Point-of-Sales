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
        tokenSeparators: [',', ' '],
        selectOnClose: true,
    });

    $('#supplier_code').select2({
        placeholder: '-- Select Supplier -- ',
        allowClear: true,
    });

    $('#Shop_Tax').select2({
        width: 'auto'
    });
    
    
    
    $(document).on('click','.tescollapse .header',function(){
        $(this).toggleClass("openrow").nextUntil('.header').css('display', function(i, v) {
            return this.style.display === 'table-row' ? 'none' : 'table-row';
        });
    })
    
    $(document).on('keyup','.select2-selection--multiple',function(){
        $(this).closest('.form-group').find('.delete-attribute').addClass('d-none');
    });
    
    function addAtrribute(){
        banyakAttribute=$('#kolomAttribute').length;
    }
    
    var varian=false;
    $(document).on('click','#option1',function(){
        if(varian){
            // $('.input-noVariant').val('');
            varian=false;
            $('#kolomVariant').empty();
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
                                <input type="number" class="input-value input-noVariant form-control" required name="Current_Inventory" id="Current_Inventory" onkeypress="return isNumberKey(event)" value="0">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="number" class="input-value input-noVariant form-control" required name="Reorder_Quantity" id="Reorder_Quantity" onkeypress="return isNumberKey(event)" value="0">
                            </div>
                        </td>
                    </tbody>
                </table>
            `);
        }
    });
    

    
    $(document).ready(function(){
        $('input[type=number]').val('0');
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
    
    // console.log(cartesian([8,10], ['merah','kuning'], ['katun','kanvas'],['tes1','tes2']));
    
    
    $(document).on('click','.delete-attribute', function(){
        $(this).closest('tr').remove();
    });
    
    $("select").on("select2:select", function (evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    });
    
    $(document).on("keydown", ".input-value", function(event) { 
        return event.key != "Enter";
    });
    
    function backToIndex(){
        url='{{route('product.index')}}';
    
        window.location.href=url;
    }
    
    hargaProduct_BuyPrice=0;
    hargaProduct_Price=0;
    

    
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
    $(document).on('keyup','#Product_BuyPrice', function(){
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
    
    $(document).on('keyup','#Markup_Price',function(){
        changePrice();
    });
    
    function changePrice(){
        buyPrice=$("#Product_BuyPrice").val();
        markupPrice=$("#Markup_Price").val();
        if(!markupPrice){markupPrice=0;}
        if(!buyPrice){buyPrice=0;}
        hasilMarkup=parseFloat(buyPrice)+((parseFloat(buyPrice)*parseFloat(markupPrice))/100);
        hargaProduct_BuyPrice=parseFloat(buyPrice);
        hargaProduct_Price=parseFloat(hasilMarkup);
        cariMarkup=(parseFloat(hasilMarkup*100)/parseFloat(buyPrice))/100;
    
        console.log(cariMarkup);
        $('#Product_Price').val(hasilMarkup);
        // $('#Markup_Price').val(cariMarkup);
    }
    
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
        
    }
    
    
    </script>