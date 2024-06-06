@extends('layouts.app')

@section('navbar-title', 'الرأي المراجع')

@section('content')
    <div class="container mt-4">
        <div class="text-center">
            <h2 class="text-center">الرأي المراجع</h2>
        </div>

        <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
        </div>

        @if($activeOpinions->isEmpty())
            <p class="text-center">لا يوجد آراء نشطة حالياً.</p>
        @else
            <div class="table-responsive">
                <table class="table" id="activeOpinionsTable">
                    <thead>
                        <tr>
                            <th class="">الاسم</th>
                            <th>خط العرض</th>
                            <th>خط الطول</th>
                            <th>الإجراءات</th> {{-- Add this column for delete button --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeOpinions as $opinion)
                            <tr>
                                <td>{{ $opinion->name }}</td>
                                <td>{{ $opinion->latitude }}</td>
                                <td>{{ $opinion->longitude }}</td>
                                <td>
                                    <form action="{{ route('opinions.destroy', $opinion) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash-alt"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
