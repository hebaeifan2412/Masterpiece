@extends('admin.layout.app')

@section('content')
<div class="container py-4">
    <h3>Assign Teacher to: Grade {{ $classProfile->grade->name }} - Section {{ $classProfile->section }}</h3>

    <div class="mb-3">
        <label for="subjectSelect" class="form-label">Select Subject</label>
        <select id="subjectSelect" class="form-select">
            <option value="">-- Select Subject --</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="teachersList" class="mt-4"></div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('subjectSelect').addEventListener('change', function () {
    const subjectId = this.value;
    const teachersList = document.getElementById('teachersList');
    teachersList.innerHTML = 'Loading...';

    if (!subjectId) return teachersList.innerHTML = '';

    fetch(`/admin/subject/${subjectId}/teachers`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0) {
                teachersList.innerHTML = '<div class="alert alert-warning">No teachers for this subject.</div>';
                return;
            }

            teachersList.innerHTML = '<div class="list-group">' +
                data.map(teacher => `
                    <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            onclick="assignTeacher(${teacher.id}, '${teacher.user.firstname} ${teacher.user.lastname}')">
                        ${teacher.user.firstname} ${teacher.user.lastname}
                        <i class="fas fa-user-plus text-success"></i>
                    </button>
                `).join('') +
            '</div>';
        });
});

function assignTeacher(teacherId, name) {
    if (!confirm(`Assign ${name} to this class?`)) return;

    fetch(`{{ route('admin.class.assign-teacher.ajax', $classProfile->id) }}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ teacher_id: teacherId })
    })
    .then(res => {
        if (res.ok) {
            alert('Assigned successfully!');
        } else if (res.status === 409) {
            alert('Already assigned.');
        } else {
            alert('Failed to assign.');
        }
    });
}
</script>
@endpush
