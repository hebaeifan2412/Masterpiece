@push('scripts')
    


<script>
document.addEventListener('DOMContentLoaded', function () {
    const subjectSelect = document.getElementById('subject_id');
    const teacherSelect = document.getElementById('teacher_id');
    const classId = {{ $classProfile->id }}; // تمرير رقم الصف للفلترة الصحيحة

    subjectSelect.addEventListener('change', function () {
        const subjectId = this.value;

        teacherSelect.innerHTML = '<option value="">Loading...</option>';

        if (subjectId) {
            fetch(`/subject/${subjectId}/teachers?class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    teacherSelect.innerHTML = '<option value="">-- Select Teacher --</option>';
                    data.forEach(teacher => {
                        teacherSelect.innerHTML += `
                            <option value="${teacher.id}">
                                ${teacher.user.firstname} ${teacher.user.lastname}
                            </option>`;
                    });
                })
                .catch(() => {
                    teacherSelect.innerHTML = '<option value="">-- Error loading teachers --</option>';
                });
        } else {
            teacherSelect.innerHTML = '<option value="">-- Select Subject First --</option>';
        }
    });
});
</script>
@endpush