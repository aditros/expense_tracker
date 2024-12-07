<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Expense Category Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your expense category's information.") }}
        </p>
    </header>

    <form method="post" :action="request()->routeIs('expense-categories.create.index') ? route('expense-categories.create.post') : route('expense-categories.edit.patch')" class="mt-6 space-y-6">
        @csrf
        @if (request()->routeIs('expense-categories.edit.index'))
          @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="request()->routeIs('expense-categories.edit.index') ? $expenseCategory->name : ''" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
