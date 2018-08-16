<?php

namespace App\Http\Controllers;

use App\Doctor;
use Illuminate\Http\Request;

class VoteController extends Controller
{

    private $morph = [
        'doctor'    => Doctor::class,
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($obj, $id)
    {
        return $this->morph[$obj]::find($id)
            ->votes()
            ->orderBy('id','desc')
            ->paginate(50);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function karma($obj, $id)
    {
        return $this->morph[$obj]::find($id)
            ->karma;
    }
    public function rate($obj, $id)
    {
        return $this->morph[$obj]::find($id)
            ->rate;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($obj, $id)
    {
        $ob = $this->morph[$obj]::find($id);
        return [
            'karma'=> $ob->karma,
            'rate'=> $ob->rate,
            'likes'=> $ob->likes,
            'dislikes'=> $ob->dislikes,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $obj, $id)
    {
        // TODO: validation for mark type karma or vote + unique user vote
        $object = $this->morph[$obj]::find($id);

        $object->vote($request->mark);

        $object =  $object->fresh();

        return [
            'karma'=> $object->karma,
            'rate'=> $object->rate,
            'likes'=> $object->likes,
            'dislikes'=> $object->dislikes,
        ];
    }

}
