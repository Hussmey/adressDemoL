@extends('layouts.app')

@section('navbar-title', 'تحرير المنطقة البريدية')

@section('content')
    <div class="container mt-4">
        <h3 class="text-center">تحرير منطقة الرمز البريدي</h3>
        <div, class="d-flex flex-row-reverse">
      <a class="btn btn-secondary " href="{{ route('postCodeAreas.index') }}">العودة إلى القائمة</a>      
        </div>   
        <form action="{{ route('postCodeAreas.update', $postCodeArea->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="code">الرمز:</label>
                <input type="text" class="form-control" name="code" value="{{ $postCodeArea->code }}" required>
            </div>

            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
@endsection
