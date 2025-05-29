<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="text-xl font-semibold mb-2">Массовое обновление цен через Excel</h2>
        <div class="flex flex-col">
            <div class="flex flex-col gap-2 p-2">
                <input type="file" id="file" wire:model="file" accept=".xlsx,.xls" class="hidden" />
                </span>
                </label>
                <div class="flex flex-row gap-3">
                    <button type="button" onclick="document.getElementById('file').click()"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-md shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16V4m0 12 4-4m-4 4-4-4m8 8H8a2 2 0 01-2-2V16a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Загрузить Excel
                    </button>
                    <button type="button" wire:click="exportPrices"
                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4v12m0 0 4-4m-4 4-4-4m8 8H8a2 2 0 01-2-2V16a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Скачать шаблон
                    </button>
                </div>
                @error('file')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-gray-500 text-sm p-4">
                <ul class="list-disc space-y-1">
                    <li>Скачайте шаблон, измените цены и загрузите обратно.</li>
                    <li>Обновляются только цены по ID товара.</li>
                    <li>Поддерживаются форматы .xlsx и .xls</li>
                </ul>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
