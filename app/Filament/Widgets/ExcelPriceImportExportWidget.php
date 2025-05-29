<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Livewire\WithFileUploads;
use App\Services\PriceExportService;
use App\Services\PriceImportService;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ExcelPriceImportExportWidget extends Widget
{
    use WithFileUploads;

    protected static string $view = 'filament.widgets.excel-price-import-export-widget';

    public TemporaryUploadedFile|null $file = null;

    protected function rules()
    {
        return [
            'file' => ['required', 'file', 'mimes:xlsx,xls'],
        ];
    }

    protected function messages()
    {
        return [
            'file.required' => 'Пожалуйста, выберите файл для загрузки.',
            'file.file' => 'Загружаемый объект должен быть файлом.',
            'file.mimes' => 'Файл должен быть в формате .xlsx или .xls.',
        ];
    }

    public function exportPrices()
    {
        $path = PriceExportService::exportToExcel();
        return response()->download($path)->deleteFileAfterSend(true);
    }

    public function updatedFile()
    {
        if ($this->file) {
            $this->validate();

            $imported = PriceImportService::importFromExcel($this->file);
            $this->file = null;

            \Filament\Notifications\Notification::make()
                ->title('Цены успешно обновлены')
                ->body('Обновлено товаров: ' . count($imported))
                ->success()
                ->send();
        }
    }
}
