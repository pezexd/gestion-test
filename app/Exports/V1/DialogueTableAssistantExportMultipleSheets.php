<?php

namespace App\Exports;

use App\Exports\V1\AssistantExport;
use App\Exports\V1\DialogueTableExport;
use App\Http\Resources\V1\DialogueTableCollection;
use App\Models\DialogueTables\DialogueTable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DialogueTableAssistantExportMultipleSheets implements WithMultipleSheets
{
    use Exportable;

    protected $data;
    protected  $dialogueTable;

    public function __construct($data)
    {
        $this->data = $data;
        $this->dialogueTable = new DialogueTable();
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[0] = new DialogueTableExport($this->data);
        $sheets[1] = new AssistantExport($this->data);

        return $sheets;
    }
}
