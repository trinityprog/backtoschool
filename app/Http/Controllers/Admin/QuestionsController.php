<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail\QuestionAnswered;
use App\Mail\QuestionCreated;
use App\Question;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\QuestionExport;
use App\Imports\QuestionImport;
use Illuminate\Support\Str;

class QuestionsController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $perPage = 25;

        if (!empty($keyword)) {
            $questions = Question::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('question', 'LIKE', "%$keyword%")
                ->orWhere('answer', 'LIKE', "%$keyword%")
                ->orWhere('answered', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } elseif(!empty($filter)){
            $filter = str_replace(' ', '', request()->input('filter'));
            $date_from = Carbon::parse(explode('-', $filter)[0])->format('Y-m-d');
            $date_to = Carbon::parse(explode('-', $filter)[1])->format('Y-m-d');
            $questions = Question::whereBetween('created_at', [$date_from.' 00:00:00', $date_to.' 23:59:59'])
                ->latest()->paginate($perPage);
        }
        else {
            $questions = Question::latest()->paginate($perPage);
        }

        return view('admin.questions.index', compact('questions'));
    }


    public function create()
    {

        return view('admin.questions.create');
    }


    public function store(Request $request)
    {

        $this->validate($request, [
			'name' => 'required|min:2|max:20|alpha',
			'email' => 'required|email:rfc',
			'phone' => 'required|size:14',
			'question' => 'required|min:10|max:150'
		]);
        $requestData = $request->all();

        Question::create($requestData);

        return redirect('admin/questions')->with('flash_message', 'Question added!');
    }


    public function show($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.show', compact('question'));
    }


    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('admin.questions.edit', compact('question'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required|min:2|max:20|alpha',
			'email' => 'required|email:rfc',
			'phone' => 'required|size:14',
			'question' => 'required|min:10|max:150'
		]);
        $requestData = $request->all();
        $requestData['answered'] = 1;
        $question = Question::findOrFail($id);
        $question->update($requestData);

        Mail::to($question->email)->send(new QuestionAnswered($question));

        return redirect('admin/questions')->with('flash_message', 'Question updated!');
    }


    public function destroy(Request $request, $id)
    {
        Question::destroy($id);

        return redirect('admin/questions')->with('flash_message', 'Question deleted!');
    }
    public function export($date){
        return Excel::download(new QuestionExport($date), 'questionsExport-from-'.Carbon::now().'.xlsx');
    }
    public function import(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = Excel::toArray(new QuestionImport, $path);
        $data = $data[0];

        return redirect('admin/questions/imported')->with('success', $data);
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
                	'email' => $request->email[$id],
                	'phone' => $request->phone[$id],
                	'question' => $request->question[$id],
                	'answer' => $request->answer[$id],
                	'answered' => $request->answered[$id],
                	
                ]);
            }

            return redirect('admin/'.$go);
        }
         else
            return view('admin/imported');
    }
}
