<tr>
 
    <td style="width: 40px;">
       {{ $choice->id }}
    </td>
     <td style="width: 40px;">
       {{ $choice->catname }}
    </td>
    <td class="align-middle">
        {{ $choice->sentence }}
    </td>
     <td class="align-middle">{{ $choice->answer }}</td>
    <td class="align-middle">{{ ($choice->is_correct==1) ? 'Right' : 'Wrong' }}</td>
    <td class="align-middle">{{ ($choice->active==1) ? 'Active' : 'Inactive' }}</td>
    <td class="text-center align-middle">
        <a href="{{ route('choices.edit', $choice->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_user')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
  
        <a href="#"
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