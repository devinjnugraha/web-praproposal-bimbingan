<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengajuans = Pengajuan::all();

        return view('pengajuan', [
            'pengajuans' => $pengajuans
        ]);
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
        $dosen = Dosen::all()->first();

        $sisa_kuota = $dosen->kuota - count($dosen->bimbingans);

        if ($sisa_kuota !== 0) {
            return redirect(route('bimbingan'))->withErrors("Pengajuan ditolak. Anda masih memiliki $sisa_kuota kuota bimbingan.");
        }

        $validatedData = $request->validate([
            'kuota_diajukan' => 'required|integer|between:1,5',
            'keterangan' => 'required|min:3|max:255',
        ]);

        $validatedData['dosen_id'] = $dosen->id;

        Pengajuan::create($validatedData);

        return redirect(route('bimbingan'))->with('success', 'Pengajuan successfully stored.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show(Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengajuan $pengajuan)
    {
        $pengajuans = Pengajuan::all();
        $dosens = Dosen::all();

        return view('admin', [
            'pengajuans' => $pengajuans,
            'dosens' => $dosens,
        ]);
    }

    /**
     * Accept pengajuan and update dosen's kuota
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function accept(Pengajuan $pengajuan)
    {
        if ($pengajuan->status === null) {
            $dosen = Dosen::all()->find($pengajuan->dosen_id);
            $pengajuan->status = 1;
            $pengajuan->save();

            $dosen->kuota += $pengajuan['kuota_diajukan'];
            $dosen->save();
        }

        return redirect(route('admin'));
    }

    /**
     * Reject pengajuan
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function reject(Pengajuan $pengajuan)
    {
        if ($pengajuan->status === null) {
            $pengajuan->status = 0;
            $pengajuan->save();
        }
        return redirect(route('admin'));
    }

    /**
     * Cancel pengajuan's status and update dosen's kuota
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function cancel(Pengajuan $pengajuan)
    {
        if ($pengajuan->status === 1) {
            $dosen = Dosen::all()->find($pengajuan->dosen_id);
            $dosen->kuota -= $pengajuan['kuota_diajukan'];
            $dosen->save();
        }
        $pengajuan->status = null;
        $pengajuan->save();

        return redirect(route('admin'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengajuan $pengajuan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengajuan $pengajuan)
    {
        //
    }
}
