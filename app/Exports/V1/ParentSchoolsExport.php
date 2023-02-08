<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\DialogueTableCollection;
use App\Http\Resources\V1\ParentSchoolCollection;
use App\Models\ParentSchools\ParentSchool;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class ParentSchoolsExport implements FromCollection,  WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $parentSchool;
    public function __construct($data)
    {
        $this->data = $data;
        $this->parentSchool  = new ParentSchool();
    }

    public function map($dialogueTable): array
    {
        return [
            $dialogueTable->id,
            $dialogueTable->consecutive,
            $dialogueTable->date,
            $dialogueTable->monitor->name ?? '',
            $dialogueTable->start_time,
            $dialogueTable->final_time,
            $dialogueTable->place_attention,
            $dialogueTable->contact,
            $dialogueTable->objective,
            $dialogueTable->development,
            $dialogueTable->conclusions,
            $dialogueTable->status,
            $dialogueTable->audited == 0 ? 'SI':'NO',
            $dialogueTable->reject_message

        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'CONSECUTIVO',
            'DATE',
            'MONITOR',
            'HORA INICIO',
            'HORA FINAL',
            'LUGAR DE ATECIÓN',
            'CONTACTO',
            'OBJECTIVOS',
            'DESARROLLO ',
            'CONCLUSIONES',
            'STATUS',
            'AUDITADO ?',
            'MENSAJE DE RECHAZO',


        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 30,
            'C' => 30,
            'D' => 30,
            'E' => 30,
            'F' => 30,
            'G' => 30,
            'H' => 50,
            'I' => 80,
            'J' => 100,
            'K' => 20,
            'L' => 100,
            'M' => 100,
            'N' => 100,
            'O' => 20,
            'P' => 100,
            'Q' =>  30,
            'R' =>  30,
            'S' =>  30,

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
            'Q' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'R' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'S' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],

        ];
    }
    public function collection()
    {
        $query =    $this->parentSchool->query();
        $parentSchools =  $this->parentSchool->get();
        if ($this->data->status) {
            $parentSchools =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->nac_id) {
            $parentSchools =   $query->where('nac_id', $this->data->nac_id)->get();
        }
        if ($this->data->date_start) {
            $parentSchools =  $query->where('date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $parentSchools =  $query->where('date', '>=', $this->data->date_start)->where('date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->nac_id && $this->data->date_start && $this->data->date_end) {
            $parentSchools =   $query->where('nac_id', $this->data->nac_id)->where('date', '>=', $this->data->date_start)->where('date', '>=', $this->data->date_end)->get();
        }
        return new ParentSchoolCollection($parentSchools);
    }
}
