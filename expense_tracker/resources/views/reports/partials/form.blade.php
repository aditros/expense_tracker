<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Report Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create your expense report's information.") }}
        </p>
    </header>

    <form method="post" :action="route('reports.create.post')" class="mt-6 space-y-6">
        @csrf

        <div class="mt-4">
            <x-input-label :value="__('Report Type')" />
            <div class="flex items-center">
                <input id="monthly" name="report_type" type="radio" value="monthly" class="mr-2" required checked>
                <label for="monthly" class="mr-4">{{ __('Monthly') }}</label>
                <input id="yearly" name="report_type" type="radio" value="yearly" class="mr-2" required>
                <label for="yearly">{{ __('Yearly') }}</label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('report_type')" />
        </div>

        <div class="mt-4">
            <x-input-label for="year" :value="__('Year')" />
            <select id="year" name="year" class="mt-1 block w-full" required>
                @for ($year = date('Y'); $year >= 1900; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <div id="month-range" class="mt-4">
            <div class="mt-4">
                <x-input-label for="start_month" :value="__('Start Month')" />
                <select id="start_month" name="start_month" class="mt-1 block w-full" required>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}">{{ DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('start_month')" />
            </div>
            
            <div class="mt-4">
                <x-input-label for="end_month" :value="__('End Month')" />
                <select id="end_month" name="end_month" class="mt-1 block w-full" required>
                    @foreach (range(1, 12) as $month)
                        <option value="{{ $month }}">{{ DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('end_month')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const monthlyRadio = document.getElementById('monthly');
            const yearlyRadio = document.getElementById('yearly');
            const monthRange = document.getElementById('month-range');

            function toggleMonthRange() {
                if (yearlyRadio.checked) {
                    monthRange.style.display = 'none';
                } else {
                    monthRange.style.display = 'block';
                }
            }

            monthlyRadio.addEventListener('change', toggleMonthRange);
            yearlyRadio.addEventListener('change', toggleMonthRange);

            // Initial check
            toggleMonthRange();
        });
        </script>
    </form>
</section>
