@can('edit-user')
    <a class="btn btn-icon btn-primary btn-sm" href="javascript:void(0);" id="edit-dashboard" data-bs-toggle="tooltip"
        data-bs-placement="bottom" title="" data-bs-original-title="{{ __('Edit') }}"
        data-action="edit-dashboard/{{ $dashboard->id }}/edit"><i class="ti ti-edit"></i></a>
@endcan
@can('delete-user')
    {!! Form::open([
        'method' => 'DELETE',
        'route' => ['delete.dashboard', $dashboard->id],
        'id' => 'delete-form-' . $dashboard->id,
        'class' => 'd-inline',
    ]) !!}
    <a href="#" class="btn btn-sm small btn-danger show_confirm" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="" data-bs-original-title="{{ __('Delete') }}" id="delete-form-{{ $dashboard->id }}"><i
            class="ti ti-trash mr-0"></i></a>
    {!! Form::close() !!}
@endcan
