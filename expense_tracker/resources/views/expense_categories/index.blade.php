<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Expense Categories') }}
            </h2>
            <a href="{{ route('expense-categories.create.index') }}" class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
              Create
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (! empty($expenseCategories))
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($expenseCategories as $expenseCategory)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseCategory->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $expenseCategory->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button class="bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded text-white">
                                        <a href="{{ route('expense-categories.edit.index', $expenseCategory->id) }}">Edit</a>
                                    </button>
                                    <button>
                                      <form action="{{ route('expense-categories.delete', $expenseCategory->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
                    {{ __("No customers found!") }}
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
