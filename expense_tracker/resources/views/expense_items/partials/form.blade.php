<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Expense Items Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your expense item's information.") }}
        </p>
    </header>

    <form method="post" :action="request()->routeIs('expense-items.create.index') ? route('expense-items.create.post') : route('expense-items.edit.patch')" class="mt-6 space-y-6">
        @csrf
        @if (request()->routeIs('expense-items.edit.index'))
          @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="request()->routeIs('expense-items.edit.index') ? $expenseItem->name : ''" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <x-input-label for="category_id" :value="__('Category')" />
            <select id="category_id" name="category_id" class="mt-1 block w-full" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request()->routeIs('expense-items.edit.index') && $expenseItem->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>
        <div>
            <x-input-label for="cost" :value="__('Cost')" />
            <x-text-input id="cost" name="cost" type="text" class="mt-1 block w-full" :value="request()->routeIs('expense-items.edit.index') ? $expenseItem->cost : ''" required />
            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
        </div>
        <div>
            <x-input-label for="purchase_time" :value="__('Purchase Time')" />
            <x-text-input id="purchase_time" name="purchase_time" type="datetime-local" class="mt-1 block w-full" :value="request()->routeIs('expense-items.edit.index') ? $expenseItem->purchase_time : ''" required />
            <x-input-error class="mt-2" :messages="$errors->get('purchase_time')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
