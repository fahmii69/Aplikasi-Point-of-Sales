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
        $('#generateVariant').append(`<x-product.generate-variant/>`);
        jumlah=0;
        $.each(combine_array,function(index,value){
            jumlah++;
            // console.log(this.toString().replace(',',' / '));
            varian=this;
            namaVariant=this.join(' / ');
            
            $('#daftarVariant').append(`<x-product.daftar-variant/>`)
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

            var checkboxes = $('#daftarVariant').find('.checkboxlistitem');
            $('#tableVariant').find('tbody').remove();
            $.each(checkboxes, function(index,value){
                valueCheck=$(this).val();
                convert=valueCheck.replace(/,/g, ' / ');

                if(this.checked){
                    $('#tableVariant').append(`<x-product.table-variant/>`);
                }else{
                    console.log(2);
                }
            });
            $('#variantModal').modal('toggle');
            changeTotalVariant();
            showButtonAddValue();
        });
    
    }

    $(document).on('click','.delete_attribute', function(){
            $(this).closest('tr').remove();
        });

        $(document).on('click','.btn-tableVariant', function(){
            console.log(123);
            $(this).closest('tbody').remove();
            changeTotalVariant()
        }); 

</script>