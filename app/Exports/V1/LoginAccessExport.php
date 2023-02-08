<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\AccessLoginCollection;
use App\Models\AccessLogin;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class LoginAccessExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $accessLogin;

    public function __construct($data)
    {
        $this->data = $data;
        $this->accessLogin = new AccessLogin();
    }

    public function map($accessLogin): array
    {
        return [
            $accessLogin->id,
            $accessLogin->user->name,
            $accessLogin->date,
            $accessLogin->time,
            $accessLogin->active == 1 ? 'ACTIVO' : 'INACTIVO',
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Usuario',
            'Fecha',
            'Hora',
            'Estado',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 50,
            'C' => 20,
            'D' => 20,
            'E' => 20,
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

        ];
    }
    public function collection()
    {

        $query =  $this->accessLogin->query();
        $accessLogins = $this->accessLogin->get();
        if ($this->data->date_start) {
            $accessLogins =  $query->where('date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $accessLogins =  $query->where('date', '>=', $this->data->date_start)->where('date', '<=', $this->data->date_end)->get();
        }
        return new AccessLoginCollection($accessLogins);
    }
}
