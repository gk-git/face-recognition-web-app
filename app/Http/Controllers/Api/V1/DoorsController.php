<?php

namespace App\Http\Controllers\Api\V1;

use App\Door;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoorsRequest;
use App\Http\Requests\UpdateDoorsRequest;
use Yajra\Datatables\Datatables;

class DoorsController extends Controller
{
    public function index()
    {
        return Door::all();
    }

    public function show($id)
    {
        return Door::findOrFail($id);
    }

    public function update(UpdateDoorsRequest $request, $id)
    {
        $door = Door::findOrFail($id);
        $door->update($request->all());

        return $door;
    }

    public function store(StoreDoorsRequest $request)
    {
        $door = Door::create($request->all());

        return $door;
    }

    public function destroy($id)
    {
        $door = Door::findOrFail($id);
        $door->delete();
        return '';
    }
}
