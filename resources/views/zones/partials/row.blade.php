<tr>
    <td style="width: 40px;">
       {{ $zones->warehouse }}
    </td>
    <td class="align-middle">
        {{ $zones->room }}
    </td>
    <td class="align-middle">{{ $zones->room }}</td>
   
    <td class="text-center align-middle">
        <a href="{{ route('zone.edit', $zones->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_zone')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('zone.delete', $zones->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_zone')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_zone')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>