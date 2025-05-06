<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Students List</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .school-info {
            text-align: center;
            flex-grow: 1;
        }
        .school-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .logo {
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
        }
        .date {
            text-align: right;
            font-size: 12px;
            color: #555;
        }
        h2 { 
            text-align: center; 
            margin-top: 10px;
        }
        .class-info {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            font-size: 12px; 
        }
        th, td { 
            border: 1px solid #aaa; 
            padding: 6px; 
            text-align: left; 
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('dash-front/images/logo.png') }}" alt="School Logo" class="logo">
        <div class="school-info">
            <div class="school-name">Numa School</div>
            <div>Salt</div>
            <div>Phone: XXX-XXXXXXX</div>
        </div>
        <div class="date">Date: {{ date('Y-m-d') }}</div>
    </div>

    <h2>Students List</h2>
    <div class="class-info">
        Grade: {{ $classProfile->grade->name ?? 'N/A' }} | 
        Section: {{ $classProfile->section ?? 'N/A' }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>National ID</th>
                <th>Gender</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classProfile->students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->user->firstname }} {{ $student->user->secname }} {{ $student->user->thirdname }} {{ $student->user->lastname }}</td>
                    <td>{{ $student->national_id }}</td>
                    <td>{{ ucfirst($student->gender) }}</td>
                    <td>{{ $student->user->phone ?? '-' }}</td>
                    <td>{{ $student->user->email ?? '-' }}</td>
                    <td>{{ $student->date_of_birth ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>