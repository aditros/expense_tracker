<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Reports') }}
            </h2>
            <a href="{{ route('reports.create.index') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
              Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (! empty($reports))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($reports as $report)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $report->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $report->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                  <a href="{{ Illuminate\Support\Facades\Storage::url($report->file) }}" download>
                                      Download
                                  </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="showPdf('{{ Illuminate\Support\Facades\Storage::url($report->file) }}')" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">
                                        Show
                                    </button>
                                    <button>
                                      <form action="{{ route('reports.delete', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="p-6 text-gray-900">
                    {{ __("No report found!") }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="pdfModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-0 mx-auto p-5 border w-1/2 h-full shadow-lg rounded-md bg-white">
            <div class="flex justify-end py-2">
                <button onclick="closePdf()" class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
            </div>
            <iframe id="pdfIframe" src="" width="100%" height="90%"></iframe>
        </div>
    </div>
    <script>
        function showPdf(url) {
            document.getElementById('pdfIframe').src = url;
            document.getElementById('pdfModal').classList.remove('hidden');
        }
    
        function closePdf() {
            document.getElementById('pdfIframe').src = '';
            document.getElementById('pdfModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
