<?php

namespace App\Models;

use App\Model\Procedure;
use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{
    const STORE_GROUP_QUESTION = 'store_group_question';

    const UPDATE_GROUP_QUESTION = 'update_group_question';

    const DELETE_GROUP_QUESTION = 'delete_group_question';

    const READ_GROUP_QUESTION = 'read_group_question';


    private $attribute = array(
        'title' => 'Titúlo',
        'priority' => 'Prioridade',
        'procedure_id' => 'Procedimento'
    );

    public function procedure(){
        return $this->belongsTo(Procedure::class);
    }

    public function getLastPriority($procedure_id)
    {
        $groupQuestions = readByProcedure($procedure_id);
        return $groupQuestions->lenth >0 ? $groupQuestions->last->priority+1: 1;
    }

    public function create($object, $arguments = [])
    {
        if(ValidatorModel::validation($this->inputs($object),$this->rules(),$this->attribute)){
            return $object->save();
        }
    }

    public function readByProcedure($procedure_id)
    {
        return GroupQuestion::where('procedure_id', $procedure_id)->orderBy('priority','ASC')->get();
    }

    public function filter($input = [])
    {
    }

    public function inputs($object)
    {
        return [
            'title' => $object->title,
            'priority' => $object->priority,
            'procedure_id' => $object->procedure_id
        ];
    }

    public function rules($id = 0)
    {
        return [
            'title' => 'required',
            'priority' => 'required',
            'procedure_id' => 'required|numeric|min:0'
        ];
    }



}
