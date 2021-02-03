<tr>
    <td style="width: 40px;">
       {{ $cat->id }}
    </td>

    <td style="width: 40px;">
       {{ $cat->name }}
    </td>
    
   
    <td class="text-center align-middle">
        <a href="{{ route('category.edit', $cat->id) }}"
           class="btn btn-icon edit"
           title="Edit Category"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('category.delete', $cat->id) }}"
           class="btn btn-icon"
           title="Delete Category"
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