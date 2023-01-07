<hr>
<strong>Variants</strong>
<div class="row">
    <div class="col-md-4">
        <p>Choose up to three variable attributes for this product to create and manage Barcode Code's and their inventory levels.</p>
        <br>
    </div>
    <div class="col-md-8">
        <table class="table" width="100%">
            <thead>
                <th width="1%;">Attribute&nbsp;(e.g.&nbsp;Colour)</th>
                <th colspan="2">Value (e.g. Red, Blue, Green) </th>
            </thead>
            <tbody id="kolomAttribute">
                <tr>
                    <td>
                        <div class="form-group">
                            <select name="level_attribute[]" id="level_attribute0"  class="form-control input-select level_attribute" required>
                                @foreach ($attribute as $item)
                                    <option value="{{$item->attribute_code}}">{{$item->attribute_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td colspan="2">
                        <div class="form-group">
                            <select name="detail_attribute[]" data-list="0" id="detail_attribute0" multiple="multiple" class="input-attribute detail_attribute form-control" required></select>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="border-top:0px;">
                        <a class="text-success add-attribute pointer"><i class="fas fa-plus-square"></i> Add another attribute</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-top:0px;">
                        <button class="btn-success btn float-right btn-openModalVariant d-none" type="button">Done</button>
                    </td>
                </tr>
            </tfoot>
        </table>
        <h5>
            <strong id="totalVariant">This product has 0 variant.</strong>
        </h5>
        <div class="table-responsive">
            <table class="table tescollapse" width="100%" id="tableVariant">
                <thead>
                    <th width="300px;">Variant Name</th>
                    <th>Barcode Code</th>
                    <th>Supply Price</th>
                    <th>Retail Price
                        <br>
                        <small>
                            Excluding Tax
                        </small>
                    </th>
                    <th width="1%;">
                        Enabled
                    </th>
                    <th width="1%;"></th>
                </thead>
            </table>
        </div>

    </div>
</div>