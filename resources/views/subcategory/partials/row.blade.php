<tr>
    <td style="width: 40px;">
       {{ $subcat->name }}
    </td>
     <td style="width: 40px;">
       {{ $subcat->category }}
    </td>
     <td style="width: 40px;">
       <img src="{{ asset('images/'.$subcat->image) }}" height="30px" width="30px"> 
    </td>
    <td style="width: 40px;">
       {{ $subcat->description }}
    </td>
    
   
    <td class="text-center align-middle">
        <a href="{{ route('subcat.edit', $subcat->id) }}"
           class="btn btn-icon edit"
           title="Edit Subcategory"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('subcat.delete', $subcat->id) }}"
           class="btn btn-icon"
           title="Delete Subcategory"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="Are you sure You Want to Delete SUb Category"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>