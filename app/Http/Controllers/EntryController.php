<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;
use Illuminate\Http\Request;
use Exception;
//use PDF;

use \Mpdf\Mpdf as MPDF;
use Illuminate\Support\Facades\Storage;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entries = Entry::all();
        return view('entry.index', ['entries' => $entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.entry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EntryRequest  $request
     * @return App\Http\Requests\EntryRequest
     */
    public function store(EntryRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->id();
        try {
            Entry::create($data);
            return back()->with('success','Заявка успешно создана.');
        } catch (Exception $exception) {
            return back()->with('errorsCreate',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        return view('entry.show', ['entry' => $entry] );
    }

    public function generatePdf($id)
    {
        $entry = Entry::find($id);

        $document = new MPDF( [
            'mode' => 'utf-8',
            'format' => 'A4'
        ]);

        $header = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="entry.pdf"'
        ];

        $document->WriteHTML(view('entry.create_pdf', ['entry' => $entry]));
        Storage::disk('public')->put('entry.pdf', $document->Output('entry.pdf', "D"));
        return Storage::disk('public')->download('entry.pdf', 'Request', $header);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        return view('entry.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entry $entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $entry)
    {
        //
    }
}
