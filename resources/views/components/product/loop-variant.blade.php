<tbody class="tbodyHeader">
    <tr class="header">
        <td>`+value+` <input type="hidden" class="input-detailVariant" value="`+value+`"></td>
        <td><input type="text" class="form-control input-detailVariant" name="product_barcode" onkeypress="return isNumberKey(event)" required></td>
        <td>
            <input type="text" class="form-control input-detailVariant" name="product_buyPrice" onkeypress="return isNumberKey(event)" value="`+hargaProduct_BuyPrice+`">
        </td>
        <td>
            <input type="text" class="form-control input-detailVariant" name="product_price" onkeypress="return isNumberKey(event)" value="`+hargaProduct_Price+`">
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
            <button class="btn btn-danger btn-sm btn-tableVariant" type="button">
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
                                                <input type="number" class="input-detailVariant input-noVariant form-control" name="current_inventory" onkeypress="return isNumberKey(event)" value="0">
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