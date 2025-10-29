<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task</title>
  <style>
    :root {
      --primary: #007bff;
      --success: #28a745;
      --danger: #dc3545;
      --bg: #f5f6fa;
      --border: #ddd;
      --text: #333;
    }

    * {
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
    }

    body {
      background: var(--bg);
      color: var(--text);
      padding: 30px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: var(--primary);
    }

    .container {
      max-width: 1100px;
      margin: auto;
      background: white;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px;
    }

    form .full {
      grid-column: 1 / -1;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"],
    button {
      width: 100%;
      padding: 10px;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 15px;
    }

    button {
      background: var(--primary);
      color: white;
      border: none;
      cursor: pointer;
      transition: 0.2s;
    }

    button:hover {
      background: #0056b3;
    }

    /* ACTIONS */
    .actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 20px 0;
      flex-wrap: wrap;
      gap: 10px;
    }

    .actions input[type="search"] {
      padding: 8px 10px;
      border: 1px solid var(--border);
      border-radius: 5px;
      width: 250px;
    }

    .actions .btn {
      margin-top: 3px;
      text-decoration: none;
      color: white;
      padding: 8px 15px;
      border-radius: 5px;
      font-size: 14px;
      display: inline-block;
    }

    .btn-csv {
      background: var(--success);
    }

    .btn-pdf {
      background: var(--primary);
    }

    .btn-csv:hover {
      background: #218838;
    }

    .btn-pdf:hover {
      background: #c82333;
    }

    /* TABLE */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    table th,
    table td {
      padding: 12px 10px;
      border: 1px solid var(--border);
      text-align: left;
    }

    table th {
      background: #f8f9fa;
    }

    table td a {
      color: var(--primary);
      text-decoration: none;
    }

    table td a:hover {
      text-decoration: underline;
    }

    /* ACTION BUTTONS */
    .btn-edit {

      background: #17a2b8;

    }


    .btn-delete {
      background: var(--danger);
    }

    .btn-edit:hover {
      background: #138496;
    }

    .btn-delete:hover {
      background: #c82333;
    }

    /* PAGINATION */
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 8px;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .pagination button {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      color: #333;
      padding: 8px 14px;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
      min-width: 40px;
    }

    .pagination button:hover:not(:disabled) {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
      transform: translateY(-1px);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .pagination button.active {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
      font-weight: bold;
    }

    .pagination button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }


    /* RESPONSIVE */
    @media (max-width: 768px) {
      form {
        grid-template-columns: 1fr;
      }

      .actions {
        flex-direction: column;
        align-items: flex-start;
      }

      table th,
      table td {
        font-size: 13px;
      }
    }

    .alert {
      padding: 12px 18px;
      border-radius: 6px;
      font-size: 15px;
      margin: 10px auto;
      width: 80%;
      text-align: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      animation: fadeIn 0.3s ease-in-out;
    }

    .success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>

  <h1>User Management</h1>


  <div class="container">
    @if (session('message'))
    <div class="alert success" id="alertBox">
      {{ session('message') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert error" id="alertBox">
      {{ session('error') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert error" id="alertBox">
    @foreach ($errors->all() as $error)
      {{ $error }}
    @endforeach
  </div>
@endif
    @if(isset($editUser->documents))
    <h2>Edit User </h2>
    <form id="updateForm" action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" value="{{ $editUser->id }}">

      <div>
        <label>Full Name</label><br>
        <input type="text" name="name" value="{{ $editUser->name }}" placeholder="Full Name" required
          style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
      </div>

      <div>
        <label>Email Address</label><br>
        <input type="email" name="email" value="{{ $editUser->email }}" placeholder="Email Address" required
          style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
      </div>

      <div>
        <label>Phone Number</label><br>
        <input type="text" name="phone" value="{{ $editUser->phone }}" placeholder="Phone Number"
          style="width: 100%; padding: 8px; border-radius: 6px; border: 1px solid #ccc;">
      </div>

      @php
      $profilePic = $editUser->documents->where('file_type', 'profile_pic')->first();
      $resume = $editUser->documents->where('file_type', 'resume')->first();
      @endphp

      @if ($profilePic)
      <div>
        <label>Current Profile Picture</label><br>
        <img src="{{ asset('storage/' . $profilePic->file_path) }}"
          alt="Profile Picture"
          style="width: 100px; height: 100px; border-radius: 8px; object-fit: cover; border: 1px solid #ccc;">
      </div>
      @endif

      <div>
        <label>Upload New Profile Picture</label><br>
        <input type="file" name="profile_pic" accept="image/*"
          style="width: 100%; padding: 6px; border-radius: 6px;">
      </div>

      @if ($resume)
      <div>
        <label>Current Resume</label><br>
        <a href="{{ asset('storage/' . $resume->file_path) }}" target="_blank"
          style="color: #007bff; text-decoration: none;">{{ $resume->file_name }}</a>
      </div>
      @endif

      <div>
        <label>Upload New Resume</label><br>
        <input type="file" name="resume" accept=".pdf,.doc,.docx"
          style="width: 100%; padding: 6px; border-radius: 6px;">
      </div>

      <button type="submit"
        style="padding: 10px 15px; border: none; border-radius: 6px; background: #007bff; color: white; cursor: pointer;">
        Update User
      </button>
    </form>

    @else
    <h2>Create New User</h2>
    <form id="Createform" action="{{ route('saveUser') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div style="margin-bottom: 10px;">
        <label>Full Name</label><br>
        <input type="text" name="name" required style="width: 100%;">
      </div>

      <div style="margin-bottom: 10px; ">
        <label>Email</label><br>
        <input type="email" name="email" required style="width: 100%;">
      </div>

      <div style="margin-bottom: 10px; ">
        <label>Phone</label><br>
        <input type="text" name="phone" style="width: 100%;">
      </div>

      <div style="margin-bottom: 10px; ">
        <label for="profile_pic">Profile Pic</label><br>
        <input type="file" name="profile_pic">
      </div>

      <div style="margin-bottom: 10px; ">
        <label for="resume">Resume</label><br>
        <input type="file" name="resume">
      </div>

      <button type="submit" style="padding: 8px 15px;">Save User</button>
    </form>
    @endif

  </div>

  <div class="container" style="margin-top: 25px;">
    <div class="actions">
      <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Search by name or email">
        <button type="submit">Search</button>
      </form>

      <div>
        <a href="{{ route('getcsv') }}" class="btn btn-csv">Export CSV</a>
        <a href="{{ route('getpdf') }}" class="btn btn-pdf">Export PDF</a>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th>
            <a style="text-decoration:none; color: black;" href="{{ route('index', ['sort' => 'id', 'order' => $order === 'asc' && $sort === 'id' ? 'desc' : 'asc']) }}">
              ID {!! $sort === 'id' ? ($order === 'asc' ? '▲' : '▼') : '' !!}
            </a>
          </th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Profile Pic</th>
          <th>Resume</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
        <tr>
          <Td>{{ $user->id }}</Td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>
          <td>
            @if($pic = $user->documents->where('file_type', 'profile_pic')->first())
            <a href="{{ asset('storage/'.$pic->file_path) }}" target="_blank">View</a>
            @else
            <span style="color:#888;">No file</span>
            @endif
          </td>
          <td>
            @if($resume = $user->documents->where('file_type', 'resume')->first())
            <a href="{{ asset('storage/'.$resume->file_path) }}" target="_blank">View</a>
            @else
            <span style="color:#888;">No file</span>
            @endif
          </td>
          <td>
            <div class="actions">
              <a href="{{ route('edit', ['id' => $user->id]) }}" class="btn btn-edit">Edit</a>
              <form action="{{ route('delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="submit" class="btn btn-delete" value="Delete">
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" style="text-align:center;">No users found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    @if ($users->hasPages())
    <div class="pagination">
      {{-- Previous Page --}}
      @if ($users->onFirstPage())
      <button disabled>&laquo; Prev</button>
      @else
      <a href="{{ $users->previousPageUrl() }}"><button>&laquo; Prev</button></a>
      @endif

      {{-- Page Numbers --}}
      @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
      @if ($page == $users->currentPage())
      <button class="active">{{ $page }}</button>
      @else
      <a href="{{ $url }}"><button>{{ $page }}</button></a>
      @endif
      @endforeach

      {{-- Next Page --}}
      @if ($users->hasMorePages())
      <a href="{{ $users->nextPageUrl() }}"><button>Next &raquo;</button></a>
      @else
      <button disabled>Next &raquo;</button>
      @endif
    </div>
    @endif

  </div>

</body>
<script>
  console.log('Validation script loaded.');
  document.addEventListener('DOMContentLoaded', function() {
    const updateForm = document.getElementById('updateForm');
    const createForm = document.getElementById('Createform');
    const form = updateForm || createForm;
    console.log('Form found:', form);
    if (!form) return;

    form.addEventListener('submit', function(e) {
      let valid = true;
      let errors = [];

      const isEmpty = v => !v || v.trim() === '';

      const name = form.querySelector('[name="name"]');
      const email = form.querySelector('[name="email"]');
      const phone = form.querySelector('[name="phone"]');

      if (isEmpty(name.value)) {
        valid = false;
        errors.push("Full Name is required.");
      }

      if (isEmpty(email.value)) {
        valid = false;
        errors.push("Email Address is required.");
      } else if (!/^[\w.%+-]+@[\w.-]+\.[A-Za-z]{2,}$/.test(email.value)) {
        valid = false;
        errors.push("Invalid Email Address format.");
      }

      if (phone.value && !/^\d{10}$/.test(phone.value)) {
        valid = false;
        errors.push("Phone Number must be 10 digits (numbers only).");
      }

      const profilePic = form.querySelector('[name="profile_pic"]');
      const resume = form.querySelector('[name="resume"]');

      if (profilePic && profilePic.files.length > 0) {
        const file = profilePic.files[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        const maxSize = 2 * 1024 * 1024; // 2MB

        if (!allowedTypes.includes(file.type)) {
          valid = false;
          errors.push("Profile Picture must be JPG or PNG.");
        }
        if (file.size > maxSize) {
          valid = false;
          errors.push("Profile Picture size must be under 2MB.");
        }
      }

      if (resume && resume.files.length > 0) {
        const file = resume.files[0];
        const allowedTypes = [
          'application/pdf',
          'application/msword',
          'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        const maxSize = 5 * 1024 * 1024; // 5MB

        if (!allowedTypes.includes(file.type)) {
          valid = false;
          errors.push("Resume must be a PDF, DOC, or DOCX file.");
        }
        if (file.size > maxSize) {
          valid = false;
          errors.push("Resume size must be under 5MB.");
        }
      }

      if (!valid) {
        e.preventDefault();
        alert(errors.join('\n'));
      }
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    const alertBox = document.getElementById("alertBox");
    if (alertBox) {
      setTimeout(() => {
        alertBox.style.transition = "opacity 0.5s ease";
        alertBox.style.opacity = "0";
        setTimeout(() => alertBox.remove(), 500); // fully remove from DOM after fade
      }, 3000); // 3 seconds delay before hiding
    }
  });
</script>

</html>