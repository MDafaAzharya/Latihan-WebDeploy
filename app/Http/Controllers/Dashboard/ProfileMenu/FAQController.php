<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index()
    {
      $faq = FAQ::all();
        return view('dashboard.profiletwo.faq', compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
          'pertanyaan' => 'required',
          'jawaban' => 'required',
        ]);
        $data = $request->all();
        $data['pertanyaan'] = $request->input('pertanyaan');
        $data['jawaban'] = $request->input('jawaban');

        $insert = FAQ::create($data);

        return back()->with('success', 'Berhasil menambahkan Data');
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
       $data =  FAQ::find($id);
        // dd($data);

        return response()->json($data);
    }
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        $data = $request->all();
        $data_update = FAQ::findOrFail($request->id);
        $data_update->pertanyaan = $request->pertanyaan;
        $data_update->jawaban = $request->jawaban;
        $data_update->update($data);
        return back()->with('success', 'Berhasil mengubah data');

    }
    public function destroy(string $id)
    {
        $FAQ = FAQ::findOrFail($id);
        $FAQ->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = FAQ::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('pertanyaan', function($row){
            return $row->pertanyaan;
        })
        ->addColumn('text_short', function ($row) {
            return mb_substr(strip_tags($row->jawaban), 0, 30) . '...';
        })
        ->addColumn('text_full', function ($row) {
            return strip_tags($row->jawaban);
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";
            $button_expand = "<button class=\"btn btn-info p-2 mx-1 btn-expand\" data-id=\"" . $item->id . "\"><i class=\"tf-icons ti ti-eye\"></i></button>";

            return $button_delete . $button_edit . $button_expand;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
