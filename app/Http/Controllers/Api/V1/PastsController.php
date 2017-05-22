<?php

namespace App\Http\Controllers\Api\V1;

use App\Past;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePastsRequest;
use App\Http\Requests\UpdatePastsRequest;
use Yajra\Datatables\Datatables;

class PastsController extends Controller
{
    public function index()
    {
        return Past::all();
    }

    public function show($id)
    {
        return Past::findOrFail($id);
    }

    public function update(UpdatePastsRequest $request, $id)
    {
        $past = Past::findOrFail($id);
        $past->update($request->all());

        return $past;
    }

    public function store(StorePastsRequest $request)
    {
        $past = Past::create($request->all());

        return $past;
    }

    public function destroy($id)
    {
        $past = Past::findOrFail($id);
        $past->delete();
        return '';
    }
}
