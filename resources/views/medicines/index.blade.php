@extends('layouts.app')

@section('title', 'Medicines - Pharmacy Management System')

@section('page-title', 'Medicines')

@section('breadcrumb')
<li class="breadcrumb-item active">Medicines</li>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Medicines List</h5>
        
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <a href="{{ route('medicines.create') }}" class="btn btn-primary">
              <i class="bi bi-plus-circle"></i> Add New Medicine
            </a>
          </div>
          
          <div class="search-box">
            <form class="search-form d-flex align-items-center" method="GET" action="{{ route('medicines.index') }}">
              <input type="text" name="search" placeholder="Search medicines..." value="{{ request('search') }}">
              <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
          </div>
        </div>

        <!-- Table with stripped rows -->
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">Expiry Date</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @forelse($medicines as $medicine)
              <tr>
                <th scope="row">{{ $medicine->id }}</th>
                <td>{{ $medicine->name }}</td>
                <td>{{ $medicine->category->name ?? 'N/A' }}</td>
                <td>Rp {{ number_format($medicine->price, 0, ',', '.') }}</td>
                <td>
                  <span class="badge {{ $medicine->stock > 10 ? 'bg-success' : ($medicine->stock > 0 ? 'bg-warning' : 'bg-danger') }}">
                    {{ $medicine->stock }}
                  </span>
                </td>
                <td>{{ $medicine->manufacturer ?? 'N/A' }}</td>
                <td>{{ $medicine->expiry_date ? $medicine->expiry_date->format('d/m/Y') : 'N/A' }}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('medicines.show', $medicine) }}" class="btn btn-sm btn-info" title="View">
                      <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-sm btn-warning" title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('medicines.destroy', $medicine) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this medicine?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center">No medicines found.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- End Table with stripped rows -->

        @if($medicines->hasPages())
        <div class="d-flex justify-content-center">
          {{ $medicines->links() }}
        </div>
        @endif

      </div>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Initialize datatables
    const datatables = document.querySelectorAll('.datatable');
    datatables.forEach(datatable => {
      new simpleDatatables.DataTable(datatable);
    });
  });
</script>
@endpush 