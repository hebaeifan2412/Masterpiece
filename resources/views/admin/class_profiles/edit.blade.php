@extends('admin.layout.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-light-red shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3 pt-3 fs-4">
                            <i class="fa-solid fa-file-pen me-2"></i>Edit Class
                        </h6>
                    </div>
                </div>
                <div class="card-body px-4 pb-2">
                    <form action="{{ route('admin.class_profiles.update', $classProfile->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Grade Info (readonly) -->
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label fw-bold m-2">Grade</label>
                                    <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                                    <p class="form-control form-control-plaintext ps-2">{{ $grade->name }}</p>
                                </div>
                            </div>

                            <!-- Section Info (readonly) -->
                            <div class="col-md-6">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label fw-bold m-2">Section</label>
                                    <input type="hidden" name="section" value="{{ $classProfile->section }}">
                                    <p class="form-control form-control-plaintext ps-2">{{ $classProfile->section }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Capacity Input -->
                        <div class="input-group input-group-outline my-3 is-filled fw-bold ">
                            <label for="capacity" class="form-label m-2">Capacity</label>
                            <input type="number" name="capacity" class="form-control" 
                                   value="{{ $classProfile->capacity }}" required>
                        </div>

                        <!-- Form Actions -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn bg-light-red text-light me-2">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Update
                            </button>
                            <a href="{{ route('admin.grades.class_profiles', ['grade' => $grade->id]) }}" 
                               class="btn btn-secondary text-light">
                                <i class="fa-solid fa-arrow-left me-1"></i> 
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection