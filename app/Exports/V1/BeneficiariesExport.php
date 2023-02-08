<?php

namespace App\Exports\V1;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Inscriptions\Beneficiary;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnLimit;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class BeneficiariesExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($pec): array
    {

        return [
            $pec->id,
            $pec->nac->name,
            $pec->neighborhood->name,
            $pec->userbeneficiario->name,
            $pec->full_name,
            $pec->institution_entity_referred,
            $pec->accept,
            $pec->linkage_project,
            $pec->participant_type,
            $pec->type_document,
            $pec->document_number,
            $pec->zone,
            $pec->stratum,
            $pec->phone,
            $pec->email,
            $pec->status,
            $pec->created_at
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Nac',
            'Vencindario',
            'Beneficiario',
            'Nombre completo',
            'Referencia de institucion',
            'Terminos y condiciones',
            'li...',
            'Tipo de participante',
            'Tipo de documento',
            'Documento',
            'Zona',
            'Estrato',
            'Telefono',
            'Correo',
            'Estado',
            'Fecha de Creacion'
        ];
    }


    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 40,
            'D' => 50,
            'E' => 20,
            'F' => 30,
            'G' => 30,
            'H' => 30,
            'I' => 35,
            'J' => 45,
            'K' => 55,
            'L' => 40,
            'M' => 45,
            'N' => 40,
            'O' => 45,
           // 'A' => 5,
        ];
    }

    public function styles(Worksheet $sheet){
         return [
            1 => ['font' => ['bold' => true]],
         ];
    }

    public function collection()
    {
       return Beneficiary::with('nac', 'neighborhood', 'userbeneficiario')->get();
    }
}
