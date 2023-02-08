<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\PollDesertionCollection;
use App\Models\PollDesertion;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class PollDesertionsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable,FunctionGeneralTrait ;
    protected  $data;
    protected  $pollDesertion;

    public function __construct($data)
    {
        $this->data = $data;
        $this->pollDesertion = new PollDesertion();
    }

    public function map($pollDesertion): array
    {
        return [
            $pollDesertion->id,
            $pollDesertion->user->name,
            $pollDesertion->consecutive,
            $pollDesertion->beneficiary->full_name,
            $pollDesertion->nac->name,
            $pollDesertion->date,
            $this->data($pollDesertion->beneficiary_attrition_factors, 'beneficiary_attrition_factors'),
            $pollDesertion->beneficiary_attrition_factor_other,
            $pollDesertion->disinterest_apathy == 1 ? 'SI' : 'NO',
            $pollDesertion->disinterest_apathy_explanation,
            $pollDesertion->reintegration == 1 ? 'SI' : 'NO',
            $pollDesertion->reintegration_explanation
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Usuario creación',
            'Consecutivo',
            'Beneficiario',
            'Nac',
            'Fecha',
            'Factor de deserción',
            'Otro factor',
            '¿Cree usted que hubo desinterés y apatía?',
            'Explicación',
            'Reintegración',
            'Explicación de reintegración'

        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 20,
            'F' => 30,
            'G' => 30,
            'H' => 50,
            'I' => 80,
            'J' => 100,
            'K' => 20,
            'L' => 100,

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
            'H' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'I' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'J' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'K' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'L' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'M' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'N' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'O' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'P' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
    public function collection()
    {
        $query =  $this->pollDesertion->query();
        $pollDesertions = $this->pollDesertion->get();
        if ($this->data->status) {
            $pollDesertions =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->nac_id) {
            $pollDesertions =   $query->where('nac_id', $this->data->nac_id)->get();
        }
        if ($this->data->date_start) {
            $pollDesertions =  $query->where('date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $pollDesertions =  $query->where('date', '>=', $this->data->date_start)->where('date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->nac_id && $this->data->date_start && $this->data->date_end) {
            $pollDesertions =   $query->where('nac_id', $this->data->nac_id)->where('date', '>=', $this->data->date_start)->where('activity_date', '>=', $this->data->date_end)->get();
        }
        return  new PollDesertionCollection($pollDesertions);
    }

}
