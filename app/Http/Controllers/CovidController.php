<?php

namespace App\Http\Controllers;

use App\Models\covid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CovidController extends Controller
{
    public function getAllDataCovid() {
        $data = covid::select('location', DB::raw('SUM(total_cases) as total')) -> groupBy('location') -> get();

        foreach ($data as $key => $isi) {
            $result[++$key] = [$isi->location, (int)$isi->total];
        }

        //echo json_encode($result);

        return view('covid')->with('total', json_encode($result));
    }

    public function getDataCovid($negara) {
        if ($negara == "Papua") {
            $negara = "Papua New Guinea";
        }

        $data = covid::select('*') -> where('location', '=', $negara) -> get();

        //echo($data);

        foreach ($data as $key => $isi) {
            $result[++$key] = [$isi->location, $isi->date, $isi->total_cases, $isi->new_cases, $isi->total_deaths, $isi->new_deaths, $isi->people_vaccinated, $isi->people_fully_vaccinated, $isi->population];
        }

        //echo json_encode($result);

        return view('covidnegara')->with('data', json_encode($result));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function show(covid $covid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function edit(covid $covid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, covid $covid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\covid  $covid
     * @return \Illuminate\Http\Response
     */
    public function destroy(covid $covid)
    {
        //
    }
}
