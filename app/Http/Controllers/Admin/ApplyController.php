<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Services\ApplyDownloadFormCsvService as FormCsv;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    private $form;

    public function __construct(Form $form)
    {
        $this->middleware('auth:admin');
        $this->form = $form;
    }

    public function index(Request $request, FormCsv $csv)
    {
        // buttonがcsvの時はCSVを出力
        if ($request->input('button') === 'csv') {
            return $csv->downloadCsv($request, $this->form);
        }

        return view('admin.apply.index', [
            'forms' => $this->form->acquisitionFormList($request),
        ]);
    }

    public function show(Int $id)
    {
        $form = $this->form->acquisitionApplyInfomation($id);

        return view('admin.apply.show', [
            'form' => $form,
        ]);
    }
}
