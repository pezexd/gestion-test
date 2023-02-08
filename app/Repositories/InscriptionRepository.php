<?php

namespace App\Repositories;

use App\Http\Resources\V1\InscriptionsCollection;
use App\Http\Resources\V1\InscriptionsResource;
use App\Models\GroupBeneficiary;
use App\Models\Inscriptions\Attendant;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\HealthData;
use App\Models\Inscriptions\Inscription;
use App\Models\Inscriptions\SociodemographicCharacterization;
use App\Models\Neighborhood;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Traits\ImageTrait;
use App\Traits\UserDataTrait;
use Illuminate\Support\Facades\DB;
use App\Traits\FunctionGeneralTrait;

use function PHPUnit\Framework\isNull;

class InscriptionRepository
{
    use ImageTrait, UserDataTrait, FunctionGeneralTrait;
    private $model;
    private $attendant;
    private $beneficiary;
    private $sociodemographic;
    private $health_data;
    private $sociodemographic_attendant;
    private $health_data_attendant;
    private $neighborhood;
    private $groupBeneficiary;


    function __construct()
    {
        $this->model = new Inscription();
        $this->attendant = new Attendant();
        $this->beneficiary = new Beneficiary();
        $this->health_data = new HealthData();
        $this->sociodemographic = new SociodemographicCharacterization();
        $this->neighborhood = new Neighborhood();
        $this->groupBeneficiary =  new GroupBeneficiary();
    }

    public function getAll()
    {
        $rol_id = $this->getIdRolUserAuth();
        $user_id = $this->getIdUserAuth();
        $query = $this->model->query();
        $inscriptions = [];
        if ($rol_id == config('roles.monitor') || $rol_id == config('roles.instructor')) {

            $inscriptions =  $query->orderBy('id', 'DESC')->where('created_by', $user_id)->get();
        }
        if ($rol_id == config('roles.apoyo_al_seguimiento_monitoreo')) {

            $inscriptions =  $query->orderBy('id', 'DESC')->where('user_review_support_follow_id', $user_id)->get();
        }

        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $inscriptions =  $query->orderBy('id', 'DESC')->get();
        }


        return new InscriptionsCollection($inscriptions);
    }


    public function createBeneficiary($request)
    {

        DB::beginTransaction();
        try {

            $user_id = $this->getIdUserAuth();

            $beneficiary = json_decode($request->beneficiary);
            $this->beneficiary->accept = $beneficiary->accept;
            $this->beneficiary->document_number = $beneficiary->document_number;
            $this->beneficiary->email = $beneficiary->email;
            $this->beneficiary->full_name = $beneficiary->full_name;

            if ($beneficiary->institution_entity_referred != "" || $beneficiary->institution_entity_referred != null) {
                $this->beneficiary->institution_entity_referred = $beneficiary->institution_entity_referred;
            } else {
                $this->beneficiary->institution_entity_referred = NULL;
            }

            $this->beneficiary->linkage_project = $beneficiary->linkage_project;
            $this->beneficiary->nac_id = $beneficiary->nac_id;
            $this->beneficiary->neighborhood_id = $beneficiary->neighborhood_id;

            if ($beneficiary->neighborhood_new != "" || $beneficiary->neighborhood_new != null) {
                $this->beneficiary->neighborhood_new = $beneficiary->neighborhood_new;
            } else {
                $this->beneficiary->neighborhood_new = NULL;
            }

            $this->beneficiary->participant_type = $beneficiary->participant_type;
            $this->beneficiary->phone = $beneficiary->phone;

            if ($beneficiary->referrer_name != "" || $beneficiary->referrer_name != null) {
                $this->beneficiary->referrer_name = $beneficiary->referrer_name;
            } else {
                $this->beneficiary->referrer_name = NULL;
            }

            $this->beneficiary->stratum = $beneficiary->stratum;
            $this->beneficiary->type_document = $beneficiary->type_document;

            if ($beneficiary->user_id != "" || $beneficiary->user_id != null) {
                $this->beneficiary->user_id = $beneficiary->user_id;
            } else {
                $this->beneficiary->user_id = NULL;
            }

            $this->beneficiary->zone = $beneficiary->zone;
            if ($beneficiary->group_id) {
                $this->beneficiary->group_id = $beneficiary->group_id;
            }
            $this->beneficiary->created_by = $user_id;
            $saved = $this->beneficiary->save();


            if ($beneficiary->neighborhood_new != "" || $beneficiary->neighborhood_new != null) {
                $neighborhood = $this->neighborhood->where('name', 'LIKE', "%{$beneficiary->neighborhood_new}%")->first();
                if (!$neighborhood && $saved) {
                    $this->neighborhood->name = $beneficiary->neighborhood_new;
                    $this->neighborhood->user_id = $user_id;
                    $this->neighborhood->save();
                    // Guardamos en DataModel
                    $this->control_data($this->neighborhood, 'store');
                }
            }

            if (!is_null($request->beneficiary_sociodemographic_characterization)) {
                $beneficiary_sociodemographic_characterization = json_decode($request->beneficiary_sociodemographic_characterization);

                $disability_type = $beneficiary_sociodemographic_characterization->disability_type;
                if ($saved) {
                    $socio_demo = $this->beneficiary->socio_demo()->create(
                        [
                            'gender' => $beneficiary_sociodemographic_characterization->gender,
                            'age' => $beneficiary_sociodemographic_characterization->age,
                            'decision_study' =>
                            strval($beneficiary_sociodemographic_characterization->decision_study),
                            'educational_level' => $beneficiary_sociodemographic_characterization->educational_level,
                            'decision_disability' =>
                            strval($beneficiary_sociodemographic_characterization->decision_disability),
                            'disability_type' => $disability_type != '' ? $disability_type : 'N',
                            'ethnicity' => $beneficiary_sociodemographic_characterization->ethnicity,
                            'condition' => $beneficiary_sociodemographic_characterization->condition,
                        ]
                    );
                    // Guardamos en DataModel
                    $this->control_data($socio_demo, 'store');
                }
            }

            if (!is_null($request->beneficiary_health_data)) {
                $beneficiary_health_data  = json_decode($request->beneficiary_health_data);

                if ($saved) {
                    $health_data = $this->beneficiary->health_data()->create(
                        [
                            'other_entity_name' => $beneficiary_health_data->other_entity_name,
                            'medical_service' => $beneficiary_health_data->medical_service,
                            'entity_name_id' => $beneficiary_health_data->entity_name_id,
                            'health_condition' => $beneficiary_health_data->health_condition,
                        ]
                    );
                    // Guardamos en DataModel
                    $this->control_data($health_data, 'store');
                }
            }

            if ($request->hasFile('beneficiary_file')) {
                if ($saved) {
                    $this->beneficiary->query()->withTrashed();

                    $handle_1 = $this->send_file($request, 'beneficiary_file', 'beneficiary', $this->beneficiary->id);
                    if ($handle_1['response']['success']) {
                        $this->beneficiary->update(['file' => $handle_1['response']['payload']]);
                    }
                }
            }

            // Guardamos en ModelData
            $this->control_data($this->beneficiary, 'store');

            DB::commit();
            return $this->beneficiary->id;
        } catch (\Exception $ex) {
            report($ex);
            DB::rollBack();
            return false;
        }
    }
    public function createAttendant($request, $beneficiary_id)
    {
        DB::beginTransaction();
        try {
            $attendant = json_decode($request->attendant);
            $this->attendant->beneficiary_id = $beneficiary_id;
            $this->attendant->document_number = $attendant->document_number;
            $this->attendant->email = $attendant->email;
            $this->attendant->full_name = $attendant->full_name;
            $this->attendant->phone = $attendant->phone;
            $this->attendant->relationship = $attendant->relationship;
            $this->attendant->other_relationship= $attendant->other_relationship;
            $this->attendant->type_document = $attendant->type_document;
            $this->attendant->zone = $attendant->zone;

            $saved = $this->attendant->save();

            if ($saved) {
                if (!is_null($request->attendant_sociodemographic_characterization)) {
                    $attendant_sociodemographic_characterization  = json_decode($request->attendant_sociodemographic_characterization);

                    $disability_type = $attendant_sociodemographic_characterization->disability_type;

                    $socio_demo = $this->attendant->socio_demo()->create(
                        [
                            'gender' => $attendant_sociodemographic_characterization->gender,
                            'age' => $attendant_sociodemographic_characterization->age,
                            'decision_study' =>
                            strval($attendant_sociodemographic_characterization->decision_study),
                            'educational_level' =>  $attendant_sociodemographic_characterization->educational_level,
                            'decision_disability' =>
                            strval($attendant_sociodemographic_characterization->decision_disability),
                            'disability_type' => $disability_type != '' ? $disability_type : 'N',
                            'ethnicity' =>  $attendant_sociodemographic_characterization->ethnicity,
                            'condition' => $attendant_sociodemographic_characterization->condition
                        ]
                    );
                    // Guardamos en DataModel
                    $this->control_data($socio_demo, 'store');
                }
                if (!is_null($request->attendant_health_data)) {
                    $attendant_health_data = json_decode($request->attendant_health_data);
                    $health_data = $this->attendant->health_data()->create(
                        [
                            'other_entity_name' => $attendant_health_data->other_entity_name,
                            'entity_name_id' =>  $attendant_health_data->entity_name_id,
                            'medical_service' =>  $attendant_health_data->medical_service,
                            'health_condition' =>   $attendant_health_data->health_condition
                        ]
                    );
                    // Guardamos en DataModel
                    $this->control_data($health_data, 'store');
                }
            }
            DB::commit();

            // Guardamos en DataModel
            $this->control_data($this->attendant, 'store');

            return $this->attendant->id;
        } catch (\Exception $ex) {
            report($ex);
            DB::rollBack();
            return false;
        }
    }

    public function create($request, $type)
    {
        DB::beginTransaction();
        try {
            $id_beneficiary = NULL;
            switch ($type) {
                case 'uncharacterized':
                    $id_beneficiary = $this->createBeneficiary($request);
                    if ($id_beneficiary === false) {
                        throw new \Exception('el beneficiario no se creo correctamente ');
                    }
                    break;
                case 'characterized':

                    $id_beneficiary = $this->createBeneficiary($request);
                    if ($id_beneficiary === false) {
                        throw new \Exception('el beneficiario no se creo correctamente ');
                    }
                    break;

                case 'characterizedWithAccudent':

                    $id_beneficiary = $this->createBeneficiary($request);
                    if ($id_beneficiary  === false) {
                        throw new \Exception('el beneficiario no se creo correctamente ');
                    }

                    $id_attendant = $this->createAttendant($request, $id_beneficiary);
                    if ($id_attendant  === false) {
                        throw new \Exception('el acudiente no se creo correctamente ');
                    }

                    break;
                default:
                    break;
            }
            $user_id = $this->getIdUserAuth();
            $this->model->created_by = $user_id;
            $this->model->beneficiary_id = $id_beneficiary;
            $this->model->consecutive = $request->consecutive;
            $this->model->user_review_support_follow_id = $this->getIdUserReview()->support_tracing_monitoring_id;
            $this->model->save();

            // Guardamos en DataModel
            $this->control_data($this->model, 'store');

            DB::commit();
            return response()->json(['items' => 'Se ha guardado correctamente', 'success' => true]);
        } catch (\Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . 'Linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function findById($id)
    {
        $inscription = Inscription::findOrFail($id);
        $result = new InscriptionsResource($inscription);
        return $result;
    }

    private function is_filled($data): bool
    {
        $is_fill = true;
        $props = get_object_vars($data);
        foreach ($props as $key => $prop) {
            if ($prop == '') {
                $is_fill = false;
            }
        }

        return $is_fill;
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $identifiers =  json_decode($request->identifiers);

            $inscription = Inscription::findOrFail($identifiers->inscription_id);

            if (!$inscription) {
                return response()->json(['success' => false, 'message' => 'Inscripción a editar no encontrada.'], 404);
            }

            $beneficiary = json_decode($request->beneficiary);

            if (!is_null($inscription->benefiary)) {
                $inscription->benefiary->update((array) $beneficiary);
            } else {
                if ($beneficiary->document_number) {
                    $inscription->benefiary->create((array) $beneficiary);
                }
            }

            $beneficiary_health_data = json_decode($request->beneficiary_health_data);

            if ($this->is_filled($beneficiary_health_data)) {
                if (!is_null($identifiers->health_data_beneficiary_id)) {
                    $this->health_data->where('health_data_type',  $inscription->benefiary->getMorphClass())->where('health_data_id', $inscription->benefiary->id)
                        ->update((array) $beneficiary_health_data);
                } else {
                    if (!is_null($inscription->benefiary)) {
                        $health_data = $inscription->benefiary->health_data()->create([
                            'other_entity_name' => $beneficiary_health_data->other_entity_name,
                            'entity_name_id' => $beneficiary_health_data->entity_name_id,
                            'medical_service' => $beneficiary_health_data->medical_service,
                            'health_condition' =>  $beneficiary_health_data->health_condition
                        ]);
                        // Guardamos en DataModel
                        $this->control_data($health_data, 'store');
                    }
                }
            }

            $beneficiary_sociodemographic_characterization =  json_decode($request->beneficiary_sociodemographic_characterization);

            if ($this->is_filled($beneficiary_sociodemographic_characterization)) {
                if (!is_null($identifiers->socio_demo_beneficiary_id)) {
                    $this->sociodemographic->where('socio_demo_type',  $inscription->benefiary->getMorphClass())->where('socio_demo_id', $inscription->benefiary->id)
                        ->update((array) $beneficiary_sociodemographic_characterization);
                } else {
                    if (!is_null($inscription->benefiary)) {
                        $disability_type = $beneficiary_sociodemographic_characterization->disability_type;

                        $socio_demo = $inscription->benefiary->socio_demo()->create(
                            [
                                'gender' => $beneficiary_sociodemographic_characterization->gender,
                                'age' => $beneficiary_sociodemographic_characterization->age,
                                'decision_study' =>
                                strval($beneficiary_sociodemographic_characterization->decision_study),
                                'educational_level' => $beneficiary_sociodemographic_characterization->educational_level,
                                'decision_disability' =>
                                strval($beneficiary_sociodemographic_characterization->decision_disability),
                                'disability_type' => $disability_type != '' ? $disability_type : 'N',
                                'ethnicity' => $beneficiary_sociodemographic_characterization->ethnicity,
                                'condition' => $beneficiary_sociodemographic_characterization->condition,
                            ]
                        );
                        // Guardamos en DataModel
                        $this->control_data($socio_demo, 'store');
                    }
                }
            }

            $attendant = json_decode($request->attendant);

            if ($this->is_filled($attendant)) {
                if (!is_null($inscription->benefiary->attendant)) {
                    $inscription->benefiary->attendant->update((array) $attendant);
                } else {
                    // $this->createAttendant($request,$inscription->benefiary->id);
                    if (!empty($attendant->document_number)) {

                        $this->createAttendant($request, $inscription->benefiary->id);
                        // $inscription->benefiary->attendant->create((array) $attendant);
                    }
                }
            }

            $attendant_health_data =  json_decode($request->attendant_health_data);

            if ($this->is_filled($attendant_health_data)) {
                if (!is_null($identifiers->health_data_attendant_id)) {
                    $this->health_data->where('health_data_type',  $inscription->benefiary->attendant->getMorphClass())->where('health_data_id', $inscription->benefiary->attendant->id)
                        ->update((array) $attendant_health_data);
                } else {
                    if (!is_null($inscription->benefiary->attendant)) {
                        $health_data = $inscription->benefiary->attendant->health_data()->create(
                            [
                                'other_entity_name' => $attendant_health_data->other_entity_name,
                                'entity_name_id' =>  $attendant_health_data->entity_name_id,
                                'medical_service' =>  $attendant_health_data->medical_service,
                                'health_condition' =>   $attendant_health_data->health_condition
                            ]
                        );
                        // Guardamos en DataModel
                        $this->control_data($health_data, 'store');
                    }
                }
            }

            $attendant_sociodemographic_characterization = json_decode($request->attendant_sociodemographic_characterization);

            if ($this->is_filled($attendant_sociodemographic_characterization)) {
                if (!is_null($identifiers->socio_demo_attendant_id)) {
                    $this->sociodemographic->where('socio_demo_type',  $inscription->benefiary->attendant->getMorphClass())->where('socio_demo_id', $inscription->benefiary->attendant->id)
                        ->update((array) $attendant_sociodemographic_characterization);
                } else {
                    if (!is_null($inscription->benefiary->attendant)) {
                        $disability_type = $attendant_sociodemographic_characterization->disability_type;

                        $socio_demo = $inscription->benefiary->attendant->socio_demo()->create([
                            'gender' => $attendant_sociodemographic_characterization->gender,
                            'age' => $attendant_sociodemographic_characterization->age,
                            'decision_study' =>
                            strval($attendant_sociodemographic_characterization->decision_study),
                            'educational_level' =>  $attendant_sociodemographic_characterization->educational_level,
                            'decision_disability' =>
                            strval($attendant_sociodemographic_characterization->decision_disability),
                            'disability_type' => $disability_type != '' ? $disability_type : 'N',
                            'ethnicity' =>  $attendant_sociodemographic_characterization->ethnicity,
                            'condition' => $attendant_sociodemographic_characterization->condition
                        ]);
                        // Guardamos en DataModel
                        $this->control_data($socio_demo, 'store');
                    }
                }
            }

            if ($request->hasFile('beneficiary_file')) {
                if ($request->beneficiary_file != 'undefined') {
                    $handle_2 = $this->update_file($request, 'beneficiary_file', 'beneficiaries', $inscription->benefiary->id,  $inscription->benefiary->file);
                    $inscription->benefiary->update(['file' => $handle_2['response']['payload']]);
                }
            }

            // Guardamos en DataModel
            $this->control_data($inscription, 'update');

            if ($inscription->status == 'REC') {
                $rol_id = $this->getIdRolUserAuth();
                if ($rol_id == config('roles.monitor') || $rol_id == config('roles.instructor') || $rol_id == config('roles.lider_instructor')) {
                    $inscription->status = 'ENREV';
                }
            }

            $inscription->save();

            $result = new InscriptionsResource($inscription);
            DB::commit();
            return response()->json(['items' => 'Se ha guardado correctamente', 'success' => true]);
        } catch (\Exception $ex) {
            report($ex);
            DB::rollBack();
            return response()->json(['error' => 'Algo salio mal ' . $ex->getMessage() . 'Linea ' . $ex->getCode(), 'success' => false], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function delete($id)
    {
        $inscription = Inscription::findOrFail($id);
        $inscription->delete();

        return response()->json(['items' => 'Se ha eliminado correctamente']);
    }

    /**
     * Convert to boolean
     *
     * @param $booleable
     * @return boolean
     */
    private function toBoolean($booleable)
    {
        return filter_var($booleable, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }

    public function validator($data, $type)
    {
        $validator = NULL;

        $beneficiary_validate = [
            'nac_id' => 'required',
            'neighborhood_id' => 'required',
            'full_name' => 'required',
            'accept' => 'required',
            'linkage_project' => 'required',
            'participant_type' => 'required',
            'type_document' => 'required',
            'document_number' => ['required', Rule::unique(Beneficiary::class,), 'integer'],
            'email' => [Rule::unique(Beneficiary::class), 'email'],
            'zone' => 'required',
            'stratum' => 'required',
            'phone' => 'required|integer',
        ];

        $attendant_validate = [
            'full_name' => 'required',
            'type_document' => 'required',
            'document_number' => ['required', 'integer'],
            'email' => 'email',
            'zone' => 'required',
            'phone' => 'required|integer',
        ];

        $soc_validate = [
            'gender' => 'required',
            'age' => 'required',
            'decision_study' => 'required',
            'decision_disability' => 'required',
            'educational_level' => 'required',
            'ethnicity' => 'required',
            'condition' => 'required',
        ];

        $health_validate = [
            'entity_name_id' => 'required',
            'medical_service' => 'required',
            'health_condition' => 'required',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'unique' => 'Ya existe un beneficiario con este :attribute.',
        ];

        $attrs = [
            'document_number' => 'numero de identidad',
            'entity_name_id' => 'EPS'
        ];

        function uncharacterized($data, $validation, $messages, $attrs): \Illuminate\Validation\Validator
        {
            $validator = Validator::make($data, $validation, $messages, $attrs);
            return $validator;
        }

        function characterized($d, $s, $h, $vd, $vs, $vh, $messages, $attrs): \Illuminate\Validation\Validator
        {
            $validator = uncharacterized($d, $vd, $messages, $attrs);

            if ($validator->fails()) {
                return $validator;
            } else {
                $validator = Validator::make($s, $vs, $messages, $attrs);

                if ($validator->fails()) {
                    return $validator;
                } else {
                    $validator = Validator::make($h, $vh, $messages, $attrs);
                    return $validator;
                }
            }
        }

        function attendant($d, $s, $h, $vd, $vs, $vh): \Illuminate\Validation\Validator
        {
            $validator = Validator::make($d, $vd);

            if ($validator->fails()) {
                return $validator;
            } else {
                $validator = Validator::make($s, $vs);

                if ($validator->fails()) {
                    return $validator;
                } else {
                    $validator = Validator::make($h, $vh);
                    return $validator;
                }
            }
        }

        if ($type == 'uncharacterized') {
            $beneficiary_data = json_decode($data['beneficiary']);

            return uncharacterized((array) $beneficiary_data, $beneficiary_validate, $messages, $attrs);
        } else if ($type == 'characterized') {
            $beneficiary_data = json_decode($data['beneficiary']);
            $beneficiary_soc = json_decode($data['beneficiary_sociodemographic_characterization']);
            $beneficiary_health_data = json_decode($data['beneficiary_health_data']);

            return characterized(
                (array) $beneficiary_data,
                (array) $beneficiary_soc,
                (array) $beneficiary_health_data,
                $beneficiary_validate,
                $soc_validate,
                $health_validate,
                $messages,
                $attrs
            );
        } else {
            $beneficiary_data = json_decode($data['beneficiary']);
            $beneficiary_soc = json_decode($data['beneficiary_sociodemographic_characterization']);
            $beneficiary_health_data = json_decode($data['beneficiary_health_data']);

            $validator = characterized((array) $beneficiary_data, (array) $beneficiary_soc, (array) $beneficiary_health_data, $beneficiary_validate, $soc_validate, $health_validate, $messages, $attrs);

            if ($validator->fails()) {
                return $validator;
            } else {
                $attendant_data = json_decode($data['attendant']);
                $attendant_soc = json_decode($data['attendant_sociodemographic_characterization']);
                $attendant_health_data = json_decode($data['attendant_health_data']);

                return attendant((array) $attendant_data, (array) $attendant_soc, (array) $attendant_health_data, $attendant_validate, $soc_validate, $health_validate);
            }
        }
    }
    public function validatorUpdate($data, $type)
    {
        $validator = NULL;

        $beneficiary_data = json_decode($data['beneficiary']);
        $beneficiary_soc = json_decode($data['beneficiary_sociodemographic_characterization']);
        $beneficiary_health_data = json_decode($data['beneficiary_health_data']);
        $attendant_data = json_decode($data['attendant']);
        $attendant_soc = json_decode($data['attendant_sociodemographic_characterization']);
        $attendant_health_data = json_decode($data['attendant_health_data']);
        $identifiers =  json_decode($data['identifiers']);

        $beneficiary_validate = [
            'nac_id' => 'required',
            'neighborhood_id' => 'required',
            'full_name' => 'required',
            'accept' => 'required',
            'linkage_project' => 'required',
            'participant_type' => 'required',
            'type_document' => 'required',
            'document_number' => 'required|integer|unique:beneficiaries,document_number,' . $identifiers->beneficiary_id,
            'email' => 'email|unique:beneficiaries,email,' . $identifiers->beneficiary_id,
            'zone' => 'required',
            'stratum' => 'required',
            'phone' => 'required|integer',
        ];
        // |unique:beneficiaries,document_number,' . $identifiers->attendant_id,
        $attendant_validate = [
            'full_name' => 'required',
            'type_document' => 'required',
            'document_number' => 'required|integer',
            'email' => 'email|unique:beneficiaries,email,' . $identifiers->attendant_id,
            'zone' => 'required',
            'phone' => 'required|integer',
        ];

        $soc_validate = [
            'gender' => 'required',
            'age' => 'required',
            'decision_study' => 'required',
            'decision_disability' => 'required',
            'educational_level' => 'required',
            'ethnicity' => 'required',
            'condition' => 'required',
        ];

        $health_validate = [
            'entity_name_id' => 'required',
            'medical_service' => 'required',
            'health_condition' => 'required',
        ];

        $messages = [
            'required' => ':attribute es obligatorio.',
            'unique' => 'Ya existe un beneficiario con este :attribute.',
        ];

        $attrs = [
            'document_number' => 'numero de identidad',
            'entity_name_id' => 'EPS'
        ];

        function uncharacterizedUpdate($data, $validation, $messages, $attrs): \Illuminate\Validation\Validator
        {
            $validator = Validator::make($data, $validation, $messages, $attrs);
            return $validator;
        }

        function characterizedUpdate($d, $s, $h, $vd, $vs, $vh, $messages, $attrs): \Illuminate\Validation\Validator
        {
            $validator = uncharacterizedUpdate($d, $vd, $messages, $attrs);

            if ($validator->fails()) {
                return $validator;
            } else {
                $validator = Validator::make($s, $vs, $messages, $attrs);

                if ($validator->fails()) {
                    return $validator;
                } else {
                    $validator = Validator::make($h, $vh, $messages, $attrs);
                    return $validator;
                }
            }
        }

        function attendantUpdate($d, $s, $h, $vd, $vs, $vh): \Illuminate\Validation\Validator
        {
            $validator = Validator::make($d, $vd);

            if ($validator->fails()) {
                return $validator;
            } else {
                $validator = Validator::make($s, $vs);

                if ($validator->fails()) {
                    return $validator;
                } else {
                    $validator = Validator::make($h, $vh);
                    return $validator;
                }
            }
        }

        $validator = uncharacterizedUpdate((array) $beneficiary_data, $beneficiary_validate, $messages, $attrs);

        if ($validator->fails()) {
            return $validator;
        } else {
            if ($this->is_filled($beneficiary_soc)) {
                $validator = Validator::make((array) $beneficiary_soc, $soc_validate, $messages, $attrs);

                if ($validator->fails()) {
                    return $validator;
                } else {
                    if ($this->is_filled($beneficiary_health_data)) {
                        $validator = Validator::make((array) $beneficiary_health_data, $health_validate, $messages, $attrs);
                        return $validator;
                    } else {
                        if ($this->is_filled($attendant_data)) {
                            return attendantUpdate((array) $attendant_data, (array) $attendant_soc, (array) $attendant_health_data, $attendant_validate, $soc_validate, $health_validate);
                        }
                    }
                }
            } else {
                return $validator;
            }
        }
        return $validator;
    }
}
