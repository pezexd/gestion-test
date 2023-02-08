<?php

namespace App\Exports\V1;

use App\Http\Resources\V1\PollCollection;
use App\Models\Poll;
use App\Traits\FunctionGeneralTrait;
use Maatwebsite\Excel\Concerns\FromCollection;
// added
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\Exportable;


class PollsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable,FunctionGeneralTrait;
    protected  $data;
    protected  $poll;

    public function __construct($data)
    {
        $this->data = $data;
        $this->poll = new Poll();
    }

    public function map($poll): array
    {
        return [
            $poll->id,
            $poll->neighborhood->name,
            $poll->entity_name->name,
            $this->data($poll->gender,'genders'),
            $poll->age,
            $poll->birth_date,
            $this->data($poll->marital_state,'marital_status'),
            $poll->stratum,
            $poll->other_neighborhoods,
            $poll->phone,
            $poll->email,
            $poll->number_children,
            $poll->dependents,
            $this->data($poll->relationship_head_household,'relationship_households'),
            $this->data($poll->ethnicity,'ethnicities'),
            $poll->victim_armed_conflict == 1 ?'SI':'NO',
            $this->data($poll->single_registry_victims,'single_registry_victims'),
            $poll->study  == 1 ?'SI':'NO',
            $this->data($poll->educational_level,'educational_levels'),
            $poll->medical_services,
            $this->data($poll->health_condition,'health_conditions'),
            $poll->takes_medication == 1 ?'SI':'NO',
            $poll->suffers_disease  == 1 ?'SI':'NO',
            $this->data($poll->type_disease,'type_diseases'),
            $poll->other_disease_type,
            $poll->disability== 1 ?'SI':'NO',
            $this->data($poll->disability_type,'disability_types'),
            $poll->assessed_disability== 1 ?'SI':'NO',
            $poll->receives_therapy== 1 ?'SI':'NO',
            $poll->expertises,
            $poll->artistic_experience,
            $poll->artistic_group == 1 ?'SI':'NO',
            $poll->artistic_group_name,
            $poll->role_artistic_group,
            $poll->user->name,
            $poll->getPublishedAtAttribute()

        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Barrio',
            'Entidad',
            'Genero',
            'Edad',
            'Fecha de cumpleaños',
            'Estado civil',
            'Estrato',
            'Otros barrios',
            'Teléfono',
            'Correo electrónico',
            'Número hijos',
            'Dependientes',
            'Relación con jefe del hogar',
            'Etnia',
            'Víctima conflicto armado',
            'Registro único víctimas',
            'Estudia',
            'Nivel educativo',
            'Servicios médicos',
            'Estado de salud',
            'Toma medicación',
            'Sufre alguna enfermedad',
            'Tipo enfermedad',
            'Otro tipo de enfermedad',
            'Discapacidad',
            'Tipo discapacidad',
            'Discapacidad evaluada',
            'Recibe terapia',
            'Experiencia',
            'Experiencia artística',
            'Pertenece algun grupo artístico',
            'Nombre grupo de artístico',
            'Role en el grupo',
            'Usuario de creación',
            'Fecha de creación',

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
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 30,
            'L' =>  30,
            'M' =>  30,
            'N' =>  30,
            // 'Ñ' =>  30,
            'O' =>  30,
            'P' =>  30,
            'Q' =>  30,
            'R' =>  30,
            'S' =>  30,
            'T' =>  30,
            'U' =>  30,
            'V' =>  30,
            'W' =>  30,
            'X' =>  30,
            'Y' =>  30,
            'Z' =>  30,
            'AA' => 30,
            'AB' => 30,
            'AC' => 30,
            'AD' => 30,
            'AE' => 30,
            'AF' => 30,
            'AG' => 30,
            'AH' => 30,
            'AI' => 30,
            'AJ' => 30
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
            'T' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'U' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'V' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'W' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'X' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'Y' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'Z' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AA' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AB' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AC' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AD' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AE' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AF' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AG' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AH' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AI' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
            'AJ' => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }
    public function collection()
    {
        $query =  $this->poll->query();
        $polls = $this->poll->get();
        if ($this->data->status) {
            $polls =   $query->orWhere('status', $this->data->status)->get();
        }
        if ($this->data->date_start) {
            $polls =  $query->where('activity_date', $this->data->date_start)->get();
        }
        if ($this->data->date_start && $this->data->date_end) {
            $polls =  $query->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '<=', $this->data->date_end)->get();
        }
        if ($this->data->date_start && $this->data->date_end  &&  $this->data->status) {
            $polls =   $query->where('status', $this->data->status)->where('activity_date', '>=', $this->data->date_start)->where('activity_date', '>=', $this->data->date_end)->get();
        }
        return  new PollCollection($polls);
    }
}
