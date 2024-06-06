{{-- resources/views/addresses/index.blade.php --}}
@extends('layouts.app')
@section('navbar-title', 'العناوين الكاملة')

@section('content')
    <div class="container mt-4">
        <div class="row">
        <div class="text-center">
                <h3 class="text-center">جميع العناوين</h3>
            </div>
            <div class="col-md-3 py-4 mt-2 d-flex justify-content-center">
            <a href="{{ route('home') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
            </div>
        
            @can('addresses-view') {{-- Check if the user has 'addresses-view' permission --}}

            <div class="table-responsive">
        <table class="table" id="addressesTable">
            <thead>
                <tr>
                    <th>رقم المنزل</th>
                    <th>الشارع</th>
                    <th>المنطقة</th>
                    <th>المدينة</th>
                    <th>الرمز البريدي</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($houses as $house)
                    <tr>
                        <td>{{ $house->number }}</td>
                        <td>{{ $house->street->name }}</td>
                        <td>{{ $house->street->area->name }}</td>
                        <td>{{ $house->street->area->city->name }}</td>
                        <td>{{ $house->street->area->city->postalCodes->first()->code}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>
        @else
                <p class="alert alert-danger">You don't have permission to view addresses.</p>
            @endcan
        </div>
    </div>
@endsection
