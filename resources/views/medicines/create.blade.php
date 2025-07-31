@extends('layouts.app')

@section('title', 'Add Medicine - Pharmacy Management System')

@section('page-title', 'Add Medicine')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('medicines.index') }}">Medicines</a></li>
<li class="breadcrumb-item active">Add Medicine</li>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add New Medicine</h5>

        <form class="row g-3" method="POST" action="{{ route('medicines.store') }}">
          @csrf

          <div class="col-md-6">
            <label for="name" class="form-label">Medicine Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
              <option value="">Select Category</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('category_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="price" class="form-label">Price</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" min="0" step="0.01" required>
            </div>
            @error('price')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" min="0" required>
            @error('stock')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}">
            @error('manufacturer')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-md-6">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" required>
            @error('expiry_date')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
            @error('description')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Save Medicine</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Cancel</a>
          </div>
        </form>

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  // Set minimum date for expiry date to today
  document.getElementById('expiry_date').min = new Date().toISOString().split('T')[0];
</script>
@endpush 