<span>
    @if ($user->phone_verified_at != '')
        <a class="btn btn-icon btn-info btn-sm text-white btn-sm" href="{{ route('user.phoneverified', $user->id) }}"
            id="edit-user" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Phone Verified') }}">
            <i class="ti ti-message-circle"></i></a>
    @else
        <a class="btn btn-icon btn-warning btn-sm" href="{{ route('user.phoneverified', $user->id) }}" id="edit-user"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Phone Unverified') }}">
            <i class="ti ti-message-circle"></i></a>
    @endif
    @if ($user->active_status != 1)
        <a class="btn btn-icon bg-danger text-white btn-sm" href="account-status/{{ $user->id }}" id="edit-user"
            data-action="users/{{ $user->id }}/edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Deactive') }}"><i class="ti ti-user-off"></i></a>
    @else
        <a class="btn btn-icon bg-success text-white btn-sm" href="account-status/{{ $user->id }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Active') }}" data-action="users/{{ $user->id }}/edit"><i
                class="ti ti-user-check"></i></a>
    @endif
    @if ($user->email_verified_at)
        <a class="btn btn-icon btn-info btn-sm text-white btn-sm" href="{{ route('user.verified', $user->id) }}"
            id="edit-user" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Email Verified') }}">
            <i class="ti ti-mail"></i></a>
    @else
        <a class="btn btn-icon btn-warning btn-sm" href="{{ route('user.verified', $user->id) }}" id="edit-user"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Email Unverified') }}">
            <i class="ti ti-mail-forward"></i></a>
    @endif
    @can('edit-user')
        <a class="btn btn-icon btn-primary btn-sm" href="javascript:void(0);" id="edit-user"
            data-action="users/{{ $user->id }}/edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Edit') }}"><i class="ti ti-edit"></i></a>
    @endcan
    @can('delete-user')
        {!! Form::open([
            'method' => 'DELETE',
            'route' => ['users.destroy', $user->id],
            'id' => 'delete-form-' . $user->id,
            'class' => 'd-inline',
        ]) !!}
        <a href="#" class="btn btn-sm small btn-danger show_confirm" id="delete-form-{{ $user->id }}"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="{{ __('Delete') }}"><i class="ti ti-trash mr-0"></i></a>
        {!! Form::close() !!}
    @endcan
</span>
