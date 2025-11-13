{{-- 
    Usage in Blade templates:
    @include('admin.components.permission-check', ['permission' => 'manage-users'])
    @if($hasPermission)
        <!-- Show content -->
    @endif
--}}
@php
    $hasPermission = auth()->check() && auth()->user()->can($permission ?? '');
@endphp

