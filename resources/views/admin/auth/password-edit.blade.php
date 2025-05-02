@extends('admin.layout.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold">Change Password</h2>
    <form method="POST" action="{{ route('teacher.password.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" id="current_password" class="form-control" required>
            @error('current_password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-key me-1"></i> Update Password
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ session("success") }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if ($errors->any() && $errors->get('current_password'))
<script>
    Swal.fire({
        title: 'Error',
        text: '{{ $errors->first("current_password") }}',
        icon: 'error',
        confirmButtonText: 'OK'
    });
</script>
@endif
@endsection
