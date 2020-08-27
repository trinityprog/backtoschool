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
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $perPage = 25;

        if (!empty($keyword)) {
            $winners = Winner::where('name', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('prize', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } elseif(!empty($filter)){
            $filter = str_replace(' ', '', request()->input('filter'));
            $date_from = Carbon::parse(explode('-', $filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $filter)[1])->format('Y-m-d');
            $winners = Winner::whereBetween('created_at', [$date_from.' 00:00:00', $date_to.' 23:59:59'])
                ->latest()->paginate($perPage);
        }
        else {
            $winners = Winner::latest()->paginate($perPage);
        }

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
			'phone' => 'required|size:14',
			'city' => 'required|min:2|max:20|alpha',
			'prize' => 'required|min:2|max:20'
		]);
        $requestData = $request->all();
        
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
			'phone' => 'required|size:14',
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
        Winner::destroy($id);

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
