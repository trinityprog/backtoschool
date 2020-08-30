<?php

namespace App\Http\Controllers\Admin;


use App\Exports\UsersExport;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use App\Imports\UserImport;
use Illuminate\Support\Str;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $whereParameters = [
            ['type', '!=' , 'admin'],
            ['status', '!=' , -1],
        ];
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $from = $request->get('from');
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

        if(!empty($from)){
            array_push($whereParameters,
                ['from', 'LIKE', "%$from%"]
            );
        }
        if(!empty($keyword)){
            array_push($whereParameters,
                ['email', 'LIKE', "%$keyword%"]
            );
        }

        $query = User::where($whereParameters);

        $fc = $query->count();
        $users = $query->latest()->paginate($perPage);


        return view('admin.users.index', compact('users', 'fc'));
    }



    public function export(Request $request){
        $whereParameters = [
            ['type', '!=' , 'admin'],
            ['status', '!=' , -1],
        ];
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $from = $request->get('from');
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

        if(!empty($type)){
            array_push($whereParameters,
                ['from', 'LIKE', "%$from%"]
            );
        }
        if(!empty($keyword)){
            array_push($whereParameters,
                ['email', 'LIKE', "%$keyword%"]
            );
        }

        $query = User::where($whereParameters);
        $users = $query->withCount('checks')->get();

        return Excel::download(new UsersExport($users), 'usersExport-from-'.Carbon::now().'.xlsx');
    }
//    public function import(Request $request){
//        $path1 = $request->file('file')->store('temp');
//        $path=storage_path('app').'/'.$path1;
//        $data = Excel::toArray(new UserImport, $path);
//        $data = $data[0];
//
//        return redirect('admin/users/imported')->with('success', $data);
//    }
//    public function imported(Request $request)
//    {
//        $requestData = $request->all();
//        if(!empty($requestData)) {
//            $url = explode('/', url()->previous());
//            $go = $url[count($url)-2];
//            $model = $url[count($url)-2];
//            $model =  ucfirst(Str::singular($model));
//
//            $model = str_replace(" ", "", 'App\ '.$model);
//            foreach ($request->name as $id => $item)
//            {
//                $model::create([
//                    'name' => $request->name[$id],
//                	'email' => $request->email[$id],
//
//                ]);
//            }
//
//            return redirect('admin/'.$go);
//        }
//         else
//            return view('admin/imported');
//    }
//
//    public function create()
//    {
//
//        return view('admin.users.create');
//    }
//
//
//    public function store(Request $request)
//    {
//
//        $requestData = $request->all();
//
//        User::create($requestData);
//
//        return redirect('admin/users')->with('flash_message', 'User added!');
//    }
//
//
//    public function show($id)
//    {
//        $user = User::findOrFail($id);
//
//        return view('admin.users.show', compact('user'));
//    }
//
//
//    public function edit($id)
//    {
//        $user = User::findOrFail($id);
//
//        return view('admin.users.edit', compact('user'));
//    }
//
//
//    public function update(Request $request, $id)
//    {
//
//        $requestData = $request->all();
//
//        $user = User::findOrFail($id);
//        $user->update($requestData);
//
//        return redirect('admin/users')->with('flash_message', 'User updated!');
//    }
//
//
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = -1;
        $user->save();

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
