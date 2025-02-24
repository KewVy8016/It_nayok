@extends('layout')
@section('title', 'นักเรียนนักศึกษา')
@section('content')
    <style>
        .male-icon,
        .female-icon,
        .total-icon {
            position: relative;
            padding-left: calc(var(--spacing-unit) * 4);
        }

        .male-icon::before {
            content: "👨‍🎓";
            position: absolute;
            left: var(--spacing-unit);
            top: 50%;
            transform: translateY(-50%);
        }

        .female-icon::before {
            content: "👩‍🎓";
            position: absolute;
            left: var(--spacing-unit);
            top: 50%;
            transform: translateY(-50%);
        }

        .total-icon::before {
            content: "👥";
            position: absolute;
            left: var(--spacing-unit);
            top: 50%;
            transform: translateY(-50%);
        }

        /* Root Variables */
        :root {
            --primary-blue: #2196F3;
            --secondary-blue: #1976D2;
            --light-blue: #E3F2FD;
            --hover-blue: #BBDEFB;
            --total-bg: #1976D2;
            --total-text: #FFFFFF;
            --text-dark: #1A237E;
            --text-light: #FFFFFF;
            --spacing-unit: 8px;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            font-family: 'Sarabun', sans-serif;
            padding: calc(var(--spacing-unit) * 3);
        }

        .table-title {
            background: var(--primary-blue);
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: var(--text-light);
            padding: calc(var(--spacing-unit) * 3);
            border-radius: 15px 15px 0 0;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table-responsive {
            overflow-x: auto;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 15px 15px;
            background: white;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
        }

        /* Table Header */
        .custom-table thead th {
            background: var(--primary-blue);
            color: var(--text-light);
            padding: calc(var(--spacing-unit) * 2);
            text-align: center;
            font-weight: bold;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        /* Last column in header (total column) */
        .custom-table thead th:last-child {
            background: var(--total-bg);
        }

        /* Table Body */
        .custom-table tbody td {
            padding: calc(var(--spacing-unit) * 2);
            text-align: center;
            transition: all 0.3s ease;
        }

        .custom-table tbody tr:nth-child(odd) td {
            background-color: rgba(227, 242, 253, 0.3);
        }

        .custom-table tbody tr:hover td {
            background-color: var(--hover-blue);
        }

        /* Total Column Styling */
        .total-col {
            background-color: var(--total-bg) !important;
            color: var(--total-text) !important;
            font-weight: bold;
        }

        .male-cell.total-col,
        .female-cell.total-col {
            color: var(--total-text) !important;
        }

        /* Regular Cells */
        .male-cell,
        .female-cell {
            font-weight: 500;
        }

        .male-cell {
            color: var(--primary-blue);
        }

        .female-cell {
            color: var(--secondary-blue);
        }

        /* Icons */
        .male-icon,
        .female-icon,
        .total-icon {
            position: relative;
            padding-left: calc(var(--spacing-unit) * 4);
        }

        .male-icon::before,
        .female-icon::before,
        .total-icon::before {
            position: absolute;
            left: var(--spacing-unit);
            top: 50%;
            transform: translateY(-50%);
        }

        /* Footer Row */
        .custom-table tfoot tr th {
            padding: calc(var(--spacing-unit) * 2);
            text-align: center;
            background: var(--light-blue);
            font-weight: bold;
        }

        /* Total column in footer */
        .custom-table tfoot tr th.total-col {
            background: var(--total-bg) !important;
            color: var(--total-text);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: var(--spacing-unit);
            }

            .table-title {
                font-size: 1.2rem;
                padding: calc(var(--spacing-unit) * 2);
            }

            .custom-table {
                font-size: 0.9rem;
            }

            .custom-table thead th,
            .custom-table tbody td,
            .custom-table tfoot th {
                padding: var(--spacing-unit);
            }
        }

        @media (max-width: 480px) {
            .table-title {
                font-size: 1rem;
            }

            .custom-table {
                font-size: 0.8rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-row {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-row:nth-child(1) {
            animation-delay: 0.1s;
        }

        .animate-row:nth-child(2) {
            animation-delay: 0.3s;
        }

        .animate-row:nth-child(3) {
            animation-delay: 0.5s;
        }
    </style>
    </head>

    <body>
        <div class="container">
            <div class="table-title">ตารางแสดงจำนวนนักเรียน</div>
            <div class="table-responsive">
            <table class="custom-table">
                <thead>
                <tr>
                    <th>ประเภท</th>
                    @foreach($students as $student)
                    <th>{{ $student->education_level }}</th>
                    @endforeach
                    <th class="total-col">รวม</th>
                </tr>
                </thead>
                <tbody>
                <tr class="animate-row">
                    <td class="male-icon">ผู้ชาย</td>
                    @php $totalMale = 0; @endphp
                    @foreach($students as $student)
                    @php $totalMale += $student->male_count; @endphp
                    <td class="male-cell">{{ $student->male_count }}</td>
                    @endforeach
                    <td class="total-col male-cell highlight-effect">{{ $totalMale }}</td>
                </tr>
                <tr class="animate-row">
                    <td class="female-icon">ผู้หญิง</td>
                    @php $totalFemale = 0; @endphp
                    @foreach($students as $student)
                    @php $totalFemale += $student->female_count; @endphp
                    <td class="female-cell">{{ $student->female_count }}</td>
                    @endforeach
                    <td class="total-col female-cell highlight-effect">{{ $totalFemale }}</td>
                </tr>
                </tbody>
                <tfoot>
                <tr class="animate-row">
                    <th class="total-icon">รวมทั้งหมด</th>
                    @foreach($students as $student)
                    <th class="highlight-effect">{{ $student->male_count + $student->female_count }}</th>
                    @endforeach
                    <th class="total-col highlight-effect">{{ $totalMale + $totalFemale }}</th>
                </tr>
                </tfoot>
            </table>
            </div>
        </div>
        @endsection

    @section('footer') {{-- ลบ Footer ออก --}} @endsection
