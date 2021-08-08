<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\StoreFormRequest;
use App\Models\Form;

class Questionnaire extends Model
{
    protected $fillable = [
        'form_id',
        'key',
        'value',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function storeQuestionnaireFirst(StoreFormRequest $request, Int $form_id)
    {
        if (empty($request->answer_first)) {
            $request->answer_first = [];
        }
        for ($i = 0; $i < count($request['answer_first']); $i++) {
            $this->create([
                'form_id' => $form_id,
                'key'     => $request['quesion_first'],
                'value'   => $request['answer_first'][$i],
            ]);
        }
    }
}
