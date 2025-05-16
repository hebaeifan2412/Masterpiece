<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <title>Class Students List - {{ $classProfile->grade->name ?? '' }} {{ $classProfile->section ?? '' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4747A1;
        }

        .school-info {
            text-align: center;
            flex-grow: 1;
        }

        .school-name {
            font-size: 20px;
            font-weight: bold;
            color: #4747A1;
            margin-bottom: 5px;
        }

        .school-details {
            font-size: 12px;
            color: #555;
        }

        .logo-placeholder {
            width: 80px;
            height: 80px;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4747A1;
            padding: 5px;
        }

        .date {
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        h2 {
            text-align: center;
            margin: 15px 0;
            color: #4747A1;
            font-size: 18px;
        }

        .class-info {
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
            background-color: #f5f9ff;
            padding: 8px;
            border-radius: 4px;
        }

        .class-teacher {
            text-align: center;
            margin-bottom: 20px;
            font-size: 13px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
            page-break-inside: avoid;
        }

        th,
        td {
            border: 1px solid #d1e3ff;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4747A1;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f5f9ff;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            font-size: 10px;
            color: #777;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-placeholder">
            <img src="{{ public_path('dash-front/images/logo.png') }}" alt="logo" width="80"  height="80"
                style="display: block;">
        </div>
        <div class="school-info">
            <div class="school-name">Numa School</div>
            <div class="school-details">
                Salt, Jordan<br>
                Phone: +962 780 378 563<br>
                Email: info@numaschool.edu.jo
            </div>
        </div>
        <div class="date">
            Generated on: {{ date('Y-m-d H:i') }}<br>
        </div>
    </div>

    <h2>CLASS STUDENTS LIST</h2>

    <div class="class-info">
        <strong>Grade:</strong> {{ $classProfile->grade->id ?? 'N/A' }} |
        <strong>Section:</strong> {{ $classProfile->section ?? 'N/A' }} |
        <strong>Total Students:</strong> {{ count($classProfile->students) }}
    </div>

    {{-- <div class="class-teacher">
        Class Teacher: [Teacher Name] | Room: [Room Number]
    </div> --}}

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="25%">Full Name</th>
                <th width="15%">National ID</th>
                <th width="8%">Gender</th>
             
                <th width="20%">Email</th>
                <th width="15%">Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classProfile->students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->user->firstname }} {{ $student->user->secname }} {{ $student->user->thirdname }}
                        {{ $student->user->lastname }}</td>
                    <td>{{ $student->national_id }}</td>
                    <td style="text-transform: capitalize;">{{ $student->gender }}</td>
                    
                    <td>{{ $student->user->email ?? '-' }}</td>
                    <td>{{ $student->date_of_birth ? date('d/m/Y', strtotime($student->date_of_birth)) : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        This document is system-generated by Numa School Management System | Page 1 of 1
    </div>
</body>

</html>
