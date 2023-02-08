<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\PecCollection;
use App\Models\Inscriptions\Pec;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\Exportable;

// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PecsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $pec;
    public function __construct($data)
    {
        $this->data = $data;
        $this->pec = new Pec();
    }

    public function map($pec): array
    {
        return [
            $pec->id,
            $pec->consecutive,
            $pec->nac->name,
            $pec->neighborhood->name,
            $pec->place,
            $pec->place_address,
            $pec->activity_date,
            $pec->start_time,
            $pec->final_hour,
            $pec->place_type,
            $pec->place_description,
            $this->data($pec->status, 'status'),
            $pec->reject_message

        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Consecutivo',
            'Nac',
            'Barrio',
            'Lugar',
            'Dirección del lugar',
            'Fecha de la actividad',
            'Hora inicio',
            'Hora final',
            'Tipo de lugar',
            'Descripción del lugar',
            'Estado',
            'Mensaje de rechazo'
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
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 20,
            'J' => 20,
            'K' => 20,
            'L' =>  20,
            'M' =>  50
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
            'M' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']]
        ];
    }
    public function collection()
    {
        $query =  $this->pec->query();
        $pecs = $this->pec->get();
        if ($this->data->status) {
            $pecs =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->nac_id) {
            $pecs =   $query->where('nac_id', $this->data->nac_id)->get();
        }
        if ($this->data->date_start) {
            $pecs =  $query->where('activity_date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $pecs =  $query->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->nac_id && $this->data->date_start && $this->data->date_end) {
            $pecs =   $query->where('nac_id', $this->data->nac_id)->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '>=', $this->data->date_end)->get();
        }
        return  new PecCollection($pecs);
    }
}
