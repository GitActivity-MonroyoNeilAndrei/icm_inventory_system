<!-- Modal -->
<div id="statusModalBackground" class="fixed inset-0 z-20 min-h-screen bg-gray-700/50 hidden"></div>

<form action="{{ route('user.changeStatus', ['id' => $rs->id]) }}" method="post" id="statusModal{{ $loop->iteration }}" class="fixed z-30 inset-0 top-20 hidden">
    @csrf
    @method('POST')
    <div class="flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="mb-4">
                <h1 class="text-lg font-bold">Confirmation</h1>
                <p class="text-gray-600">"Could I kindly inquire as to whether you are absolutely certain and completely confident in your desire and intention to proceed with the proposed action of altering the status of the user in question?"</p>
            </div>
            <div class="text-right">
                <button type="button" id="closeStatusModal{{ $loop->iteration }}" class="px-4 py-1 bg-red-600 text-white rounded hover:bg-red-700 me-3">No</button>
                <input type="submit" class="px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 cursor-pointer" value="Yes">
            </div>
        </div>
    </div>
</form>

<!-- Button to open the modal -->
 
<!-- <button id="openDeleteModal{{ $loop->iteration }}" class="px-3 py-1 text-sm bg-green-800 hover:bg-green-700 shadow rounded-md text-slate-50">Activate</button> -->

<button id="openStatusModal{{ $loop->iteration }}" class="px-3 py-1 text-sm bg-{!! $rs->status === 'activated' ? 'red' : 'green' !!}-800 hover:bg-{!! $rs->status === 'activated' ? 'red' : 'green' !!}-700 shadow rounded-md text-slate-50">
    {{ $rs->status === 'activated' ? 'Deactivated' : 'Activated' }}
</button>


<!-- JavaScript to toggle modal visibility -->
<script>
    document.getElementById('openStatusModal{{ $loop->iteration }}').addEventListener('click', function() {
        document.getElementById('statusModal{{ $loop->iteration }}').classList.remove('hidden');
        document.getElementById('statusModalBackground').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });

    document.getElementById('closeStatusModal{{ $loop->iteration }}').addEventListener('click', function() {
        document.getElementById('statusModal{{ $loop->iteration }}').classList.add('hidden');
        document.getElementById('statusModalBackground').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
</script>