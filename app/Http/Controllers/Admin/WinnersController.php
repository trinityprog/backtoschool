<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Winner;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\WinnerExport;
use App\Imports\WinnerImport;
use Illuminate\Support\Str;

class WinnersController extends Controller
{

    public function index(Request $request)
    {
        $whereParameters = [
            ['status', '!=' , -1],
        ];
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $from = $request->get('from');
        $perPage = 25;

        if(!empty($filter)){
            $filter = str_replace(' ', '', request()->input('filter'));
            $date_from = Carbon::parse(explode('-', $filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $filter)[1])->format('Y-m-d');
            array_push($whereParameters,
                ['date_win', '>', $date_from . ' 00:00:00'],
                ['date_win', '<', $date_to . ' 23:59:59']);
        }

        if(!empty($from)){
            array_push($whereParameters,
                ['from', '=', $from]
            );
        }
        if(!empty($keyword)){
            array_push($whereParameters,
                ['phone', 'LIKE', "%$keyword%"]
            );
        }



        $winners = Winner::where($whereParameters)->latest()->paginate($perPage);


        return view('admin.winners.index', compact('winners'));
    }


    public function create()
    {

        return view('admin.winners.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|min:2|max:20|alpha',
			'phone' => 'required|size:16',
			'city' => 'required|min:2|max:20|alpha',
			'prize' => 'required|min:2|max:20'
		]);

        $requestData = $request->all();
        $requestData["date_win"] = Carbon::parse($requestData["date_win"])->toDateTimeString();
        Winner::create($requestData);

        return redirect('admin/winners')->with('flash_message', 'Winner added!');
    }


    public function show($id)
    {
        $winner = Winner::findOrFail($id);

        return view('admin.winners.show', compact('winner'));
    }


    public function edit($id)
    {
        $winner = Winner::findOrFail($id);

        return view('admin.winners.edit', compact('winner'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required|min:2|max:20|alpha',
			'phone' => 'required|size:16',
			'city' => 'required|min:2|max:20|alpha',
			'prize' => 'required|min:2|max:20'
		]);
        $requestData = $request->all();

        $winner = Winner::findOrFail($id);
        $winner->update($requestData);

        return redirect('admin/winners')->with('flash_message', 'Winner updated!');
    }


    public function destroy(Request $request, $id)
    {
        $winner = Winner::find($id);
        $winner->status = -1;
        $winner->save();


        return redirect('admin/winners')->with('flash_message', 'Winner deleted!');
    }
    public function export($date){
        return Excel::download(new WinnerExport($date), 'winnersExport-from-'.Carbon::now().'.xlsx');
    }
    public function import(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = Excel::toArray(new WinnerImport, $path);
        $data = $data[0];

        return redirect('admin/winners/imported')->with('success', $data);
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
            foreach ($request->name as $id => $item)
            {
                $model::create([
                    'name' => $request->name[$id],
                	'phone' => $request->phone[$id],
                	'city' => $request->city[$id],
                	'prize' => $request->prize[$id],
                	'type' => $request->type[$id]
                ]);
            }

            return redirect('admin/'.$go);
        }
         else
            return view('admin/imported');
    }
}
