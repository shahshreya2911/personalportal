<tr>
    <td style="width: 40px;">
       {{ $job->name }}
    </td>
    <td class="align-middle">
        {{ $job->location }}
    </td>
    <td class="align-middle">{{ $job->description }}</td>
   
    <td class="text-center align-middle">
        <a href="{{ route('job.edit', $job->id) }}"
           class="btn btn-icon edit"
           title="@lang('app.edit_job')"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <a href="{{ route('job.delete', $job->id) }}"
           class="btn btn-icon"
           title="@lang('app.delete_job')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="@lang('app.are_you_sure_delete_job')"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>
    </td>
</tr>