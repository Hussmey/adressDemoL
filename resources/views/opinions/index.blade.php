@extends('layouts.app')

@section('navbar-title', 'آراء العناوين')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="text-center">
             <h2 class="text-center">آراء العناوين</h2>
        </div>

        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table" id="addressesOpinionTable">
                <thead>
                    <tr>
                        <th class="">الاسم</th>
                        <th>النوع</th>
                        <th>اسم المستخدم</th>
                        <th>نشط</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($opinions as $opinion)
                        <tr>
                            <td>{{ $opinion->name }}</td>
                            <td>{{ $opinion->type }}</td>
                            <td>{{ $opinion->user_name }}</td>
                            <td class="fw-bold" style="color: {{ $opinion->active ? 'green' : 'red' }}">
                                {{ $opinion->active ? 'نعم' : 'لا' }}
                            </td>
                            <td>
            <a href="{{ route('opinions.show', $opinion) }}" class="btn btn-primary">
                <i class="fas fa-eye"></i> 
            </a>
            <form action="{{ route('opinions.destroy', $opinion) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>

            @if($opinion->reviewed)
            <span style="color: green;">تمت المراجعة</span>
            @else
                 <span style="color: yellow;">تحت المراجعة</span>
            @endif
        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
