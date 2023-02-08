<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\PedagogicalCollection;
use App\Models\Pedagogical;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class PedagogicalsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $pedagogical;

    public function __construct($data)
    {
        $this->data = $data;
        $this->pedagogical = new Pedagogical();
    }

    public function map($pedagogical): array
    {
        return [
            $pedagogical->id,
            $pedagogical->user->name,
            $pedagogical->consecutive,
            $pedagogical->activity_name,
            $pedagogical->nac->name,
            $pedagogical->cultural_right->name,
            $pedagogical->orientation->name,
            $pedagogical->expertise->name,
            $pedagogical->experiential_objective,
            $this->data($pedagogical->lineament_id, 'lineaments'),
            $pedagogical->manifestation,
            $pedagogical->process,
            $pedagogical->product,
            $pedagogical->resources,
            $this->data($pedagogical->status, 'status'),
            $pedagogical->reject_message

        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Usuario creación',
            'Consecutivo',
            'Nombre de la actividad',
            'Nac',
            'Derechos culturales',
            'Orientaciones',
            'Experticias',
            'Objectivo vivencial',
            'Lineamiento',
            'Manifestación cultural',
            'Proceso',
            'Producto',
            'Recursos necesarios',
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
            'D' => 40,
            'E' => 20,
            'F' => 50,
            'G' => 50,
            'H' => 40,
            'I' => 100,
            'J' => 100,
            'K' => 100,
            'L' =>  100,
            'M' =>  50,
            'N' => 50,
            'O' => 50,
            'P' => 100,

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
        $query =  $this->pedagogical->query();
        $pedagogicals = $this->pedagogical->get();
        if ($this->data->status) {
            $pedagogicals =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->nac_id) {
            $pedagogicals =   $query->where('nac_id', $this->data->nac_id)->get();
        }
        if ($this->data->date_start) {
            $pedagogicals =  $query->where('activity_date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $pedagogicals =  $query->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->nac_id && $this->data->date_start && $this->data->date_end) {
            $pedagogicals =   $query->where('nac_id', $this->data->nac_id)->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '>=', $this->data->date_end)->get();
        }
        return  new PedagogicalCollection($pedagogicals);
    }
}
