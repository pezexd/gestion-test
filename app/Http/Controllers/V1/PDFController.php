<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentSchools\ParentSchool;
use App\Models\PsychopedagogicalLogbooks\PsychopedagogicalLogbook;
use App\Models\Inscriptions\Inscription;
use App\Models\Nac;
use App\Models\Inscriptions\Beneficiary;
use App\Models\User;
use DB;
use Exception;
use PDF;
use File;
use ZipArchive;

class PDFController extends Controller
{
    public function formateParentSchools(Request $request)
    {

        try {
            $inico = $request->date_start;
            $fin  = $request->date_end;
            $monitor_id = $request->user_id;

            $select = [
                'id', 'consecutive', 'date', 'monitor_id', 'start_time', 'final_time',
                'place_attention', 'contact', 'objective', 'development', 'conclusions', 'development_activity_image',
                'evidence_participation_image'
            ];
            $relaciones = [
                'addedWizards:id,parent_school_id,assistant_name,assistant_document_number,assistant_position,assistant_phone,assistant_email,nac_id',
                'assistanceMonitors:id,parent_school_id,monitor_id',
                'monitor:id,name',
                'addedWizards.nac:id,name'
            ];

            if ($monitor_id == '@') {
                $ParentSchools = ParentSchool::select($select)->whereBetween('date', [$inico, $fin])->with($relaciones)->get();
            } else {
                $ParentSchools = ParentSchool::select($select)->whereBetween('date', [$inico, $fin])->where('monitor_id', $monitor_id)->with($relaciones)->get();
            }

            // return $ParentSchools;
            if ($ParentSchools->count() > 0) {
                $titulos = [
                    'Titulo1' => '1. Datos generales',
                    'Titulo2' => '2. Desarollo de la actividad',
                    'Titulo3' => '3. Registro fotográfico',
                    'Titulo4' => 'Participantes',
                ];
                $textoCabezera = [
                    'Codigo' => '16-PS-05',
                    'Version' => '1',
                    'Fecha' => '16 de agosto de 2022',
                ];
                for ($i = 0; $i < $ParentSchools->count(); $i++) {
                    $pdf = $this->generacionPDF('Formato_Escuela_Padres', $ParentSchools[$i], $titulos, $ParentSchools[$i]->consecutive, $textoCabezera, 'pdf');
                    // return $pdf;
                }
                $zip = $this->generateZip('Formato_Escuela_Padres');
                return $zip;
            } else {
                return response()->json([
                    'message' => 'No hay Registros de Escuelas de Padres',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                "line" => $e->getLine(),
                "explanation" => $e->getMessage(),
                "message" => "Algo salio mal a exportar Escuela de padre"
            ], 400);
        }
    }

    public function formatePsychoPedagogicallogs(Request $request)
    {

        try {
            $inico = $request->date_start;
            $fin  = $request->date_end;
            $monitor_id = $request->user_id;

            $select = [
                'id', 'consecutive', 'date', 'nac_id', 'start_time', 'final_time',
                'person_served_name', 'monitor_id', 'objective', 'development', 'referrals', 'conclusions_reflections_commitments',
                'alert_reporting_tracking', 'development_activity_image', 'evidence_participation_image'
            ];
            $relaciones = [
                'addedWizards:id,psychopedagogical_logbook_id,assistant_name,assistant_document_number,assistant_position,assistant_phone,assistant_email,nac_id',
                'assistanceMonitors:id,psychopedagogical_logbook_id,monitor_id',
                'monitor:id,name',
                'addedWizards.nac:id,name'
            ];
            $PsychopedagogicalLogbook = PsychopedagogicalLogbook::select($select)->with($relaciones)->get();
            // return $PsychopedagogicalLogbook;

            if ($PsychopedagogicalLogbook->count() > 0) {
                $titulos = [
                    'Titulo1' => '1. Datos generales',
                    'Titulo2' => '2. Descripción de la jornada',
                    'Titulo3' => '3. Registro fotográfico',
                    'Titulo4' => 'Participantes',
                ];
                $textoCabezera = [
                    'Codigo' => '12-PS-04',
                    'Version' => '1',
                    'Fecha' => '01 de abril de 2021',
                ];
                for ($i = 0; $i < $PsychopedagogicalLogbook->count(); $i++) {
                    $pdf = $this->generacionPDF('Formato_Bitacora_Psicopedagogica', $PsychopedagogicalLogbook[$i], $titulos, $PsychopedagogicalLogbook[$i]->consecutive, $textoCabezera, 'pdf');
                    // return $pdf;
                }
                $zip = $this->generateZip('Formato_Bitacora_Psicopedagogica');
                return $zip;
            } else {
                return response()->json([
                    'message' => 'No hay Registros de Bitacoras Psicopedagogica',
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                "line" => $e->getLine(),
                "explanation" => $e->getMessage(),
                "message" => "Algo salio mal a exportar Bitacora psicosocial"
            ], 400);
        }
    }

    public function formateInscriptionBeneficiaries(Request $request)
    {
        try {
            $inico = $request->date_start;
            $fin  = $request->date_end;
            $monitor_id = $request->user_id;


            $select = [
                'id', 'user_id', 'beneficiary_id', 'consecutive', 'status', 'reject_message', 'user_review_support_follow_id'
            ];
            $relaciones = [
                'benefiary:id,neighborhood_id,user_id,full_name,institution_entity_referred,accept,linkage_project,participant_type,type_document,document_number,neighborhood_new,zone,stratum,phone,email,file,status',
                'benefiary.attendant:id,beneficiary_id,full_name,type_document,document_number,zone,phone,email',
                'benefiary.health_data:entity_name_id,health_data_id,health_data_type,medical_service,health_condition',
                'benefiary.nac:id,name',
                'benefiary.health_data.entity_name:id,name',
                'benefiary.neighborhood:id,name',
                'benefiary.attendant.neighborhood:id,name',
                'benefiary.socio_demo:socio_demo_id,age,gender,decision_study,educational_level,decision_disability,disability_type,ethnicity,condition',
                'benefiary.userbeneficiario:id,name',
            ];
            $Inscription = Inscription::select($select)->with($relaciones)->get();
            // return $Inscription;
            $titulos = [
                'Titulo1' => 'FORMATO DE INSCRIPCIÓN DE BENEFICIARIOS',
                'Titulo2' => '1. INFORMACIÓN DE VINCULACIÓN',
                'Titulo3' => '1. DATOS GENERALES',
                'Titulo4' => '2. DATOS PERSONALES',
                'Titulo5' => '3. CARACTERIZACIÓN SOCIODEMOGRÁFICA',
                'Titulo6' => '4. INFORMACIÓN DE SALUD',
                'Titulo7' => 'FORMATO DE INSCRIPCIÓN DE ACUDIENTES',
                'Titulo8' => '1. DATOS PERSONALES',
                'Titulo9' => '2. CARACTERIZACIÓN SOCIODEMOGRÁFICA',
                'Titulo10' => '3. INFORMACIÓN DE SALUD',
            ];
            $textoCabezera = [
                'Codigo' => '03-MC-03',
                'Version' => '1',
                'Fecha' => '01 de abril de 2021',
            ];
            for ($i = 0; $i < $Inscription->count(); $i++) {
                $pdf = $this->generacionPDF('Formato_Inscripcion_Beneficiarios', $Inscription[1], $titulos, $Inscription[1]->consecutive, $textoCabezera, 'pdf');
                // return $pdf;
            }
            $zip = $this->generateZip('Formato_Inscripcion_Beneficiarios');
            return $zip;
        } catch (Exception $e) {
            return response()->json([
                "line" => $e->getLine(),
                "explanation" => $e->getMessage(),
                "message" => "Algo salio mal a exportar Inscripciones"
            ], 400);
        }
    }

    public function generacionPDF($origen, $data, $titulos, $nombrepdf, $TCabezera, $visualizacion)
    {
        try {
            $imagen = base64_encode(file_get_contents(public_path() . '/img/Reportes/logos.svg'));

            if ($visualizacion != 'pdf') {
                return View('pdf.' . $origen . '.body', [
                    'titulos' => $titulos,
                    'data' => $data
                ]);
            }

            $pdf = PDF::loadView('pdf.' . $origen . '.body', [
                'titulos' => $titulos,
                'data' => $data
            ]);
            $cabezera = $this->headerPdf($imagen, $TCabezera);
            // tamaño de hoja
            $pdf->setOption('margin-top', '55mm');
            $pdf->setOption('margin-bottom', '30mm');
            $pdf->setOption('header-html', $cabezera);
            // return $pdf;
            return $pdf->save(public_path('/reportes/' . substr($origen, 8) . '/') . $nombrepdf . '.pdf');
        } catch (Exception $e) {
            return response()->json([
                "line" => $e->getLine(),
                "explanation" => $e->getMessage(),
                "message" => "Algo salio mal a generar el pdf"
            ], 400);
        }
    }

    public function headerPdf($imagen, $TCabezera)
    {
        // return View('pdf.header', ['imagen' => $imagen,]);
        $headerHtml = view('pdf.header', [
            'datos' => $TCabezera,
            'imagen' => $imagen,
        ]);

        return $headerHtml;
    }

    public function generateZip($origen)
    {
        try {
            $zip = new ZipArchive;
            $ruta = public_path('reportes/') . substr($origen, 8);
            $ruta2 = public_path('img/Reportes/') . substr($origen, 8);
            $fileName = substr($origen, 8) . '.zip';
            if ($zip->open(public_path('reportes/' . $fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files($ruta);
                // return $files;
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            // unlink  ($ruta);
            array_map('unlink', glob($ruta . "/*.pdf"));
            array_map('unlink', glob($ruta2 . "/*.jpeg"));
            return response()->download(public_path('reportes/' . $fileName));
        } catch (\Exception $e) {
            return response()->json([
                "line" => $e->getLine(),
                "explanation" => $e->getMessage(),
                "message" => "Algo salio mal a generar el zip"
            ], 400);
        }
    }

    public function consultas()
    {
        // $concatenated = collect([]);
        // $fechaInicio=strtotime("2023-01-01");
        // $fechaFin=strtotime("2023-01-31");
        // for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
        //     echo date("d-m-Y", $i)."<br>";
        // }
        return User::with('loginaccess')->get();
    }
}
