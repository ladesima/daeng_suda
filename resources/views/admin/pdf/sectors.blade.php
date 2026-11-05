<!DOCTYPE html>
<html>
<head>
    <title>Data Sektor</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Sektor</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sektor</th>
                <th>Ringkasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->summary }}</td>
                    <td>{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
