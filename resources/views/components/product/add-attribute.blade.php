<tr class="addAttribute">
    <td>
        <div class="form-group">
            <select name="level_attribute[]" id="level_attribute`+listAttribute+`"  class="form-control input-select level_attribute" required>
                @foreach ($attribute as $item)
                    <option value="{{$item->attribute_code}}">{{$item->attribute_name}}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="form-group" style="display:flex; flex:wrap;">
            <select name="detail_attribute[]" data-list="`+listAttribute+`" id="detail_attribute`+listAttribute+`"  required class="input-attribute detail_attribute form-control" multiple="multiple" data-role="attributeinput"></select>
            <button class="btn btn-secondary delete_attribute" id="delete`+listAttribute+`"  style="display:inline-block; margin-left:3px;" type="button"><i class="fas fa-trash-alt"></i></button>
        </div>
    </td>
</tr>