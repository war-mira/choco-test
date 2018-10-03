<?php

namespace App\Http\Controllers;

use App\Drug;
use Request;
use Session;

class DrugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $status_array =
            [
                0=>'Скрыт',
                1=>'Опубликован'
            ];
        $items = Drug::all();
        return view('admin.drugs.index', compact('items'), compact('status_array'));
    }

    public function list()
    {
        $Drugs = Drug::all();
        return view('drugs.list', compact('Drugs'));
    }

    public function item($id)
    {
        $item = Drug::find($id);

        return view('drugs.item', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('drugs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        Drug::create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $item = Drug::findOrFail($id);

        return view('drugs.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $status_array =
            [
                0=>'Скрыт',
                1=>'Опубликован'
            ];
        if(!empty($id)){
            $item = Drug::find($id);
            $Drugs['id'] = $item->id;
            $Drugs['name'] = $item->name;
            $Drugs['status'] = $item->status;
            $Drugs['mnn'] = $item->mnn;
            $Drugs['atx'] = $item->atx;
            $Drugs['annotations'] = $item->annotations;
            $Drugs['price'] = $item->price;
            $Drugs['image'] = $item->image;
        }else{
            $Drugs['id'] = '';
            $Drugs['name'] = '';
            $Drugs['status'] = 0;
            $Drugs['mnn'] = '';
            $Drugs['atx'] = '';
            $Drugs['annotations'] = '';
            $Drugs['price'] = 0;
        }
        if (empty($Drugs['image'])) {
            $Drugs['image']='images/no-userpic.gif';
        }
        return view('admin.drugs.edit', compact('Drugs'), compact('status_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function save()
    {
        $input = Request::all();
        if(!empty($input['image'])){
            $filename = $input['image']->store('photos');
            $input['image'] = $filename;
        }
        if (empty($input['id'])) {
            Drug::create($input);
        }else {
            $item = Drug::find($input['id']);
            $item->update($input);
        }
        Session::flash('flash_message', 'Добавлен!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Drug::findOrFail($id);
        $item->delete();
        Session::flash('flash_message', 'Successfully deleted!');
        return redirect()->route('drugs.index');
    }
}
