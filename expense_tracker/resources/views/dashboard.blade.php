<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2 p-2">
                <canvas id="myChart" width="500" class="m-auto"></canvas>
                <script>
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                      type: 'pie',
                      data: {
                        labels: <?php echo json_encode($expenseItemPieChartDataCategories) ?>,
                        datasets: [{
                          label: 'My First Dataset',
                          data: <?php echo json_encode($expenseItemPieChartDataCosts) ?>,
                          hoverOffset: 4,
                          offset: 2
                        }]
                      }
                    });
                </script>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (! empty($expenseItems))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($expenseItems as $expenseItem)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseItem->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseItem->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseItem->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseItem->cost }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($expenseItem->purchase_time)->format('Y-m-d H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
                                        <a href="{{ route('expense-items.edit.index', $expenseItem->id) }}">Edit</a>
                                    </button>
                                    <button>
                                      <form action="{{ route('expense-items.delete', $expenseItem->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
                    {{ __("No item found!") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
