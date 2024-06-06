@extends('layouts.app')

@section('navbar-title', 'تحرير المستخدم')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">

            <h3 class="text-center">تحرير مستخدم</h3>
        
        <div class="d-flex flex-row-reverse">
        <a class="btn btn-secondary " href="{{ route('users.index') }}">العودة إلى القائمة</a>     
        </div>
    </div>
</div>

@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>عذرًا!</strong> كانت هناك بعض المشاكل في الإدخال الخاص بك.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {!! Form::text('name', null, ['placeholder' => 'الاسم','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>البريد الإلكتروني:</strong>
            {!! Form::text('email', null, ['placeholder' => 'البريد الإلكتروني','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>كلمة المرور:</strong>
            {!! Form::password('password', ['placeholder' => 'كلمة المرور','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>تأكيد كلمة المرور:</strong>
            {!! Form::password('confirm-password', ['placeholder' => 'تأكيد كلمة المرور','class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الدور:</strong>
            {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control','multiple']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">تحديث</button>
    </div>
</div>
{!! Form::close() !!}

@endsection
