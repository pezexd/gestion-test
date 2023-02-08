<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\DialogueTableCollection;
use App\Http\Resources\V1\UserCollection;
use App\Models\DialogueTables\DialogueTable;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;

class DialogueTablesExport implements FromCollection,  WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $dialogueTables;
    public function __construct($data)
    {
        $this->data = $data;
        $this->dialogueTables =  new DialogueTable();
    }

    public function map($dialogueTable): array
    {
        return [
            $dialogueTable->id,
            $dialogueTable->consecutive,
            $dialogueTable->nac->name,
            $dialogueTable->assistant->count(),
            $dialogueTable->activity_date,
            $dialogueTable->start_time,
            $dialogueTable->final_hour,
            $dialogueTable->manager->name ?? '',
            $dialogueTable->user->name,
            $dialogueTable->created_at,
            $dialogueTable->target_workday,
            $dialogueTable->theme,
            $dialogueTable->schedule_day,
            $dialogueTable->workday_description,
            $dialogueTable->achievements_difficulties,
            $dialogueTable->alerts,
            $this->data($dialogueTable->status, 'status'),
            $dialogueTable->reject_message,
            $dialogueTable->audited == 1 ? 'SI' : 'NO',
            $dialogueTable->method_support->name ?? '',
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'CONSECUTIVO',
            'NAC',
            'NÚMERO DE ASISTENTES',
            'FECHA DE ACTIVIDAD',
            'HORA DE INICIO',
            'HORA FINAL',
            'GESTOR',
            'USUARIO CREACIÓN',
            'FECHA CREACIÓN',
            'OBJECTIVO DE JORNADA',
            'TEMA',
            'AGENDA DEL DIA',
            'DESCRIPCIÓN DE LA JORNADA',
            'LOGROS Y DIFICULTADES',
            'ALERTAS',
            'ESTADO',
            'MENSAJE DE RECHAZO',
            'AUDITADO?',
            'APOYO METODOLÓGICO'

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
        $query =  $this->dialogueTables->query();
        $dialogueTables = $this->dialogueTables->get();
        if ($this->data->status) {
            $dialogueTables =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->nac_id) {
            $dialogueTables =   $query->where('nac_id', $this->data->nac_id)->get();
        }
        if ($this->data->date_start) {
            $dialogueTables =  $query->where('activity_date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $dialogueTables =  $query->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->nac_id && $this->data->date_start && $this->data->date_end) {
            $dialogueTables =   $query->where('nac_id', $this->data->nac_id)->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '>=', $this->data->date_end)->get();
        }
        return new DialogueTableCollection($dialogueTables);
    }
}
