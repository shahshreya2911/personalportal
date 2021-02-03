<tr>
    <td style="width: 40px;">
       {{ $product->productname }}
    </td>
    <td class="align-middle">
        {{ $product->brandname }}
    </td>
    <td class="align-middle">{{ $product->notes }}</td>
   
    <td class="text-center align-middle">
        <a href="{{ route('product.edit', $product->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_pro')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('product.delete', $product->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_pro')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_pro')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>