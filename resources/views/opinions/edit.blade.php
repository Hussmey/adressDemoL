@extends('layouts.app')

@section('content')
    <h2>Edit Opinion</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('opinions.update', $opinion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $opinion->name }}" required>
        </div>
        <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" class="form-control" value="{{ $opinion->latitude }}" required>
        </div>
        <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" class="form-control" value="{{ $opinion->longitude }}" required>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select name="type" class="form-control" required>
                <option value="House" {{ $opinion->type === 'House' ? 'selected' : '' }}>House</option>
                <option value="Apartment" {{ $opinion->type === 'Apartment' ? 'selected' : '' }}>Apartment</option>
                <option value="Farm" {{ $opinion->type === 'Farm' ? 'selected' : '' }}>Farm</option>
                <option value="Shop" {{ $opinion->type === 'Shop' ? 'selected' : '' }}>Shop</option>
                <option value="Restaurant" {{ $opinion->type === 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                <option value="Cafe" {{ $opinion->type === 'Cafe' ? 'selected' : '' }}>Cafe</option>
                <option value="Other" {{ $opinion->type === 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="user_name">User Name</label>
            <input type="text" name="user_name" class="form-control" value="{{ $opinion->user_name }}" required>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message" class="form-control">{{ $opinion->message }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
