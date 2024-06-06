@extends('layouts.app')

@section('navbar-title', 'إنشاء دور جديد')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <h3 class="text-center">إنشاء دور جديد</h3>
        <div class="d-flex flex-row-reverse mb-3">
            <a class="btn btn-secondary" href="{{ route('roles.index') }}">العودة إلى القائمة</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>عذرًا!</strong> كانت هناك بعض المشكلات في الإدخال الخاص بك. <br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, array('placeholder' => 'الاسم','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الصلاحيات:</strong>
            <div class="row mt-3">
                @php
                    $count = 0;
                @endphp
                @foreach($permission as $value)
                    <div class="col-md-3">
                        <div class="form-check form-switch py-1">
                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input name', 'id' => 'permission_'.$value->id)) }}
                            <label class="form-check-label pr-5" for="permission_{{ $value->id }}">{{ $value->name }}</label>
                        </div>
                    </div>
                    @php
                        $count++;
                        if ($count % 4 == 0) {
                            echo '</div><div class="row">';
                        }
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btnColor">إرسال</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
