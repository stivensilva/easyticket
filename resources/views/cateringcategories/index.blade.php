@extends('layout')

@section('content')

  <div>
    <a href="{{ url('catering-categories/create') }}" class="btn btn-primary float-end"><i class="bx bx-plus"></i>New</a>
    <h4 class="fw-bold py-3 mb-2">Catering categories</h4>
  </div>

  <div class="card p-3">
    <!-- <h5 class="card-header">Table Basic</h5> -->
    <div class="table-responsive text-nowrap">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($data as $category)
          <tr>
            <td><strong>{{ $category->name }}</strong></td>
            <td>
              <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                <li
                  data-bs-toggle="tooltip"
                  data-popup="tooltip-custom"
                  data-bs-placement="top"
                  class="avatar avatar-xs pull-up"
                  title="{{ $category->name }}"
                >
                <a href="{{ url('images/cateringcategories/'.$category->image) }}" data-lightbox="{{ $category->name }}" data-title="{{ $category->name }}">
                  <img src="{{ url('images/cateringcategories/'.$category->image) }}" alt="Avatar" class="rounded" />
                </a>
                </li>
              </ul>
            </td>
            <td>{{ $category->description }}</td>
            <td>
              @if($category->status)
                <span class="badge bg-label-success me-1">Active</span>
              @else
                <span class="badge bg-label-danger me-1">Inactive</span>
              @endif   
            </td>
            <td>
              <a href="{{ url('catering-categories/'.$category->id.'/edit') }}" class="btn btn-outline-dark btn-sm" title="Edit category">
                <i class="bx bx-pencil"></i>
              </a>
              <form action="{{ url('catering-categories/'.$category->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                @if($category->status)
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Inactivate category" onclick="return confirm('Are you sure you want to inactivate this category?')">
                    <i class="bx bx-trash"></i>
                  </button>
                @else
                  <button type="submit" class="btn btn-outline-dark btn-sm" title="Activate category" onclick="return confirm('Are you sure you want to activate this category?')">
                    <i class="bx bx-recycle"></i>
                  </button>
                @endif
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

@stop