<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users Report</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      color: #333;
    }
    h2 {
      text-align: center;
      margin-bottom: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #999;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f4f4f4;
      font-weight: bold;
    }
    td {
      vertical-align: top;
    }
    .text-center {
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>User Report</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Profile Pic</th>
        <th>Resume</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
        @php
          $profilePic = optional($user->documents->where('file_type', 'profile_pic')->first())->file_path;
          $resume = optional($user->documents->where('file_type', 'resume')->first())->file_path;
        @endphp
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>
          <td>
            @if($profilePic)
              <img src="{{ public_path('storage/' . $profilePic) }}" alt="Profile" width="50" height="50">
            @else
              -
            @endif
          </td>
          <td>
            @if($resume)
              <a href="{{ asset('storage/' . $resume) }}">Download</a>
            @else
              -
            @endif
          </td>
          <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
