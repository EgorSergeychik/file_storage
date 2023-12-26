<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Shared Files') }}
                </h2>
            </div>
            <div class="flex items-center justify-between">
                <span>Shared with me</span>
                <div class="relative inline-block w-10 ml-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"/>
                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
                <span>I'm sharing</span>
            </div>
        </div>
    </x-slot>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="error-popup">
                <span class="close-error">&times;</span>
                <strong>{{ __('Error!') }}</strong>
                <p>{{ $error }}</p>
            </div>
        @endforeach
    @endif

    @if (session('success'))
        <div class="success-popup">
            <span class="close-success">&times;</span>
            <strong>{{ __('Success!') }}</strong>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table id="fileTable" class="table-auto w-full">
                        <!-- Table will be populated with JavaScript -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('toggle').addEventListener('change', function() {
        let route = this.checked ? '{{ route('files.sharing') }}' : '{{ route('files.shared') }}';
        fetch(`${route}`)
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('fileTable');
                table.innerHTML = ''; // Clear the table

                // Add table headers
                let thead = document.createElement('thead');
                let tr = document.createElement('tr');
                data.columns.forEach(column => {
                    let th = document.createElement('th');
                    th.textContent = column;
                    th.className = "px-4 py-2"
                    tr.appendChild(th);
                });
                // Add empty header for the action column
                let th = document.createElement('th');
                th.className = "px-4 py-2";
                tr.appendChild(th);
                thead.appendChild(tr);
                table.appendChild(thead);

                // Add table body
                let tbody = document.createElement('tbody');
                data.rows.forEach(row => {
                    let tr = document.createElement('tr');
                    Object.values(row).forEach((cell, index) => {
                        if (index !== 0) { // Skip the first column (id)
                            let td = document.createElement('td');
                            td.textContent = cell;
                            td.className = "border px-4 py-2";
                            tr.appendChild(td);
                        }
                    });
                    // Add action button
                    let td = document.createElement('td');
                    let a = document.createElement('a');
                    a.textContent = this.checked ? 'Unshare' : 'Download';
                    a.href = this.checked ? `/files/${row.id}/unshare` : `/files/${row.id}/download`;
                    a.classList.add('button');
                    a.classList.add(this.checked ? 'danger' : 'success');
                    td.className = "border px-4 py-2";
                    td.appendChild(a);
                    tr.appendChild(td);

                    tbody.appendChild(tr);
                });
                table.appendChild(tbody);
            });
    });

    // Trigger the change event to load the initial data
    document.getElementById('toggle').dispatchEvent(new Event('change'));
</script>
