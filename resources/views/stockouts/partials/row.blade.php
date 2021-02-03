<tr>
    <td style="width: 40px;">
       {{ $stockout->stockout_date }}
    </td>
     <td style="width: 40px;">
       {{ auth()->user()->present()->nameOrEmail }}
    </td>
     <td style="width: 40px;">
       {{ $stockout->job }}
    </td>
    <td class="align-middle">{{ $stockout->reason }}</td>
    <td class="align-middle">
        {{ $stockout->notes }}
    </td>
    
   
    <td class="text-center align-middle">
        <a href="{{ route('stockout.edit', $stockout->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_stockout')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('stockout.delete', $stockout->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_stockout')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_stockout')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>