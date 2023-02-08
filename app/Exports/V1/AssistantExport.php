<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\UserCollection;
use App\Models\User;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class AssistantExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $assintant;

    public function __construct($data)
    {
        $this->data = $data;
        $this->assintant = new User();
    }

    public function map($assintant): array
    {
        return [
            $assintant->id,
            $assintant->assistant_name,
            $assintant->assistant_document_number,
            $assintant->assistant_position,
            $assintant->nac_id,
            $assintant->assistant_phone,
            $assintant->assistant_email
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'NOMBRES Y APELLIDOS',
            'NUIP',
            'CARGO',
            'BARRIO',
            'TELÉFONO',
            'EMAIL'
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 50,
            'C' => 20,
            'D' => 30,
            'E' => 10,
            'F' => 30,
            'G' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            'A' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'B' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'C' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'D' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'E' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'F' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'G' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],

        ];
    }
    public function collection()
    {
        $assintants = $this->assintant->get();
        return  $assintants;
    }
}
