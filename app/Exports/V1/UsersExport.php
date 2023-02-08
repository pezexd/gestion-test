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

class UsersExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable, FunctionGeneralTrait;
    protected  $data;
    protected  $user;

    public function __construct($data)
    {
        $this->data = $data;
        $this->user = new User();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            // $user->rol->name,
            $this->printValueRelations($user->roles),
            $user->status == '1' ? 'Activo' : 'Inactivo',
            $user->profile->contractor_full_name,
            $user->profile->document_number,
            $user->profile->nac->name,
            $user->profile->gestor->name ?? '',
            $user->profile->methodological_support->name ?? '',
            $user->profile->support_tracing_monitoring->name ?? '',
            $user->profile->instructor_leader->name ?? '',
            $user->profile->ambassador_leader->name ?? ''
        ];
    }
    //

    public function headings(): array
    {
        return [
            '#',
            'Alias',
            'Usuario',
            'Rol',
            'Estado',
            'Nombre completo',
            'Nuip',
            'Nac',
            'Gestor',
            'Apoyo metodólogico',
            'Apoyo al seguimiento y monitoreo',
            'Instructor',
            'Embajador'

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
            'H' => 30,
            'I' => 30,
            'J' => 30,
            'K' => 40,
            'L' =>  30,
            'M' =>  30
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
        $users = $this->user->get();
        return  new UserCollection($users);
    }
}
