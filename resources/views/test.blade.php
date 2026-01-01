<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsive Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-table {
            border-collapse: collapse;
            width: 100%;
        }
        .custom-table th, .custom-table td {
            border: 2px solid black;
            padding: 10px;
            text-align: left;
        }
        .header {
            background-color: #2c7da0;
            color: white;
            font-weight: bold;
        }
        .count-units {
            background-color: #4caf50;
            color: white;
        }
        .total-units {
            background-color: #d4af37;
            color: black;
        }
        .striped-row:nth-child(even) {
            background-color: #6ab0c9;
        }
    </style>
</head>
<body class="container mt-4">
    <div class="d-flex flex-wrap mb-3">
        <span class="badge bg-primary me-2">Property, Block and Floors Listing</span>
        <span class="badge bg-success me-2">Floor Wise Unit Count</span>
        <span class="badge bg-warning me-2">Total Unit</span>
        <span class="badge bg-danger me-2">Proposed Unit</span>
        <span class="badge bg-success me-2">Booked Unit</span>
        <span class="badge bg-primary me-2">Agreement Unit</span>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr class="header">
                    <th>Property-Block-Floor</th>
                    <th>Count Of Units</th>
                    <th>Total Units</th>
                </tr>
            </thead>
            <tbody>
                <tr class="striped-row">
                    <td>abc-Block A-FLR001</td>
                    <td class="count-units">1</td>
                    <td class="total-units">UNIT005</td>
                </tr>
                <tr class="striped-row">
                    <td>abc-Block A-FLR002</td>
                    <td class="count-units">0</td>
                    <td class="total-units"></td>
                </tr>
                <tr class="striped-row">
                    <td>abc-Block A-FLR003</td>
                    <td class="count-units">0</td>
                    <td class="total-units"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
