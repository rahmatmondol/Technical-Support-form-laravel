<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                @if (session('success'))
                        <div class="mb-4 rounded-lg bg-green-100 dark:bg-green-800 p-4 text-green-700 dark:text-green-200">
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
                <form action="{{ route('form.update', $form['id']) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="invoice_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Invoice ID</label>
                            <input disabled type="text" name="invoice_id" id="invoice_id" value="{{ old('invoice_id', $form['invoice_id']) }}" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-400 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('invoice_id') border-red-500 @enderror">
                            {{-- @error('invoice_id')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror --}}
                        </div>

                        <div>
                            <label for="service_submission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Service Submission Date</label>
                            <input type="date" name="service_submission_date" id="service_submission_date" value="{{ old('service_submission_date', \Carbon\Carbon::parse($form['service_submission_date'])->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('service_submission_date') border-red-500 @enderror">
                            @error('service_submission_date')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $form['customer_name']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('customer_name') border-red-500 @enderror">
                            @error('customer_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="address_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                            <input type="text" name="address_city" id="address_city" value="{{ old('address_city', $form['address_city']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address_city') border-red-500 @enderror">
                            @error('address_city')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="address_country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                            <input type="text" name="address_country" id="address_country" value="{{ old('address_country', $form['address_country']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address_country') border-red-500 @enderror">
                            @error('address_country')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="electronic_account_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Electronic Account Name</label>
                            <input type="text" name="electronic_account_name" id="electronic_account_name" value="{{ old('electronic_account_name', $form['electronic_account_name']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('electronic_account_name') border-red-500 @enderror">
                            @error('electronic_account_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('type') border-red-500 @enderror">
                                @foreach ($services as $service)
                                    <option value="{{ $service }}" {{ old('type', $form['type']) == $service ? 'selected' : '' }}>
                                        {{ $service }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $form['phone_number']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('phone_number') border-red-500 @enderror">
                            @error('phone_number')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="amount_previously_paid" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount Previously Paid</label>
                            <input type="text" name="amount_previously_paid" id="amount_previously_paid" value="{{ old('amount_previously_paid', $form['amount_previously_paid']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('amount_previously_paid') border-red-500 @enderror">
                            @error('amount_previously_paid')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="electronic_signature" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Electronic Signature</label>
                            <input type="text" name="electronic_signature" id="electronic_signature" value="{{ old('electronic_signature', $form['electronic_signature']) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('electronic_signature') border-red-500 @enderror">
                            @error('electronic_signature')
                                <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label for="comments" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Comments</label>
                        <textarea name="comments" id="comments" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('comments') border-red-500 @enderror">{{ old('comments', $form['comments'] ?? '') }}</textarea>
                        @error('comments')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="agreed_to_terms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agreed to Terms</label>
                        <div class="gap-6">
                            <div class="flex items-center mb-3">
                                <input type="radio" name="agreed_to_terms" id="termsYes" value="yes"
                                    class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                    {{ old('agreed_to_terms', $form['agreed_to_terms']) == 'yes' ? 'checked' : '' }} />
                                <label for="termsYes" class="ml-2 text-sm text-text-light dark:text-text-dark">
                                    I Agree
                                </label>
                            </div>
                            <div class="flex items-center mb-3">
                                <input type="radio" name="agreed_to_terms" id="termsWhatsapp" value="I agreed through WhatsApp"
                                    class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                    {{ old('agreed_to_terms', $form['agreed_to_terms']) == 'I agreed through WhatsApp' ? 'checked' : '' }} />
                                <label for="termsWhatsapp" class="ml-2 text-sm text-text-light dark:text-text-dark">
                                    I agreed through WhatsApp
                                </label>
                            </div>
                            <div class="flex items-center mb-3">
                                <input type="radio" name="agreed_to_terms" id="termsNo" value="no"
                                    class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                    {{ old('agreed_to_terms', $form['agreed_to_terms']) == 'no' ? 'checked' : '' }} />
                                <label for="termsNo" class="ml-2 text-sm text-text-light dark:text-text-dark">
                                    I Disagree
                                </label>
                            </div>
                        </div>
                        @error('agreed_to_terms')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
