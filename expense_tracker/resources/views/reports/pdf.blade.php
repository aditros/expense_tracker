<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div style="background-color: white; overflow: hidden; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.375rem;">
      <table style="width: 100%; border-collapse: collapse; border-spacing: 0;">
          <thead style="background-color: #f9fafb;">
              <tr>
                  <th style="padding: 0.75rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Name</th>
                  <th style="padding: 0.75rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Category</th>
                  <th style="padding: 0.75rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Purchase Time</th>
                  <th style="padding: 0.75rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em;">Cost</th>
              </tr>
          </thead>
          <tbody style="background-color: white;">
              @foreach ($expenseItems as $expenseItem)
                  <tr>
                      <td style="padding: 0.75rem; white-space: nowrap;">{{ $expenseItem->name }}</td>
                      <td style="padding: 0.75rem; white-space: nowrap;">{{ $expenseItem->category->name }}</td>
                      <td style="padding: 0.75rem; white-space: nowrap;">{{ \Carbon\Carbon::parse($expenseItem->purchase_time)->format('Y-m-d H:i') }}</td>
                      <td style="padding: 0.75rem; white-space: nowrap;">{{ $expenseItem->cost }}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</body>
</html>