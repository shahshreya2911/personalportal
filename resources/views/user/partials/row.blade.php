<tr>
    <td style="width: 40px;">
     
    </td>
    <td class="align-middle">
        <a href="{{ route('user.show', $user->id) }}">
            {{ $user->username ?: trans('app.n_a') }}
        </a>
    </td>
  
  
    <td class="text-center align-middle">
      

        <a href="{{ route('user.edit', $user->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_user')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('user.delete', $user->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_user')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_user')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>