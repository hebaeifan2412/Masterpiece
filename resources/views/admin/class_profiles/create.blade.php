@extends('admin.layout.app')

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    </script>
@endif

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-light-blue border-radius-lg p-4">
                        <h4 class="text-white mt-3 mb-0"> <i class="fa-regular fa-square-plus me-2"></i>Add New Class</h4>
                    </div>
                </div>
                <div class="card-body px-0 pb-2 mx-3">
                    <form action="{{ route('admin.class_profiles.store') }}" method="POST" class="px-4 py-3">
                        @csrf
                        <input type="hidden" name="grade_id" value="{{ $grade->id }}">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Grade:</label>
                            <p class="form-control-plaintext border-bottom pb-2">{{ $grade->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="section" class="form-label">Section</label>
                            <select name="section" class="form-select" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="30" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.grades.class_profiles', ['grade' => $grade->id]) }}" class="btn btn-secondary text-light">
                                <i class="fas fa-arrow-left me-1"></i> 
                            </a>
                            <button type="submit" class="btn text-light bg-light-blue">
                                <i class="fas fa-save me-2"></i> Create Class
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection