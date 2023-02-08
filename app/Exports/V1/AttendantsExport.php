<?php

namespace App\Exports\V1;

use App\Models\Inscriptions\Attendant;
use App\Repositories\ReportRepository;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendantsExport implements FromCollection, WithMapping, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $constructions;
    public function __construct($constructions)
    {
        $this->constructions = $constructions;
    }

    public function map($att): array
    {
        return [
            $att->id,
            $att->type_document,
            $att->beneficiary->nac->name,
            $att->beneficiary->userbeneficiario->name,
            $att->beneficiary->full_name,
            $att->full_name,
            $att->type_document,
            $att->document_number,
            $att->phone,
            $att->email,
            $att->beneficiary->socio_demo->gender ?? '',
            $att->beneficiary->socio_demo->age ?? '',
            $att->beneficiary->socio_demo->decision_study ?? '',
            $att->beneficiary->socio_demo->educational_level ?? '',
            $att->beneficiary->socio_demo->disability_type ?? '',
            $att->beneficiary->socio_demo->decision_disability ?? '',
            $att->beneficiary->socio_demo->condition ?? '',
            $att->beneficiary->socio_demo->ethnicity ?? '',
            $att->relationship,
            $att->beneficiary->health_data->medical_service ?? '',
            $att->beneficiary->health_data->entity_name->name ?? '',
            $att->beneficiary->health_data->entity_name->health_condition ?? '',
            $att->beneficiary->health_data->entity_name->created_at ?? '',
            $att->beneficiary->status,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'IDENTIFICADOR',
            'NAC FICHA',
            'NOMBRE DEL MONITOR',
            'NOMBRE BENEFICIARIO',
            'NOMBRE DEL ACUDIENTE',
            'TIPO DOCUMENTO',
            'NÚMERO DOCUMENTO',
            'TÉLEFONO',
            'EMAIL',
            'GENERO',
            'EDAD',
            'ESTUDIO',
            'NIVEL ESTUDIO',
            'DISCAPACIDAD',
            'TIPO DISCAPACIDAD',
            'CONDICION',
            'ETNIA',
            'PARENTESCO',
            'SERVICIO MEDICO',
            'NOMBRE ENTIDAD',
            'ESTADO SALUD',
            'FECHA CARGA',
            'ESTADO'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function collection()
    {
        $date = $this->constructions->date;
        $status = $this->constructions->status;
        $age = $this->constructions->age;
        $rol = $this->constructions->rol;
        $nac = $this->constructions->nac;

        // return Attendant::with('beneficiary', 'beneficiary.nac', 'beneficiary.neighborhood',  'beneficiary.userbeneficiario', 'beneficiary.health_data', 'beneficiary.socio_demo', 'health_data.entity_name')->get();
        //return dd( Attendant::with('beneficiary', 'beneficiary.nac', 'beneficiary.neighborhood', 'beneficiary.userbeneficiario', 'beneficiary.userbeneficiario', 'beneficiary.health_data', 'beneficiary.beneficiariesPecs')->get());

       return  Attendant::all();
    //    with(['beneficiary', 'beneficiary.nac', 'beneficiary.neighborhood', 'beneficiary.userbeneficiario', 'beneficiary.health_data', 'beneficiary.socio_demo', 'health_data.entity_name'])
    //       /*  ->whereHas('beneficiary.userbeneficiario', function ($query) use ($rol) {
    //             $query->where('name', 'like', '%' . $rol . '%');
    //         })*/
    //         ->whereHas('beneficiary.nac', function ($query) use ($nac) {
    //             $query->where('name', 'like', '%' . $nac . '%');
    //         })
    //         ->whereHas('beneficiary.health_data', function ($query) use ($date, $status) {
    //             $query->where('created_at', '>=', $date)->where('status', '=', $status);
    //         })
    //         ->whereHas('beneficiary.socio_demo', function ($query) use ($age) {
    //             $query->where('age', '>=', $age);
    //         })->get();
       // dd($attendants);
       // die();
    }
}
