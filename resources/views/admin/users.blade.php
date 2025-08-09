@include('admin.header')
@include('admin.sidebar')
@include('admin.connect')
@include('admin.fruits')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>All Customers</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
  @media (max-width: 1024px) {
    .responsive-container {
      width: 100% !important;
      margin-left: 0 !important;
      padding-left: 1rem;
      padding-right: 1rem;
    }
    table, th, td {
      font-size: 0.75rem;
    }
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateX(-40px);
    }
    to {
      opacity: 1;
      transform: translateX(0);
    }
  }

  .animate-slide-in {
    animation: slideIn 0.8s ease forwards;
  }
</style>

</head>
<body>
<div class="p-4 mx-auto bg-gray-50 min-h-screen responsive-container" style="width: 90%; margin-left: 242px;margin-top: 80px;">
  @if(session('success'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
      {{ session('success') }}
      <button onclick="this.parentElement.style.display='none'" class="ml-2 font-bold">x</button>
    </div>
  @endif
  @if(session('error'))
    <div class="fixed top-4 right-4 bg-red-600 text-white px-4 py-2 rounded shadow-lg z-50">
      {{ session('error') }}
      <button onclick="this.parentElement.style.display='none'" class="ml-2 font-bold">x</button>
    </div>
  @endif

  <!-- Dashboard Stats -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
    <div class="bg-white shadow rounded p-4 flex items-center justify-between">
      <div>
        <p class="text-gray-500 text-xs mb-1">Total Customers</p>
        <h3 class="text-xl font-bold text-green-600">5,423</h3>
      </div>
      <i class="fas fa-users text-2xl text-green-400"></i>
    </div>
    <div class="bg-white shadow rounded p-4 flex items-center justify-between">
      <div>
        <p class="text-gray-500 text-xs mb-1">Members</p>
        <h3 class="text-xl font-bold text-green-600">1,893</h3>
      </div>
      <i class="fas fa-user-circle text-2xl text-green-400"></i>
    </div>
    <div class="bg-white shadow rounded p-4 flex items-center justify-between">
      <div>
        <p class="text-gray-500 text-xs mb-1">Active Now</p>
        <h3 class="text-xl font-bold text-green-600">189</h3>
      </div>
      <i class="fas fa-signal text-2xl text-green-400"></i>
    </div>
  </div>

  <!-- User Table -->
  <div class="bg-white shadow rounded p-4">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2 mb-4">
      <h2 class="text-lg font-semibold text-gray-800">All Customers</h2>
      <div class="flex flex-wrap gap-3 items-center">
        <label for="rows" class="text-sm font-medium text-gray-600">Rows per page:</label>
        <select id="rows" onchange="changeRows(this.value)" class="border border-gray-300 rounded px-2 py-1 text-sm">
          <option value="5" {{ request('rows') == 5 ? 'selected' : '' }}>5</option>
          <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
          <option value="15" {{ request('rows') == 15 ? 'selected' : '' }}>15</option>
        </select>
        <button onclick="document.getElementById('addUserModal').classList.remove('hidden')" class="bg-green-500 text-white px-4 py-1 text-sm rounded hover:bg-green-600">+ Add</button>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-xs text-left">
        <thead class="bg-gray-100 text-gray-600">
          <tr>
            <th class="p-2">Name</th>
            <th class="p-2">Username</th>
            <th class="p-2">Phone</th>
            <th class="p-2">Email</th>
            <th class="p-2">Country</th>
            <th class="p-2">Role</th>
            <th class="p-2">Status</th>
            <th class="p-2">Actions</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          @foreach ($users as $user)
          <tr class="border-b">
            <td class="p-2 text-black">{{ $user->name }}</td>
            <td class="p-2 text-black">{{ $user->username }}</td>
            <td class="p-2 text-black">{{ $user->phone }}</td>
            <td class="p-2 text-black">{{ $user->email }}</td>
            <td class="p-2 text-black">{{ $user->country_code }}</td>
            <td class="p-2 capitalize text-black">{{ $user->role }}</td>
            <td class="p-2">
              <span class="px-2 py-1 rounded-full text-xs {{ $user->status == 'active' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                {{ ucfirst($user->status) }}
              </span>
            </td>
            <td class="p-2">
              <div class="flex flex-wrap gap-2">
                <button onclick='openViewUser(@json($user))' class="text-blue-500 hover:underline">View</button>
                <button data-user='@json($user)' data-action-url="{{ route('admin.users.update', $user->id) }}" class="edit-btn text-yellow-500 hover:underline">Edit</button>
                <button onclick='openChangeRole("{{ route('admin.users.role', $user->id) }}", "{{ $user->getRoleNames()->first() }}")' class="text-purple-500 hover:underline">Role</button>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete user?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-500 hover:underline">Delete</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4 text-sm">
      {{ $users->appends(['rows' => request('rows')])->links() }}
    </div>
  </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 space-y-4">
        <h3 class="text-lg font-bold text-gray-800">Add New User</h3>
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="name" placeholder="Full Name" required class="border border-gray-300 px-3 py-2 rounded-lg focus:ring focus:ring-green-200 text-black" />
                <input type="text" name="username" placeholder="Username" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="text" name="phone" placeholder="Phone" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="text" name="country_code" placeholder="Country Code" value="RW - 250" class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="email" name="email" placeholder="Email" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="password" name="password" placeholder="Password" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg">Add User</button>
            </div>
        </form>
    </div>
</div>

<!-- View User Modal -->
<div id="viewUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800">User Details</h3>
        <div class="space-y-2 text-black">
            <p><strong>Name:</strong> <span id="viewName"></span></p>
            <p><strong>Username:</strong> <span id="viewUsername"></span></p>
            <p><strong>Phone:</strong> <span id="viewPhone"></span></p>
            <p><strong>Email:</strong> <span id="viewEmail"></span></p>
            <p><strong>Country:</strong> <span id="viewCountry"></span></p>
            <p><strong>Role:</strong> <span id="viewRole"></span></p>
            <p><strong>Status:</strong> <span id="viewStatus"></span></p>
        </div>
        <div class="mt-4 flex justify-end">
            <button onclick="document.getElementById('viewUserModal').classList.add('hidden')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Close</button>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6">
        <h3 class="text-lg font-bold text-gray-800">Edit User</h3>
        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <input type="text" id="editName" name="name" placeholder="Full Name" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="text" id="editUsername" name="username" placeholder="Username" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="text" id="editPhone" name="phone" placeholder="Phone" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="text" id="editCountry" name="country_code" placeholder="Country Code" class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="email" id="editEmail" name="email" placeholder="Email" required class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
                <input type="password" id="editPassword" name="password" placeholder="New Password (Optional)" class="border border-gray-300 px-3 py-2 rounded-lg text-black" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('editUserModal').classList.add('hidden')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Change Role Modal -->
<div id="changeRoleModal" class="fixed inset-0 z-50 bg-black bg-opacity-30 flex justify-center items-center hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Change User Role</h3>
        <form id="changeRoleForm" method="POST">
            @csrf
            <select name="role" id="roleSelect" class="w-full border border-gray-300 px-3 py-2 rounded-lg text-black">
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="supervisor">Supervisor</option>
                <option value="businessperson">BusinessPerson</option>
                <option value="technician">Technician</option>
                <option value="mechanic">Mechanic</option>
                <option value="tailor">Tailor</option>
                <option value="craftsperson">Craftsperson</option>
                <option value="mediator">Mediator</option>
                <option value="client">Client</option>
                <option value="staff">Staff</option>
            </select>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="hideChangeRoleModal()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg">Change Role</button>
            </div>
        </form>
    </div>
</div>

<script>
  function changeRows(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('rows', value);
    window.location.href = url.toString();
  }

      function showChangeRoleModal(userId) {
        const form = document.getElementById('changeRoleForm');
        form.action = `/admin/users/${userId}/change-role`; // Should match your route
        document.getElementById('changeRoleModal').classList.remove('hidden');
    }

    function hideChangeRoleModal() {
        document.getElementById('changeRoleModal').classList.add('hidden');
    }

    // View User Modal
    function openViewUser(user) {
        document.getElementById('viewName').textContent = user.name;
        document.getElementById('viewUsername').textContent = user.username;
        document.getElementById('viewPhone').textContent = user.phone;
        document.getElementById('viewEmail').textContent = user.email;
        document.getElementById('viewCountry').textContent = user.country_code;
        document.getElementById('viewRole').textContent = user.role;
        document.getElementById('viewStatus').textContent = user.status;
        document.getElementById('viewUserModal').classList.remove('hidden');
    }

    // Edit User Modal
    function openEditUser(user, actionUrl) {
        const form = document.getElementById('editUserForm');
        form.action = actionUrl;
        document.getElementById('editName').value = user.name;
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editPhone').value = user.phone;
        document.getElementById('editCountry').value = user.country_code;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPassword').value = '';
        document.getElementById('editUserModal').classList.remove('hidden');
    }

    // Change Role Modal
    function openChangeRole(actionUrl, currentRole) {
        const form = document.getElementById('changeRoleForm');
        form.action = actionUrl;
        document.getElementById('roleSelect').value = currentRole;
        document.getElementById('changeRoleModal').classList.remove('hidden');
    }
    function openEditUser(user, actionUrl) {
      const form = document.getElementById('editUserForm');
      form.action = actionUrl;
      document.getElementById('editName').value = user.name;
      document.getElementById('editUsername').value = user.username;
      document.getElementById('editPhone').value = user.phone;
      document.getElementById('editCountry').value = user.country_code;
      document.getElementById('editEmail').value = user.email;
      document.getElementById('editPassword').value = '';
      document.getElementById('editUserModal').classList.remove('hidden');
  }

   document.addEventListener('DOMContentLoaded', function () {
    // Attach edit button logic
    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', function () {
        const user = JSON.parse(this.getAttribute('data-user'));
        const actionUrl = this.getAttribute('data-action-url');
        const form = document.getElementById('editUserForm');
        form.action = actionUrl;
        document.getElementById('editName').value = user.name;
        document.getElementById('editUsername').value = user.username;
        document.getElementById('editPhone').value = user.phone;
        document.getElementById('editCountry').value = user.country_code;
        document.getElementById('editEmail').value = user.email;
        document.getElementById('editPassword').value = '';
        document.getElementById('editUserModal').classList.remove('hidden');
      });
    });
  });
</script>
</body>
</html>

@include('admin.footer')
