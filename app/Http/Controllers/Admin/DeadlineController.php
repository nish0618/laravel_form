<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeadlineRequest;
use App\Models\Deadline;
use Illuminate\Http\Request;

class DeadlineController extends Controller
{
    private $deadline;

    public function __construct(Deadline $deadline)
    {
        $this->deadline = $deadline;
    }
    
    public function index(Request $request)
    {
        return view('deadline.index', [
            'deadlines' => $this->deadline->acquisitionDeadlineList($request),
        ]);
    }

    public function edit($id)
    {
        $deadline = $this->deadline->acquisitionDeadlineInformation($id);

        return view('deadline.edit', [
            'deadline' => $deadline,
        ]);
    }

    public function update(StoreDeadlineRequest $request, $id)
    {
        if($request->action === 'back'){
            return redirect()->route('admin.deadline.index');
        } else {
            $deadline = Deadline::find($id);
            $deadline->end_publication_period = $request->end_publication_period;
            $deadline->end_gift_redemption = $request->end_gift_redemption;
            $deadline->save();
            return back()->with('success', '編集完了しました');
        }
    }

}
