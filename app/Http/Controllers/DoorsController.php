<?php

namespace App\Http\Controllers;

use App\Door;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreDoorsRequest;
use App\Http\Requests\UpdateDoorsRequest;
use Yajra\Datatables\Datatables;

class DoorsController extends Controller
{
    /**
     * Display a listing of Door.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('door_access')) {
            return abort(401);
        }
        
        if (request()->ajax()) {
            $query = Door::query();
            $table = Datatables::of($query);
            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'door_';
                $routeKey = 'doors';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('door_key', function ($row) {
                return $row->door_key ? $row->door_key : '';
            });
            $table->editColumn('location', function ($row) {
                return $row->location ? $row->location : '';
            });

            return $table->make(true);
        }

        return view('doors.index');
    }

    /**
     * Show the form for creating new Door.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('door_create')) {
            return abort(401);
        }
        return view('doors.create');
    }

    /**
     * Store a newly created Door in storage.
     *
     * @param  \App\Http\Requests\StoreDoorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoorsRequest $request)
    {
        if (! Gate::allows('door_create')) {
            return abort(401);
        }
        $door = Door::create($request->all());

        return redirect()->route('doors.index');
    }


    /**
     * Show the form for editing Door.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('door_edit')) {
            return abort(401);
        }
        $door = Door::findOrFail($id);

        return view('doors.edit', compact('door'));
    }

    /**
     * Update Door in storage.
     *
     * @param  \App\Http\Requests\UpdateDoorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoorsRequest $request, $id)
    {
        if (! Gate::allows('door_edit')) {
            return abort(401);
        }
        $door = Door::findOrFail($id);
        $door->update($request->all());

        return redirect()->route('doors.index');
    }


    /**
     * Display Door.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('door_view')) {
            return abort(401);
        }
        $relations = [
            'pasts' => \App\Past::where('door_id', $id)->get(),
            'users' => \App\User::where('door_key_id', $id)->get(),
            'stautuses' => \App\Stautus::where('door_id', $id)->get(),
        ];

        $door = Door::findOrFail($id);

        return view('doors.show', compact('door') + $relations);
    }


    /**
     * Remove Door from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('door_delete')) {
            return abort(401);
        }
        $door = Door::findOrFail($id);
        $door->delete();

        return redirect()->route('doors.index');
    }

    /**
     * Delete all selected Door at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('door_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Door::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
