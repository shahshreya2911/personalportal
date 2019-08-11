<tr>
    <td style="width: 40px;">
       {{ $question->id }}
    </td>
    <td class="align-middle">
        {{ $question->sentence }}
    </td>
    <td class="align-middle">{{ $question->catname }}</td>
    <td class="align-middle">{{ ($question->active==1) ? 'Active' : 'Inactive' }}</td>
    <td class="text-center align-middle">
        <a href="{{ route('questions.edit', $question->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_que')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
  
        <a href="#"
           class="btn btn-icon"
           title="@lang('app.delete_que')"
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