<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Submission List') }}
        </h2>
    </x-slot>
    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Signature</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div>
                        <img src="{{ asset('images/signature/' . Auth::user()->signature) }}" alt="Signature Image" class="w-80 h-25 rounded shadow">
                    </div>
                    <div>
                        <form method="POST" action="{{ route('profile.signatureUpdate') }}" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="signature" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Signature</label>
                                <input type="file" name="signature" id="signature" class="mt-1 block w-full text-sm text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('signature')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded shadow">
                                    Update Signature
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
