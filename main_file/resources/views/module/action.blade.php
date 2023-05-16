@can('edit-module')
    <a class="btn  btn-info edit_module" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
        data-bs-original-title="{{ __('Edit') }}" href="{{ route('module.edit', $module->id) }}" id="edit-module"
        data-action="module/{{ $module->id }}/edit"><i class="ti ti-edit"></i></a>
@endcan
@can('delete-module')
    {!! Form::open([
        'method' => 'DELETE',
        'route' => ['module.destroy', $module->id],
        'id' => 'delete-form-' . $module->id,
        'class' => 'd-inline',
    ]) !!}
    <a href="#" class="btn btn-sm small btn-danger show_confirm" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Delete" data-bs-original-title="{{ __('Delete') }}" id="delete-form-{{ $module->id }}"><i
            class="ti ti-trash mr-0"></i></a>
    {!! Form::close() !!}
@endcan
