<?php

namespace App\Exports\V1;

use App\Models\Nac;
use App\Models\Inscriptions\Beneficiary;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class VariablesExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    use Exportable;

    public function headings(): array
    {
        return [
            '#',
            'NAC',
            'ESTRATO UNO',
            'ESTRATO DOS',
            'ESTRATO TRES',
            'ESTRATO CUATRO',
            'ESTRATO CINCO',
            'ESTRATO SEIS',
            'MÁSCULINOS',
            'FEMENINOS',
            'LGTBIQ',
            'OTRO',
            'EDAD - 0 - 5',
            'EDAD - 6 - 10',
            'EDAD - 11 - 15',
            'EDAD - 16 - 20',
            'EDAD - 21 - 25',
            'EDAD - 26 - 30',
            'EDAD - 31 - 35',
            'EDAD - 36 - 40',
            'EDAD - 41 - 45',
            'EDAD - 46 - 50',
            'EDAD - 51 - 55',
            'EDAD - 56 - 60',
            'EDAD - 61 - 65',
            'EDAD - 66 - 70',
            'EDAD - 71 - 75',
            'EDAD - 76 - 80',
            'EDAD - 81 - 85',
            'EDAD - 86 - 90',
            'EDAD - 91 - 95',
            'EDAD - 96 - 100',
            'ESTUDIO - SÍ',
            'ESTUDIO - NO',
            'NIVEL ESTUDIO - NINGUNO',
            'NIVEL ESTUDIO - PREESCOLAR',
            'NIVEL ESTUDIO - PRIMARIA',
            'NIVEL ESTUDIO - BACHILLERATO',
            'NIVEL ESTUDIO - TÉCNICO',
            'NIVEL ESTUDIO - TECNOLOGO',
            'NIVEL ESTUDIO - PREGRADO',
            'NIVEL ESTUDIO - POSTGRADO',
            'DISCAPACIDAD - SÍ',
            'DISCAPACIDAD - NO',
            'DISCAPACIDAD FÍSICA',
            'DISCAPACIDAD VISUAL',
            'DISCAPACIDAD AUDITIVA',
            'DISCAPACIDAD COGNITIVA',
            'DISCAPACIDAD MENTAL',
            'DISCAPACIDAD MULTIPLE',
            'DISCAPACIDAD NINGUNA',
            'ETNIA - AFRODESCENDIENTE',
            'ETNIA - INDÍGENA',
            'ETNIA - ROM',
            'ETNIA - NEGRO',
            'ETNIA - PALENQUERO',
            'ETNIA - RAIZAL',
            'ETNIA - NINGUNO',
            'CONDICIÓN - DESPLAZADO/A',
            'CONDICIÓN - MUJER CABEZA DE HOGAR',
            'CONDICIÓN - OTROS HECHOS',
            'CONDICIÓN - NO APLICA',
            'REGIMEN SUBSIDIADO',
            'REGIMEN - CONTRIBUTIVO',
            'ESTADO SALUD - BUENO',
            'ESTADO SALUD - REGULAR',
            'ESTADO SALUD - MALO'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true], 'alignment' => ['horizontal' => 'center']],
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $concatenated = collect([]);
        $nacs = Nac::all();
        foreach ($nacs as $nac) {
            $estrato1='0';$estrato2='0';$estrato3='0';$estrato4='0';$estrato5='0';$estrato6='0';
            $masculinos='0';$femeninos='0';$lgtbiq='0';$otro='0';
            $EDAD_0_5='0';$EDAD_6_10='0';$EDAD_11_15='0';$EDAD_16_20='0';$EDAD_21_25='0';
            $EDAD_26_30='0';$EDAD_31_35='0';$EDAD_36_40='0';$EDAD_41_45='0';$EDAD_46_50='0';
            $EDAD_51_55='0';$EDAD_56_60='0';$EDAD_61_65='0';$EDAD_66_70='0';$EDAD_71_75='0';
            $EDAD_76_80='0';$EDAD_81_85='0';$EDAD_86_90='0';$EDAD_91_95='0';$EDAD_96_100='0';
            $ESTUDIO_Si='0';$ESTUDIO_No='0';
            $NIVEL_ESTUDIO_NINGUNO = '0';$NIVEL_ESTUDIO_PREESCOLAR = '0';$NIVEL_ESTUDIO_PRIMARIA = '0';
            $NIVEL_ESTUDIO_BACHILLERATO = '0';$NIVEL_ESTUDIO_TECNICO = '0';$NIVEL_ESTUDIO_TECNOLOGO = '0';
            $NIVEL_ESTUDIO_PREGRADO = '0';$NIVEL_ESTUDIO_POSTGRADO = '0';
            $DISCAPACIDAD_SI = '0';$DISCAPACIDAD_NO = '0';
            $DISCAPACIDAD_FISICA = '0';$DISCAPACIDAD_VISUAL = '0';$DISCAPACIDAD_AUDITIVA = '0';
            $DISCAPACIDAD_COGNITIVA = '0';$DISCAPACIDAD_MENTAL = '0';$DISCAPACIDAD_MULTIPLE = '0';
            $DISCAPACIDAD_NINGUNA = '0';
            $ETNIA_AFRODESCENDIENTE = '0';$ETNIA_INDIGENA = '0';$ETNIA_ROM = '0';
            $ETNIA_NEGRO = '0';$ETNIA_PALENQUERO = '0';$ETNIA_RAIZAL = '0';$ETNIA_NINGUNO = '0';
            $CONDICION_DESPLAZADO_A = '0'; $CONDICION_MUJER_CABEZA_DE_HOGAR = '0';
            $CONDICION_OTROS_HECHOS = '0';$CONDICION_NO_APLICA = '0';
            $REGIMEN_SUBSIDIADO = '0';$REGIMEN_CONTRIBUTIVO = '0';$ESTADO_SALUD_BUENO = '0';
            $ESTADO_SALUD_REGULAR = '0';$ESTADO_SALUD_MALO = '0';

            $Beneficiarys = Beneficiary::where('nac_id',$nac->id)->with('socio_demo','health_data')->get();
            foreach ($Beneficiarys as $Beneficiary) {
                switch ($Beneficiary->stratum) {
                    case '1':
                        $estrato1++;
                        break;
                    case '2':
                        $estrato2++;
                        break;
                    case '3':
                        $estrato3++;
                        break;
                    case '4':
                        $estrato4++;
                        break;
                    case '5':
                        $estrato5++;
                        break;
                    default:
                        $estrato6++;
                        break;
                }
                if (isset($Beneficiary->socio_demo->gender)) {
                    switch ($Beneficiary->socio_demo->gender) {
                        case 'M':
                            $masculinos++;
                            break;
                        case 'F':
                            $femeninos++;
                            break;
                        case 'LGBTIQ+':
                            $lgtbiq++;
                            break;
                        default:
                            $otro++;
                            break;
                    }
                    switch ($Beneficiary->socio_demo->decision_study) {
                        case '1':
                            $ESTUDIO_Si++;
                            break;
                        default:
                            $ESTUDIO_No++;
                            break;
                    }
                    switch ($Beneficiary->socio_demo->educational_level) {
                        case 'PREE':
                            $NIVEL_ESTUDIO_PREESCOLAR++;
                            break;
                        case 'PRI':
                            $NIVEL_ESTUDIO_PRIMARIA++;
                            break;
                        case 'BAC':
                            $NIVEL_ESTUDIO_BACHILLERATO++;
                            break;
                        case 'TEC':
                            $NIVEL_ESTUDIO_TECNICO++;
                            break;
                        case 'TECN':
                            $NIVEL_ESTUDIO_TECNOLOGO++;
                            break;
                        case 'PRE':
                            $NIVEL_ESTUDIO_PREGRADO++;
                            break;
                        case 'POS':
                            $NIVEL_ESTUDIO_POSTGRADO++;
                            break;
                        default:
                            $NIVEL_ESTUDIO_NINGUNO++;
                            break;
                    }
                    switch ($Beneficiary->socio_demo->decision_disability) {
                        case '1':
                            $DISCAPACIDAD_SI++;
                            break;
                        default:
                            $DISCAPACIDAD_NO++;
                            break;
                    }
                    switch ($Beneficiary->socio_demo->disability_type) {
                        case 'F':
                            $DISCAPACIDAD_FISICA++;
                            break;
                        case 'V':
                            $DISCAPACIDAD_VISUAL++;
                            break;
                        case 'A':
                            $DISCAPACIDAD_AUDITIVA++;
                            break;
                        case 'C':
                            $DISCAPACIDAD_COGNITIVA++;
                            break;
                        case 'M':
                            $DISCAPACIDAD_MENTAL++;
                            break;
                        case 'MUL':
                            $DISCAPACIDAD_MULTIPLE++;
                            break;
                        default:
                            $DISCAPACIDAD_NINGUNA++;
                            break;
                    }
                    switch ($Beneficiary->socio_demo->ethnicity) {
                        case 'AFRO':
                            $ETNIA_AFRODESCENDIENTE++;
                            break;
                        case 'IND':
                            $ETNIA_INDIGENA++;
                            break;
                        case 'ROM':
                            $ETNIA_ROM++;
                            break;
                        case 'PAL':
                            $ETNIA_PALENQUERO++;
                            break;
                        case 'RAI':
                            $ETNIA_RAIZAL++;
                            break;
                        default:
                            $ETNIA_NINGUNO++;
                            break;
                    }
                    switch ($Beneficiary->health_data->health_condition) {
                        case 'B':
                            $ESTADO_SALUD_BUENO++;
                            break;
                        case 'R':
                            $ESTADO_SALUD_REGULAR++;
                            break;
                        default:
                            $ESTADO_SALUD_MALO++;
                            break;
                    }
                    switch ($Beneficiary->health_data->	medical_service) {
                        case 'C':
                            $REGIMEN_CONTRIBUTIVO++;
                            break;
                        default:
                            $REGIMEN_SUBSIDIADO++;
                            break;
                    }
                }
            }
            $collection = collect([
                [
                    'id' => $nac->id,
                    'name' => $nac->name,
                    'estrato1' => $estrato1,
                    'estrato2' => $estrato2,
                    'estrato3' => $estrato3,
                    'estrato4' => $estrato4,
                    'estrato5' => $estrato5,
                    'estrato6' => $estrato6,
                    'masculinos' => $masculinos,
                    'femeninos' => $femeninos,
                    'lgtbiq' => $lgtbiq,
                    'otro' => $otro,
                    'EDAD_0_5' => $EDAD_0_5,
                    'EDAD_6_10' => $EDAD_6_10,
                    'EDAD_11_15' => $EDAD_11_15,
                    'EDAD_16_20' => $EDAD_16_20,
                    'EDAD_21_25' => $EDAD_21_25,
                    'EDAD_26_30' => $EDAD_26_30,
                    'EDAD_31_35' => $EDAD_31_35,
                    'EDAD_36_40' => $EDAD_36_40,
                    'EDAD_41_45' => $EDAD_41_45,
                    'EDAD_46_50' => $EDAD_46_50,
                    'EDAD_51_55' => $EDAD_51_55,
                    'EDAD_56_60' => $EDAD_56_60,
                    'EDAD_61_65' => $EDAD_61_65,
                    'EDAD_66_70' => $EDAD_66_70,
                    'EDAD_71_75' => $EDAD_71_75,
                    'EDAD_76_80' => $EDAD_76_80,
                    'EDAD_81_85' => $EDAD_81_85,
                    'EDAD_86_90' => $EDAD_86_90,
                    'EDAD_91_95' => $EDAD_91_95,
                    'EDAD_96_100' => $EDAD_96_100,
                    'ESTUDIO_Si' => $ESTUDIO_Si,
                    'ESTUDIO_No' => $ESTUDIO_No,
                    'NIVEL_ESTUDIO_NINGUNO' => $NIVEL_ESTUDIO_NINGUNO,
                    'NIVEL_ESTUDIO_PREESCOLAR' => $NIVEL_ESTUDIO_PREESCOLAR,
                    'NIVEL_ESTUDIO_PRIMARIA' => $NIVEL_ESTUDIO_PRIMARIA,
                    'NIVEL_ESTUDIO_BACHILLERATO' => $NIVEL_ESTUDIO_BACHILLERATO,
                    'NIVEL_ESTUDIO_TECNICO' => $NIVEL_ESTUDIO_TECNICO,
                    'NIVEL_ESTUDIO_TECNOLOGO' => $NIVEL_ESTUDIO_TECNOLOGO,
                    'NIVEL_ESTUDIO_PREGRADO' => $NIVEL_ESTUDIO_PREGRADO,
                    'NIVEL_ESTUDIO_POSTGRADO' => $NIVEL_ESTUDIO_POSTGRADO,
                    'DISCAPACIDAD_SI' => $DISCAPACIDAD_SI,
                    'DISCAPACIDAD_NO' => $DISCAPACIDAD_NO,
                    'DISCAPACIDAD_FISICA' => $DISCAPACIDAD_FISICA,
                    'DISCAPACIDAD_VISUAL' => $DISCAPACIDAD_VISUAL,
                    'DISCAPACIDAD_AUDITIVA' => $DISCAPACIDAD_AUDITIVA,
                    'DISCAPACIDAD_COGNITIVA' => $DISCAPACIDAD_COGNITIVA,
                    'DISCAPACIDAD_MENTAL' => $DISCAPACIDAD_MENTAL,
                    'DISCAPACIDAD_MULTIPLE' => $DISCAPACIDAD_MULTIPLE,
                    'DISCAPACIDAD_NINGUNA' => $DISCAPACIDAD_NINGUNA,
                    'ETNIA_AFRODESCENDIENTE' => $ETNIA_AFRODESCENDIENTE,
                    'ETNIA_INDIGENA' => $ETNIA_INDIGENA,
                    'ETNIA_ROM' => $ETNIA_ROM,
                    'ETNIA_NEGRO' => $ETNIA_NEGRO,
                    'ETNIA_PALENQUERO' => $ETNIA_PALENQUERO,
                    'ETNIA_RAIZAL' => $ETNIA_RAIZAL,
                    'ETNIA_NINGUNO' => $ETNIA_NINGUNO,
                    'CONDICION_DESPLAZADO_A' => $CONDICION_DESPLAZADO_A,
                    'CONDICION_MUJER_CABEZA_DE_HOGAR' => $CONDICION_MUJER_CABEZA_DE_HOGAR,
                    'CONDICION_OTROS_HECHOS' => $CONDICION_OTROS_HECHOS,
                    'CONDICION_NO_APLICA' => $CONDICION_NO_APLICA,
                    'REGIMEN_SUBSIDIADO' => $REGIMEN_SUBSIDIADO,
                    'REGIMEN_CONTRIBUTIVO' => $REGIMEN_CONTRIBUTIVO,
                    'ESTADO_SALUD_BUENO' => $ESTADO_SALUD_BUENO,
                    'ESTADO_SALUD_REGULAR' => $ESTADO_SALUD_REGULAR,
                    'ESTADO_SALUD_MALO' => $ESTADO_SALUD_MALO,
                ]
            ]);
            $concatenated = ($collection->concat($concatenated));
        }

        return $concatenated->sortBy('id');
    }
}
