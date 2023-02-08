<?php

namespace App\Models;

use App\Traits\FunctionGeneralTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MethodologicalSheetsOne extends Model
{
    use HasFactory;
    use FunctionGeneralTrait;

    protected $table = 'methodological_sheets_one';
    protected $fillable = [
        'consecutive',
        'semillero_name',
        'date_range',
        'filter_level',
        'worked_expertise',
        'characteristics_process',
        'objective_process',
        'comments',
        'group_id',
        'cultural_right_id',
        'orientation_id',
        'valor_id',
        'lineament_id'
    ];


    public function control_data()
    {
        return $this->morphMany(ControlChangeData::class, 'data_model');
    }
}
