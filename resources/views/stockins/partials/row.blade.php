<tr>
    <td style="width: 40px;">
       {{ $stockin->stockin_date }}
    </td>
     <td style="width: 40px;">
       {{ auth()->user()->present()->nameOrEmail }}
    </td>
     <td style="width: 40px;">
       {{ $stockin->job }}
    </td>
    <td class="align-middle">{{ $stockin->reason }}</td>
    <td class="align-middle">
        {{ $stockin->notes }}
    </td>
    
   
    <td class="text-center align-middle">
        <a href="{{ route('stockin.edit', $stockin->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_stockin')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('stockin.delete', $stockin->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_stockin')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_stockin')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>