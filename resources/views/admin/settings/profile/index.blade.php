<h1 class="mt-3 text-center text-xl font-bold shadow">Profile Information</h1>

<form action="{{ route('admin.settings.update-profile', auth()->user()->id) }}" method="post" class="mt-4 p-4 flex flex-col border border-gray-600 bg-gray-50 rounded-xl shadow">
  @csrf
  @method('POST')
  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">First Name:</label>
    <input name="first_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->first_name }}" required>
  </div>

  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">Last Name:</label>
    <input name="last_name" type="text" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->last_name }}" required>
  </div>

  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">Email:</label>
    <input name="email" type="email" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" value="{{ auth()->user()->email }}" required>
  </div>

  <div class="mt-4 max-w-60 text-center">
    <button class="py-0.5 px-2 rounded-md bg-blue-900 hover:bg-blue-800 text-gray-100" type="submit">Save Changes</button>
  </div>
 
</form>

<h1 class="mt-3 text-center text-xl font-bold shadow">Change Password</h1>


<form action="{{ route('admin.updateProfilePassword', auth()->user()->id) }}" method="post" class="mt-4 p-4 flex flex-col border border-gray-600 bg-gray-50 rounded-xl shadow">
  @csrf
  @method('POST')

  @error('new_password')
    <div class="w-full p-3 mt-3 rounded shadow text-white font-semibold bg-red-600">
      <span>
        {{ $message }}
      </span>
    </div>
    @enderror

  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">Current Password:</label>
    <input name="current_password" type="password" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
  </div>

  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">New Password:</label>
    <input name="password" type="password" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
  </div>

  <div class="mt-2 max-w-80">
    <label class="block text-sm font-medium leading-6 text-gray-900">Confirm Password:</label>
    <input name="password_confirmation" type="password" class="px-3 w-full py-1 shadow ring-1 ring-gray-600 hover:ring-2 rounded focus-outline-none focus:ring-offset-2 focus:ring-indigo-600" required>
  </div>

  <div class="mt-4 max-w-60 text-center">
    <button class="py-0.5 px-2 rounded-md bg-blue-900 hover:bg-blue-800 text-gray-100" type="submit">Save Changes</button>
  </div>
 
</form>