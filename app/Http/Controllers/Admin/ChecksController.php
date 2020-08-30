<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Check;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CheckExport;
use App\Imports\CheckImport;
use Illuminate\Support\Str;

class ChecksController extends Controller
{

    public function index(Request $request)
    {
        $whereParameters = [];
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $status = $request->get('status');
        $type = $request->get('type');
        $perPage = 25;
        $fc = 0;
        if(!empty($filter)){
            $filter = str_replace(' ', '', request()->input('filter'));
            $date_from = Carbon::parse(explode('-', $filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $filter)[1])->format('Y-m-d');
            array_push($whereParameters,
                ['created_at', '>', $date_from . ' 00:00:00'],
                ['created_at', '<', $date_to . ' 23:59:59']);
        }

        if(!empty($status)){
            array_push($whereParameters,
                ['status', '=', $status]
            );
        }

        if(!empty($type)){
            array_push($whereParameters,
                ['type', '=', $type]
            );
        }

        $query = Check::where($whereParameters);
        if(!empty($keyword)){
            $query = $query->whereHas('user', function($q) use($keyword){
                $q->where('email', 'LIKE', "%$keyword%");
            });
        }
        $fc = $query->count();
        $checks = $query->latest()->paginate($perPage);

        return view('admin.checks.index', compact('checks', 'fc'));
    }


    public function create()
    {

        return view('admin.checks.create');
    }


    public function store(Request $request)
    {
        $data = $request->only(['check', 'cash']);
        $validator = Validator::make($data , [
            'check' => 'required',
            'cash' => 'required'
        ]);
        if($validator->fails()){
            return redirect('/#check')
                ->withErrors($validator)->withInput();
        }
        $data = $validator->validated();

        $check = Check::create([
            'check' => $data['check'],
            'cash' => $data['cash'],
            'user_id' => Auth::id()
        ]);

        return redirect('/#check-success');
//        $validator = Validator::make($request->only(['photo']) , [
//            'photo' => 'file|max:4000|mimes:jpeg,png'
//        ]);

//        if($validator->fails()){
//            if(Auth::user()->type == 'admin'){
//                return redirect('/#authorization')
//                    ->withErrors($validator)->withInput();
//            }
//            else{
//                response()->json([], 500);
//            }
//        }
//        $requestData = $request->all();
//        if ($request->hasFile('photo')) {
//            $requestData['photo'] = $request->file('photo')->store('uploads', 'public');
//            $requestData['status'] = 'Не проверено';
//            $requestData['user_id'] = Auth::id();
//        }

//        $check = Check::create($requestData);

//        if(Auth::user()->type == 'admin'){
//            return redirect('admin/checks')->with('flash_message', 'Check added!');
//        }
//        else{
//            $check = $check->toArray();
//            $check['created_at'] = (new Carbon($check['created_at']))->format('d.m.Y');
//            return response()->json([
//                'check' => $check,
//            ], 200);
//        }

    }


    public function show($id)
    {
        $check = Check::findOrFail($id);

        return view('admin.checks.show', compact('check'));
    }


    public function edit($id)
    {
        $check = Check::findOrFail($id);

        return view('admin.checks.edit', compact('check'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'photo' => 'file|max:4000|mimes:jpeg,png'
		]);
        $requestData = $request->all();
                if ($request->hasFile('photo')) {
            $requestData['photo'] = $request->file('photo')
                ->store('uploads', 'public');
        }

        $check = Check::findOrFail($id);
        $check->update($requestData);

        return redirect('admin/checks')->with('flash_message', 'Check updated!');
    }


    public function destroy(Request $request, $id)
    {
        Check::destroy($id);

        return redirect('admin/checks')->with('flash_message', 'Check deleted!');
    }
    public function export(Request $request){
        $whereParameters = [];
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $status = $request->get('status');
        $type = $request->get('type');
        $perPage = 25;
        $fc = 0;
        if(!empty($filter)){
            $filter = str_replace(' ', '', request()->input('filter'));
            $date_from = Carbon::parse(explode('-', $filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $filter)[1])->format('Y-m-d');
            array_push($whereParameters,
                ['created_at', '>', $date_from . ' 00:00:00'],
                ['created_at', '<', $date_to . ' 23:59:59']);
        }

        if(!empty($status)){
            array_push($whereParameters,
                ['status', '=', $status]
            );
        }

        if(!empty($type)){
            array_push($whereParameters,
                ['type', '=', $type]
            );
        }
        $query = Check::where($whereParameters);
        if(!empty($keyword)){
            $query = $query->whereHas('user', function($q) use($keyword){
                $q->where('email', 'LIKE', "%$keyword%");
            });
        }
        $fc = $query->count();
        $checks = $query->get();

        return Excel::download(new CheckExport($checks), 'checksExport-from-'.Carbon::now().'.xlsx');
    }
    public function import(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = Excel::toArray(new CheckImport, $path);
        $data = $data[0];

        return redirect('admin/checks/imported')->with('success', $data);
    }
    public function imported(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData)) {
            $url = explode('/', url()->previous());
            $go = $url[count($url)-2];
            $model = $url[count($url)-2];
            $model =  ucfirst(Str::singular($model));

            $model = str_replace(" ", "", 'App\ '.$model);
            foreach ($request->photo as $id => $item)
            {
                $model::create([
                    'photo' => $request->photo[$id],
                	'status' => $request->status[$id],
                	'user_id' => $request->user_id[$id],

                ]);
            }

            return redirect('admin/'.$go);
        }
         else
            return view('admin/imported');
    }
}
