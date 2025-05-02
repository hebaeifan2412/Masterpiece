<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students List</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Students - {{ $course->title }}</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>National ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->classProfile->students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->user->firstname }} {{ $student->user->secname }} 
                        {{ $student->user->thirdname }} {{ $student->user->lastname }}</td>
                    <td>{{ $student->national_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
