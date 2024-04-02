<!-- Modal -->
<div id="logoutModalBackground" class="fixed inset-0 z-20 min-h-screen bg-gray-700/50 hidden"></div>

<form action="{{ route('admin.logout') }}" method="post" id="logoutModal" class="fixed z-30 inset-0 top-20 hidden">
    @csrf
    <div class="flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h1 class="text-lg font-bold">Confirmation</h1>
                <p class="text-gray-600">"Are you Sure you Want to Logout?"</p>
            </div>
            <div class="text-right">
                <button type="button" id="closeLogoutModal" class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 me-3">No</button>
                <input type="submit" class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 cursor-pointer" value="Yes">
            </div>
        </div>
    </div>
</form>

<!-- Button to open the modal -->

<button id="openLogoutModal" class="px-4 py-1 bg-red-700 hover:bg-red-600 text-md shadow rounded-md text-slate-50">
    Logout
</button>


<!-- JavaScript to toggle modal visibility -->
<script>
    document.getElementById('openLogoutModal').addEventListener('click', function() {
        document.getElementById('logoutModal').classList.remove('hidden');
        document.getElementById('logoutModalBackground').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('closeLogoutModal').addEventListener('click', function() {
        document.getElementById('logoutModal').classList.add('hidden');
        document.getElementById('logoutModalBackground').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
</script>