<tr>

    <td style="width: 40px;">

       {{ $player->id }}

    </td>



    <td style="width: 40px;">

       {{ $player->name }}

    </td>

    <td class="text-center align-middle">

        <a href="{{ route('player.edit', $player->id) }}"

           class="btn btn-icon edit"

           title="Edit Player"

           data-toggle="tooltip" data-placement="top">

            <i class="fas fa-edit"></i>

        </a>



        <a href="{{ route('player.delete', $player->id) }}"

           class="btn btn-icon"

           title="Delete Player"

           data-toggle="tooltip"

           data-placement="top"

           data-method="DELETE"

           data-confirm-title="@lang('app.please_confirm')"

           data-confirm-text="Are you sure You Want to Delete Player?? "

           data-confirm-delete="Yes ! Delete">

            <i class="fas fa-trash"></i>

        </a>

    </td>

</tr>