<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faq;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FaqExport;
use App\Imports\FaqImport;
use Illuminate\Support\Str;

class FaqsController extends Controller
{

    public function index(Request $request)
    {
        $perPage = 9;

        $faqs = Faq::latest()->paginate($perPage);
        return view('admin.faqs.index', compact('faqs'));
    }


    public function create()
    {

        return view('admin.faqs.create');
    }


    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Faq::create($requestData);

        return redirect('admin/faqs')->with('flash_message', 'Faq added!');
    }


    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.show', compact('faq'));
    }


    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return view('admin.faqs.edit', compact('faq'));
    }


    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $faq = Faq::findOrFail($id);
        $faq->update($requestData);

        return redirect('admin/faqs')->with('flash_message', 'Faq updated!');
    }


    public function destroy(Request $request, $id)
    {
        Faq::destroy($id);

        return redirect('admin/faqs')->with('flash_message', 'Faq deleted!');
    }
    public function export($date){
        return Excel::download(new FaqExport($date), 'faqsExport-from-'.Carbon::now().'.xlsx');
    }
    public function import(Request $request){
        $path1 = $request->file('file')->store('temp');
        $path=storage_path('app').'/'.$path1;
        $data = Excel::toArray(new FaqImport, $path);
        $data = $data[0];

        return redirect('admin/faqs/imported')->with('success', $data);
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
            foreach ($request->question_ru as $id => $item)
            {
                $model::create([
                    'question_ru' => $request->question_ru[$id],
                	'question_kk' => $request->question_kk[$id],
                	'answer_ru' => $request->answer_ru[$id],
                	'answer_kk' => $request->answer_kk[$id],
                	
                ]);
            }

            return redirect('admin/'.$go);
        }
         else
            return view('admin/imported');
    }
}
