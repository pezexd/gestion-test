<?php

namespace App\Models\DialogueTables;

use Illuminate\Database\Eloquent\Model;

class AsistantDialogueTable extends Model
{
    protected $table = "assistant_dialogue_table";

    protected $fillable = [
        "dialogue_table_id",
        "assistant_id"

    ];
}
