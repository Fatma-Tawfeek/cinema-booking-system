@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Edit Category</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('admin.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="card-body">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter name" value="{{ $category->name }}">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</section>

@endSection