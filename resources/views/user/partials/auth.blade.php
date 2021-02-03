<!-- <div class="form-group">
    <label for="email">@lang('app.email')</label>
    <input type="email" class="form-control" id="email"
           name="email" placeholder="@lang('app.email')" value="{{ $edit ? $user->email : '' }}">
</div> -->
<div class="form-group">
    <label for="username">@lang('app.username')</label>
    <input type="text" class="form-control" id="username" placeholder="User Name"
           name="username" value="{{ $edit ? $user->username : '' }}">
</div>
<div class="form-group">
    <label for="password">{{ $edit ? trans("app.new_password") : trans('app.password') }}</label>
    <input type="password" class="form-control" id="password"
           name="password" @if ($edit) placeholder="@lang('app.leave_blank_if_you_dont_want_to_change')" @endif>
</div>
<div class="form-group">
    <label for="password_confirmation">{{ $edit ? trans("app.confirm_new_password") : trans('app.confirm_password') }}</label>
    <input type="password" class="form-control" id="password_confirmation"
           name="password_confirmation" @if ($edit) placeholder="@lang('app.leave_blank_if_you_dont_want_to_change')" @endif>
</div>
<div class="form-group">
            <label for="first_name">@lang('app.first_name')</label>
            <input type="text" class="form-control" id="first_name"
                   name="first_name" placeholder="@lang('app.first_name')" value="{{ $edit ? $user->first_name : '' }}">
</div>
<div class="form-group">
            <label for="last_name">@lang('app.last_name')</label>
            <input type="text" class="form-control" id="last_name"
                   name="last_name" placeholder="@lang('app.last_name')" value="{{ $edit ? $user->last_name : '' }}">
</div>
<div class="form-group">
            <label for="phone">@lang('app.phone')</label>
            <input type="text" class="form-control" id="phone"
                   name="phone" placeholder="@lang('app.phone')" value="{{ $edit ? $user->phone : '' }}">
</div>
 <div class="form-group">
            <label for="first_name">@lang('app.role')</label>
            {!! Form::select('role_id', $roles, $edit ? $user->role->id : '',
                ['class' => 'form-control', 'id' => 'role_id']) !!}
        </div>
@if ($edit)
    <button type="submit" class="btn btn-primary mt-2" id="update-login-details-btn">
        <i class="fa fa-refresh"></i>
        @lang('app.update_details')
    </button>
@endif 