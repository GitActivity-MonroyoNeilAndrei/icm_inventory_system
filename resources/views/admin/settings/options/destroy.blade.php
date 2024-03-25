<!-- Modal -->
<div id="deleteModalBackground" class="fixed inset-0 z-20 min-h-screen bg-gray-700/50 hidden"></div>

<form action="{{ route('option.destroy', $rs->id) }}" method="post" id="deleteModal{{ $rs->id }}" class="fixed z-30 inset-0 top-20 hidden">
    @csrf
    @method('DELETE')
    <div class="flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h1 class="text-lg font-bold">Confirmation</h1>
                <p class="text-gray-600">Are you Sure You Want to change User Status?</p>
            </div>
            <div class="text-right">
                <button type="button" id="closeDeleteModal{{ $rs->id }}" class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 me-3">No</button>
                <input type="submit" class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 cursor-pointer" value="Yes">
            </div>
        </div>
    </div>
</form>

<button id="openDeleteModal{{ $rs->id }}" class="px-3 py-1 text-sm bg-red-700 hover:bg-red-600 shadow rounded-md text-slate-50">
  Delete
</button>

<!-- JavaScript to toggle modal visibility -->
<script>
    document.getElementById('openDeleteModal{{ $rs->id }}').addEventListener('click', function() {
        document.getElementById('deleteModal{{ $rs->id }}').classList.remove('hidden');
        document.getElementById('deleteModalBackground').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('closeDeleteModal{{ $rs->id }}').addEventListener('click', function() {
        document.getElementById('deleteModal{{ $rs->id }}').classList.add('hidden');
        document.getElementById('deleteModalBackground').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
</script>