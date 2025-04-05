<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body
    class="bg-bg-light dark:bg-bg-dark text-text-light dark:text-text-dark min-h-screen font-sans transition-colors duration-300">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Invoice Card -->
        <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-card overflow-hidden">
            <!-- Company Header -->
            <div class="bg-gradient-to-r from-primary to-primary-dark text-white p-6 md:p-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-40 h-16 bg-white/20 rounded-full flex items-center justify-center mb-4">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo"
                            class="w-40 h-16 object-contain rounded">
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold mb-2">Technical Support Secure Websites & Electronic
                        Accounts</h1>
                    <div class="flex flex-wrap justify-center gap-4 text-sm md:text-base text-white/90">
                        <p><i class="fas fa-phone mr-1"></i> +971562002001</p>
                        <p><i class="fas fa-envelope mr-1"></i> admin@uaesos.com</p>
                        <p><i class="fas fa-globe mr-1"></i> https://www.uaesos.com</p>
                    </div>
                </div>
            </div>

            {{-- @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-800 p-4 text-red-700 dark:text-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <!-- Invoice Form -->
            <div class="p-6 md:p-8">
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
                <form method="POST" action="{{ route('form.store') }}">
                    @csrf
                    {{-- <div class="block md:flex items-center justify-between mb-6 pb-4 border-b border-border-light dark:border-border-dark">
                        <h2 class="text-xl font-semibold text-primary dark:text-primary">
                            <i class="fas fa-file-invoice mr-2"></i>Service Invoice
                        </h2>
                        <h2 class="text-xl font-semibold dark:text-white">
                            <i class="fas fa-file-invoice-dollar"></i> Invoice ID: {{ $invoice_id }}
                        </h2>
                    </div> --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            <div class="relative">
                                <label for="submissionDate"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    <i class="far fa-calendar-alt mr-2"></i>Service Submission Date
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <input type="date" id="submissionDate" name="service_submission_date"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('service_submission_date') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg focus:outline-none "
                                        value="{{ old('service_submission_date') }}" />
                                </div>
                                @error('service_submission_date')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="customerName"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Customer Name
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <input type="text" id="customerName" name="customer_name"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('customer_name') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="John Doe" value="{{ old('customer_name') }}" />
                                </div>
                                @error('customer_name')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="customerPhone"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Phone Number for which the service was provided:
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <input type="tel" id="customerPhone" name="phone_number"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('phone_number') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="enter your phone number" value="{{ old('phone_number') }}" />
                                </div>
                                @error('phone_number')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="city"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    City
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-city"></i>
                                    </div>
                                    <input type="text" id="city" name="address_city"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('address_city') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="enter your city" value="{{ old('address_city') }}" />
                                </div>
                                @error('address_city')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative mb-4">
                                <label for="country"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Country
                                </label>
                                <div class="relative ">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <input type="text" id="country" name="address_country"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('address_country') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="enter your country" value="{{ old('address_country') }}" />


                                </div>
                                @error('address_country')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            @if (auth()->check())
                                <div class="relative">
                                    <label for="comments"
                                        class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                        Comments (if any)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                            <i class="fas fa-comment"></i>
                                        </div>
                                        <textarea id="comments" name="comments" rows="3" maxlength="100"
                                            class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('comments') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                            placeholder="Any additional comments">{{ old('comments') }}</textarea>
                                    </div>
                                    @error('comments')
                                        <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                        </div>
                        <div class="space-y-6">
                            <div class="relative">
                                <label for="accountName"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Electronic Account Name
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-at"></i>
                                    </div>
                                    <input type="text" id="accountName" name="electronic_account_name"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('electronic_account_name') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="username@example.com"
                                        value="{{ old('electronic_account_name') }}" />
                                </div>
                                @error('electronic_account_name')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="serviceType"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Type of Service Provided
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <select id="serviceType" name="type"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('type') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg  appearance-none">
                                        <option value="" selected disabled>Select a service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service }}"
                                                {{ old('type') == $service ? 'selected' : '' }}>
                                                {{ $service }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('type')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="amountPaid"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Amount previously paid
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fa-solid fa-money-bills"></i>
                                    </div>
                                    <input type="number" id="amountPaid" name="amount_previously_paid"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('amount_previously_paid') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        step="0.01" placeholder="0.00"
                                        value="{{ old('amount_previously_paid') }}" />
                                </div>
                                @error('amount_previously_paid')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label for="electronicSignature"
                                    class="block text-sm font-medium mb-1 text-text-light dark:text-text-dark">
                                    Electronic Signature
                                </label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <i class="fas fa-signature"></i>
                                    </div>
                                    <input type="text" id="electronicSignature" name="electronic_signature"
                                        class="w-full pl-10 pr-3 py-2 bg-card-light dark:bg-card-dark border @error('electronic_signature') border-red-500 @else border-border-light dark:border-border-dark @enderror rounded-lg "
                                        placeholder="Type your full name as signature"
                                        value="{{ old('electronic_signature') }}" />
                                </div>
                                @error('electronic_signature')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="relative">
                                <label class="block text-sm font-medium mb-2 text-text-light dark:text-text-dark">
                                    <i class="fas fa-file-contract mr-2"></i>Have you previously agreed to the
                                    company's terms and conditions?
                                </label>
                                <div
                                    class="bg-secondary-light dark:bg-secondary-dark p-4 rounded-lg border border-border-light dark:border-border-dark">
                                    <div class="gap-6">
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="agreed_to_terms" id="termsYes"
                                                value="yes"
                                                class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                                {{ old('agreed_to_terms') == 'yes' ? 'checked' : '' }} />
                                            <label for="termsYes"
                                                class="ml-2 text-sm text-text-light dark:text-text-dark">
                                                I Agree
                                            </label>
                                        </div>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="agreed_to_terms" id="termsWhatsapp"
                                                value="I agreed through WhatsApp"
                                                class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                                {{ old('agreed_to_terms') == 'I agreed through WhatsApp' ? 'checked' : '' }} />
                                            <label for="termsWhatsapp"
                                                class="ml-2 text-sm text-text-light dark:text-text-dark">
                                                I agreed through WhatsApp
                                            </label>
                                        </div>
                                        <div class="flex items-center mb-3">
                                            <input type="radio" name="agreed_to_terms" id="termsNo"
                                                value="no"
                                                class="h-4 w-4 text-primary focus:ring-primary border @error('agreed_to_terms') border-red-500 @else border-border-light dark:border-border-dark @enderror"
                                                {{ old('agreed_to_terms') == 'no' ? 'checked' : '' }} />
                                            <label for="termsNo"
                                                class="ml-2 text-sm text-text-light dark:text-text-dark">
                                                I Disagree
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('agreed_to_terms')
                                    <p class="absolute text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
                    <div class="mt-8 pt-4 border-t border-border-light dark:border-border-dark">
                        <button type="submit"
                            class="w-full py-3 px-6 bg-primary hover:bg-primary-dark text-white font-semibold rounded-lg shadow-button transition-all duration-300 hover:shadow-lg focus:outline-none focus:ring-opacity-50">
                            <i class="fas fa-paper-plane mr-2"></i>Submit Invoice
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Theme Toggle Button -->
    <div class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center shadow-lg cursor-pointer transition-all hover:scale-110 hover:shadow-xl"
        id="themeToggle">
        <i class="fas fa-moon" id="themeIcon"></i>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggle = document.getElementById("themeToggle");
            const themeIcon = document.getElementById("themeIcon");
            const body = document.documentElement;

            // Check saved theme preference
            const savedTheme = localStorage.getItem("theme");
            if (savedTheme === "dark") {
                body.classList.add("dark");
                themeIcon.classList.replace("fa-moon", "fa-sun");
            }

            // Toggle theme
            themeToggle.addEventListener("click", function() {
                body.classList.toggle("dark");
                if (body.classList.contains("dark")) {
                    localStorage.setItem("theme", "dark");
                    themeIcon.classList.replace("fa-moon", "fa-sun");
                } else {
                    localStorage.setItem("theme", "light");
                    themeIcon.classList.replace("fa-sun", "fa-moon");
                }
            });



            // Set today's date
            document.getElementById("submissionDate").value = new Date().toISOString().split("T")[0];

            // Form element animations
            const formControls = document.querySelectorAll("input, select, textarea");
            formControls.forEach((control) => {
                control.addEventListener("focus", function() {
                    this.parentElement.classList.add("ring-2", "ring-primary/50");
                });
                control.addEventListener("blur", function() {
                    this.parentElement.classList.remove("ring-2", "ring-primary/50");
                });
            });
        });

        // fetch('https://restcountries.com/v3.1/all')
        //     .then(response => response.json())
        //     .then(countries => {
        //         if (countries) {
        //             const countrySelect = document.getElementById('country');
        //             const selectElement = document.createElement('select');
        //             selectElement.id = 'country';
        //             selectElement.name = 'address_country';
        //             selectElement.classList.add('w-full', 'pl-10', 'pr-3', 'py-2', 'bg-card-light', 'dark:bg-card-dark',
        //                 'border', 'rounded-lg', 'appearance-none');
        //             selectElement.innerHTML = '<option value="" selected disabled>Select a country</option>';
        //             for (const country of countries) {
        //                 const option = document.createElement('option');
        //                 option.value = country.cca2;
        //                 option.textContent = country.name.common;
        //                 selectElement.appendChild(option);
        //             }
        //             countrySelect.parentElement.replaceChild(selectElement, countrySelect);
        //         }

        //     });
    </script>
</body>

</html>
