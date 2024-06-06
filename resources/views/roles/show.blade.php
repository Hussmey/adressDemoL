@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex flex-row-reverse mb-3">
        <a class="btn btn-primary mr-2" href="{{ route('roles.edit', $role->id) }}">تحرير</a>
        <a class="btn btn-secondary" href="{{ route('roles.index') }}">العودة إلى الأدوار</a>
    </div>

    <div class="row">
        <div class="card mt-4">
            <div class="card-body mt-4">
                <div class="d-flex justify-content-center">
                    <h1 class="position-relative">
                        {{ $role->name }}
                    </h1>
                </div>

                <div class="accordion mt-3" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            @php
                                $counter = 0;
                            @endphp
                            <h5 class="mb-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa-solid fa-hand-point-down"></i>
                                <span>الصلاحيات {{ count($rolePermissions) }}</span>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($rolePermissions as $index => $permission)
                                        <div class="col-md-2 mb-3">
                                            <span class="badge badge-success mr-2">{{ $permission->name }}</span>
                                            @php
                                                $counter++;
                                            @endphp
                                        </div>

                                        @if(($index + 1) % 5 == 0 && $index + 1 != count($rolePermissions))
                                            </div>
                                            <div class="row">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
