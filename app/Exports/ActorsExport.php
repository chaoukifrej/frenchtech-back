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

class ActorsExport implements
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
            $actor->email,
            $actor->phone,
            $actor->adress,
            $actor->postal_code,
            $actor->city,
            $actor->longitude,
            $actor->latitude,
            $actor->category,
            $actor->associations,
            $actor->facebook,
            $actor->linkedin,
            $actor->twitter,
            $actor->website,
            $actor->activity_area,
            $actor->funds,
            $actor->employees_number,
            $actor->jobs_available_number,
            $actor->women_number,
            $actor->revenues,
            $actor->logo,
            $actor->description,
            $actor->created_at,
            $actor->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nom',
            'Email',
            'Telephone',
            'Adresse',
            'Code postal',
            'Ville',
            'Longitude',
            'Latitude',
            'Catégorie',
            'Associations',
            'Facebook',
            'Linkedin',
            'Twitter',
            'Site Internet',
            'Secteur d\'activité',
            'Levées de fonds',
            'Nombre employées',
            'Nombre de postes disponibles',
            'Nombre de femmes',
            'Chiffre d\'affaires',
            'Logo',
            'Description',
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
                        'size' => 14
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
