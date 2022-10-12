<?php

namespace App\Http\Controllers;

use App\Jobs\ExchangeRate\DeleteKursDollarOrg;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $files = Storage::disk('exchange-rate')->files();

        return view('index', compact('files'));
    }

    public function delete()
    {
        DeleteKursDollarOrg::dispatch();

        return redirect()->route('index')->with([
            'message' => 'Proses berhasil ditambahkan pada Job',
        ]);
    }
}
