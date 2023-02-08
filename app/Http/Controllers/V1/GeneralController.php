<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\GroupCollection;
use App\Http\Resources\V1\GroupResource;
use App\Models\CulturalRight;
use App\Models\Asistant;
use App\Models\Binnacle;
use App\Models\ControlChangeData;
use App\Models\EntityName;
use App\Models\Expertise;
use App\Models\Group;
use App\Models\Inscriptions\Beneficiary;
use App\Models\Inscriptions\Inscription;
use App\Models\Module;
use App\Models\Nac;
use App\Models\Neighborhood;
use App\Models\Orientation;
use App\Models\Inscriptions\Pec;
use App\Models\Pedagogical;
use App\Models\Poll;
use App\Models\PollDesertion;
use App\Models\Role;
use App\Models\User;
use App\Traits\FunctionGeneralTrait;
use Illuminate\Http\Request;
use App\Traits\UserDataTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class GeneralController extends Controller
{
    use UserDataTrait, FunctionGeneralTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataSelects()
    {
        $monitors = [];
        $managers = [];
        $rol_id = $this->getIdRolUserAuth();
        $group_beneficiaries = [];
        $beneficiaries_table = [];

        if (config('roles.gestor') == $this->getIdRolUserAuth()) {

            $monitors = User::whereHas('roles', function ($query) {
                $roles_where =  [14, 15, 16];
                $gestor_id =  $this->getIdUserAuth();
                $query->whereHas('users.profile', function ($query_role) use ($gestor_id) {
                    $query_role->where("profiles.gestor_id",  $gestor_id);
                });
                $query->whereHas('users.roles', function ($query_role) use ($roles_where) {
                    $query_role->whereIn("roles.id",  $roles_where);
                });
            })->select('users.name as label', 'users.id as value')->get();

            $managers = User::whereHas('roles', function ($query) {
                $roles_where =  13;
                $gestor_id =  $this->getIdUserAuth();
                $query->whereHas('users.profile', function ($query_role) use ($gestor_id) {
                    $query_role->where("profiles.gestor_id",  $gestor_id);
                });
                $query->whereHas('users.roles', function ($query_role) use ($roles_where) {
                    $query_role->where("roles.id",  $roles_where);
                });
            })->select('users.name as label', 'users.id as value')->get();
        } else {


            $monitors = User::whereHas('roles', function ($query) {
                $query->where('roles.id', 14);
            })->select('users.name as label', 'users.id as value')->get();


            $managers = User::whereHas('roles', function ($query) {
                $query->where('roles.id', 13);
            })->select('users.name as label', 'users.id as value')->get();
        }


        $assistants = Asistant::get();
        $beneficiaries = Beneficiary::select('id', 'id as value', 'full_name as label', 'document_number as nuip')->get();


        if (config('roles.root') == $this->getIdRolUserAuth() || config('roles.super_root') == $this->getIdRolUserAuth()) {
            $beneficiaries_table = Beneficiary::select('id', 'full_name', 'document_number as nuip')->get();
        } else {
            $beneficiaries_table = Beneficiary::select('id', 'full_name', 'document_number as nuip')->where('created_by', $this->getIdUserAuth())->get();
        }

        $culturalRights = CulturalRight::select('name as label', 'id as value')->get();
        $data = config('selectsDefault');
        $entityNames = EntityName::select('name as label', 'id as value')->get();
        $expertises = Expertise::select('name as label', 'id as value')->orderBy('name', 'ASC')->get();
        $modules = Module::select('name as label', 'id as value')->get();
        $nacs = Nac::select('name as label', 'id as value')->get();
        $neighborhoods = Neighborhood::select('name as label', 'id as value')->get();
        $orientations = Orientation::select('name as label', 'id as value')->get();
        $pecs = Pec::query()->select('consecutive as label', 'id as value')->get();
        $pedagogicals = Pedagogical::query()->select('consecutive as label', 'id as value')->get();
        $roles = Role::select('name as label', 'slug as value')->get();
        $roles_display = Role::select('name as label', 'id as value')->get();

        $users_table = User::query()->with(['profile' => function ($query) {
            $query->select('user_id', 'document_number', 'contractor_full_name');
        }])->select('id', 'name')->get();

        if (config('roles.gestor') == $this->getIdRolUserAuth()) {
            $monitors_table = User::query()->whereHas('roles', function ($query) {
                $query->whereIn('slug', ['monitor_cultural']);
            })->with(['profile' => function ($query) {
                $query->select('user_id', 'document_number', 'contractor_full_name', 'nac_id', 'role_id');
            }])->get();
        } else {

            $monitors_table = User::query()->whereHas('roles', function ($query) {
                $query->whereIn('slug', ['monitor_cultural', 'embajador', 'instructor']);
            })->with(['profile' => function ($query) {
                $query->select('user_id', 'document_number', 'contractor_full_name', 'nac_id', 'role_id');
            }])->get();
        }

        $monitors_parentschools = User::query()->whereHas('roles', function ($query) {
            $query->whereIn('slug', ['monitor_cultural', 'embajador', 'instructor']);
        })->with(['profile' => function ($query) {
            $query->select('user_id', 'document_number', 'contractor_full_name');
        }])->get();


        // $user_id = $this->getIdUserAuth();
        if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
            $group_beneficiaries = Group::whereHas('beneficiaries')->select('groups.id as value', 'groups.name as label')->get();
        } else {
            $group_beneficiaries = Group::whereHas('beneficiaries', function ($query) {
                $query->where('created_by',  $this->getIdUserAuth());
            })->select('groups.id as value', 'groups.name as label')->get();
        }


        // // instructores,envajadores,monitores
        $data['assistants'] = $assistants;
        $data['beneficiaries_table'] = $beneficiaries_table;
        $data['beneficiaries'] = $beneficiaries;
        $data['cultural_rights'] = $culturalRights;
        $data['entity_names'] = $entityNames;
        $data['expertises'] = $expertises;
        $data['managers'] = $managers;
        $data['modules'] = $modules;
        $data['monitors_parentschools'] = $monitors_parentschools ?? [];
        $data['monitors_table'] = $monitors_table ?? [];
        $data['monitors'] = $monitors ?? [];
        $data['nacs'] = $nacs;
        $data['neighborhoods'] = $neighborhoods;
        $data['orientations'] = $orientations;
        $data['pecs'] = $pecs;
        $data['pedagogicals'] = $pedagogicals;
        $data['roles'] = $roles;
        $data['roles_display'] = $roles_display;
        $data['users_table'] = $users_table;
        $data['group_beneficiaries'] = $group_beneficiaries;

        return response()->json(
            $data
        );
    }

    public function getData(Request $request)
    {
        // $user_id = $this->getIdUserAuth();
        $group = Group::find(4);
        return  $group->beneficiaries;
        $date = Carbon::now();
        // $entidad = EntityName::find($request->id);
        // $entidad->name = $request->name;
        // $entidad->save();
        // $entidad->control_data()->create([
        //     'user_id' => 1,
        //     'action' => 'update',
        //     'data_original' => $entidad->getOriginal(),
        //     'data_change' => $entidad->getChanges(),
        //     'created_at' => $date,

        // ]);

        // Crear
        $entidad = EntityName::create([
            'name' => $request->name,
            'user_id' => 1
        ]);
        $entidad->control_data()->create([
            'user_id' => 1,
            'action' => 'store',
            'data_original' => $entidad->getOriginal(),
            'data_change' => $entidad->getChanges(),
            'created_at' => $date,
        ]);

        return response()->json(
            $entidad

        );
    }
    public function getConsecutive(Request $request)
    {
        $response = DB::select("SELECT COUNT(id) as consecutive FROM $request->table");
        $count = count($response);
        return response()->json($count == 0 ? $request->abreviature . '1' : $request->abreviature . $response[0]->consecutive + 1, 200);
    }
    public function getChangeDataModels()
    {
        try {
            $response = ControlChangeData::with('user')->get();
            return  $this->createResponse($response, 'Data');
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar la data' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function destroyChangeDataModel(Request $request)
    {
        try {
            $results =  ControlChangeData::find($request->id)->delete();
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al eliminar el data' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
        return $results;
    }
    public function getGroupBeneficiaries($id)
    {
        try {

            if ($id == '' || $id == null || $id == 'undefined') {
                return  $this->createErrorResponse([], 'Se requiere enviar el id del grupo.');
            }
            $rol_id = $this->getIdRolUserAuth();
            $user_id = $this->getIdUserAuth();
            $query = Group::query();

            $beneficiaries = $query->find($id);

            $groupBeneficiaries = [];
            if ($rol_id == config('roles.root') || $rol_id == config('roles.super_root')) {
                $groupBeneficiaries = $query->where('id', $id)->get();
            }
            if ($rol_id == config('roles.monitor') || $rol_id == config('roles.instructor')) {
                $groupBeneficiaries =    $beneficiaries->whereHas('beneficiaries', function ($beneficiary) use ($user_id) {
                    $beneficiary->where('beneficiaries.created_by', $user_id);
                })->get();
            }
            return response()->json(new GroupCollection($groupBeneficiaries));
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al listar beneficiario por grupo ' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
    public function getDataForm()
    {
        try {
            $user_id = $this->getIdUserAuth();
            $info = [
                'monitor' => [
                    'pecs' => Pec::where('created_by', $user_id)->count(),
                    'inscriptions' => Inscription::where('created_by', $user_id)->count(),
                    'pedagogicals' => Pedagogical::where('created_by', $user_id)->count(),
                    'binnacles' => Binnacle::where('created_by', $user_id)->count(),
                    'pollDesertions' => PollDesertion::where('user_id', $user_id)->count(),
                ],
                'polls' => Poll::where('user_id', $user_id)->count()
                // 'manager' => [

                // ],
                // 'psychosocial' => [

                // ]

            ];

            return response()->json(['items' => $info]);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al mostar cantidad de datos de los formularios' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }

    public function getPollOnly()
    {
        try {
            $user_id = $this->getIdUserAuth();
            $info = [
                'polls' => Poll::where('user_id', $user_id)->count()
            ];

            return response()->json(['items' => $info]);
        } catch (\Exception $ex) {
            return  $this->createErrorResponse([], 'Algo salio mal al mostrar el numero de Encuestas del usuario.' . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
