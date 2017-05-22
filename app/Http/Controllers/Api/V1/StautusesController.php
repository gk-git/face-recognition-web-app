<?php

namespace App\Http\Controllers\Api\V1;

use App\Stautus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStautusesRequest;
use App\Http\Requests\UpdateStautusesRequest;
use Yajra\Datatables\Datatables;

class StautusesController extends Controller
{
    public function index()
    {
        return Stautus::all();
    }

    public function show($id)
    {
        return Stautus::findOrFail($id);
    }

    public function update(UpdateStautusesRequest $request, $id)
    {
        $stautus = Stautus::findOrFail($id);
        $stautus->update($request->all());

        return $stautus;
    }

    public function store(StoreStautusesRequest $request)
    {
        $stautus = Stautus::create($request->all());

        return $stautus;
    }

    public function destroy($id)
    {
        $stautus = Stautus::findOrFail($id);
        $stautus->delete();
        return '';
    }
}
