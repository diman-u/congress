<div>
    @if ($msg = session('success'))
        <div class="fixed inset-x-0 bottom-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-end z-50">
            <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
                <div class="bg-indigo-300 rounded-lg shadow-xs overflow-hidden">
                    <div class="p-2">
                        <div class="flex items-start">
                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                <p class="text-lg font-extrabold text-indigo-900">
                                    {{ $msg }}
                                </p>
                            </div>
                            <div class="ml-3 mr-3 flex-shrink-0 flex">
                                <button @click="show = false" class="inline-flex font-extrabold text-indigo-900 focus:outline-none focus:text-indigo-500 transition ease-in-out duration-150">
                                    x
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>