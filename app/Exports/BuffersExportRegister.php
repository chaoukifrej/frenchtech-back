<?php

namespace App\Exports;

use App\Buffer;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BuffersExportRegister implements
    FromCollection,
    Responsable,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithEvents
{
    use Exportable;

    private $fileName = "Demande-enregistrements.xlsx";
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Buffer::where('type_of_demand', 'like', 'register')->get();
    }
    public function map($buffer): array
    {
        return [
            $buffer->id,
            $buffer->name,
            $buffer->email,
            $buffer->phone,
            $buffer->adress,
            $buffer->postal_code,
            $buffer->city,
            $buffer->category,
            $buffer->associations,
            $buffer->facebook,
            $buffer->linkedin,
            $buffer->twitter,
            $buffer->website,
            $buffer->activity_area,
            $buffer->funds,
            $buffer->employees_number,
            $buffer->jobs_available_number,
            $buffer->women_number,
            $buffer->revenues,
            $buffer->logo,
            $buffer->description,
            $buffer->created_at,
            $buffer->updated_at,
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
