<?php

namespace App\Http\Controllers;

use App\Stautus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreStautusesRequest;
use App\Http\Requests\UpdateStautusesRequest;
use Yajra\Datatables\Datatables;

class StautusesController extends Controller
{
    /**
     * Display a listing of Stautus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('stautus_access')) {
            return abort(401);
        }
        
        if (request()->ajax()) {
            $query = Stautus::query();
            $query->with("door");
            $table = Datatables::of($query);
            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'stautus_';
                $routeKey = 'stautuses';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('status', function ($row) {
                return \Form::checkbox("status", 1, $row->status == 1, ["disabled"]);
            });
            $table->editColumn('action_open', function ($row) {
                return \Form::checkbox("action_open", 1, $row->action_open == 1, ["disabled"]);
            });
            $table->editColumn('action_black', function ($row) {
                return \Form::checkbox("action_black", 1, $row->action_black == 1, ["disabled"]);
            });
            $table->editColumn('action_wait', function ($row) {
                return \Form::checkbox("action_wait", 1, $row->action_wait == 1, ["disabled"]);
            });
            $table->editColumn('action_else', function ($row) {
                return \Form::checkbox("action_else", 1, $row->action_else == 1, ["disabled"]);
            });
            $table->editColumn('door.door_key', function ($row) {
                return $row->door ? $row->door->door_key : '';
            });

            return $table->make(true);
        }

        return view('stautuses.index');
    }

    /**
     * Show the form for creating new Stautus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('stautus_create')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
        ];

        return view('stautuses.create', $relations);
    }

    /**
     * Store a newly created Stautus in storage.
     *
     * @param  \App\Http\Requests\StoreStautusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStautusesRequest $request)
    {
        if (! Gate::allows('stautus_create')) {
            return abort(401);
        }
        $stautus = Stautus::create($request->all());

        return redirect()->route('stautuses.index');
    }


    /**
     * Show the form for editing Stautus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('stautus_edit')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
        ];

        $stautus = Stautus::findOrFail($id);

        return view('stautuses.edit', compact('stautus') + $relations);
    }

    /**
     * Update Stautus in storage.
     *
     * @param  \App\Http\Requests\UpdateStautusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStautusesRequest $request, $id)
    {
        if (! Gate::allows('stautus_edit')) {
            return abort(401);
        }
        $stautus = Stautus::findOrFail($id);
        $stautus->update($request->all());

        return redirect()->route('stautuses.index');
    }


    /**
     * Display Stautus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('stautus_view')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
        ];

        $stautus = Stautus::findOrFail($id);

        return view('stautuses.show', compact('stautus') + $relations);
    }


    /**
     * Remove Stautus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('stautus_delete')) {
            return abort(401);
        }
        $stautus = Stautus::findOrFail($id);
        $stautus->delete();

        return redirect()->route('stautuses.index');
    }

    /**
     * Delete all selected Stautus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('stautus_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Stautus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
