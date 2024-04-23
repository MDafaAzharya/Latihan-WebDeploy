<?php

namespace App\Http\Controllers\Dashboard\ProfileMenu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
            return view('dashboard.profiletwo.agenda');
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
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'color' => 'required',
          ]);
          $data = $request->all();
  
          $insert = Agenda::create($data);
  
          return back()->with('success', 'Berhasil menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $events = Agenda::where('start_date', '>=', $start)
        ->where('end_date', '<=' , $end)->get()
        ->map( fn ($item) => [
            'id' => $item->id,
            'title' => $item->title,
            'start' => $item->start_date,
            'end' => date('Y-m-d',strtotime($item->end_date. '+1 days')),
            'color' => $item->color,
            'className' => ['bg-'. $item->color]
        ]);

        return response()->json($events);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $data =  Agenda::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'color' => 'required',
          ]);
        $data = Agenda::find($request->id);      

        $data->title = $request->title;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->color = $request->color;
        $data->save();
        return back()->with('success', 'Berhasil mengubah data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Agenda = Agenda::findOrFail($id);
        $Agenda->delete();
        return back()->with('success', 'Berhasil menghapus data');
    }
    public function datatable(){
        $data = Agenda::all();
        return \Yajra\DataTables\DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('judul', function($row){
            return $row->title;
        })
        ->addColumn('text', function($row){
            return strip_tags($row['text']);
        })
        ->addColumn('gambar', function ($row) {
            $imageUrl = asset("storage/images/{$row->image}");
            return $imageUrl;
        })
        ->addColumn('action', function($item){
            $button_delete = "<button class=\"btn btn-danger p-2 mx-1 btn-delete\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-trash\"></i></button>";
            $button_edit = "<button class=\"btn btn-success p-2 mx-1 btn-edit\" data-id=\"".$item->id."\"><i class=\"tf-icons ti ti-pencil\"></i></button>";

            return $button_delete . $button_edit;
          })
        ->rawColumns(['action'])
        ->make(true);
    }
}
