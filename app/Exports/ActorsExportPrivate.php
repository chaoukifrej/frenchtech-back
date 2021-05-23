<?php

namespace App\Exports;

use App\Actor;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class ActorsExportPrivate implements
    FromCollection,
    Responsable,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    use Exportable;

    private $fileName = "acteurs.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Actor::all();
    }
    public function map($actor): array
    {
        return [
            $actor->id,
            $actor->name,
            $actor->funds,
            $actor->employees_number,
            $actor->jobs_available_number,
            $actor->women_number,
            $actor->revenues,
            $actor->created_at,
            $actor->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Levées de fonds',
            'Nombre employées',
            'Nombre de postes disponibles',
            'Nombre de femmes',
            'Chiffre d\'affaires',
            'Date de création',
            'Date de mise à jour',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:Y1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12
                    ],
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}
