<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submission List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div
                            class="mb-4 rounded-lg bg-green-100 dark:bg-green-800 p-4 text-green-700 dark:text-green-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 rounded-lg bg-red-100 dark:bg-red-800 p-4 text-red-700 dark:text-red-200">
                            <ul class="list-disc pl-5">
                                {{ session(key: 'error') }}
                            </ul>
                        </div>
                    @endif

                    <form id="print-selected-form" method="POST" action="{{ route('form.printSelected') }}">
                        @csrf
                        <div class="overflow-x-auto">
                            <table class="min-w-full w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead>
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            <input type="checkbox" id="select-all" class="form-checkbox">
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Invoice ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Type
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Service Submission Date
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Actions
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                            Form Submission Time
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                <input type="checkbox" name="selected_forms[]"
                                                    value="{{ $form->id }}" class="form-checkbox">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $form->id }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $form->invoice_id }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $form->type }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $form->customer_name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ \Carbon\Carbon::parse($form->service_submission_date)->format('D d-M-Y') }}
                                                </span>
                                            </td>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('form.edit', $form->id) }}"
                                                        class="bg-green-500 hover:bg-green-600 text-white font-medium py-1 px-3 rounded shadow">
                                                        Edit
                                                    </a>
                                                    @if (auth()->check() && auth()->user()->hasRole('admin'))
                                                        <a href="{{ route('form.show', $form->id) }}"
                                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-1 px-3 rounded shadow">
                                                            Print
                                                        </a>
                                                        <button type="button"
                                                            onclick="confirmDelete('{{ $form->id }}')"
                                                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-3 rounded shadow">
                                                            Delete
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $form->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (auth()->check() && auth()->user()->hasRole('admin'))
                            <div class="mt-4 flex justify-end">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded shadow">
                                    Print Selected
                                </button>
                            </div>
                        @endif
                    </form>

                    <!-- Hidden delete forms -->
                    @foreach ($forms as $form)
                        <form id="delete-form-{{ $form->id }}" method="POST"
                            action="{{ route('form.destroy', $form->id) }}" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endforeach

                    <div class="mt-4">
                        {{ $forms->links() }}
                    </div>
                </div>

                <script>
                    document.getElementById('select-all').addEventListener('change', function() {
                        const checkboxes = document.querySelectorAll('input[name="selected_forms[]"]');
                        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
                    });

                    function confirmDelete(formId) {
                        if (confirm('Are you sure you want to delete this response?')) {
                            document.getElementById('delete-form-' + formId).submit();
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
