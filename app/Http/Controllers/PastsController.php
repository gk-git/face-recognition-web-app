<?php

namespace App\Http\Controllers;

use App\Past;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePastsRequest;
use App\Http\Requests\UpdatePastsRequest;
use Yajra\Datatables\Datatables;

class PastsController extends Controller
{
    /**
     * Display a listing of Past.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('past_access')) {
            return abort(401);
        }
        
        if (request()->ajax()) {
            $query = Past::query();
            $query->with("door");
            $query->with("user");
            $table = Datatables::of($query);
            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) {
                $gateKey  = 'past_';
                $routeKey = 'pasts';

                return view('actionsTemplate', compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('action', function ($row) {
                return $row->action ? $row->action : '';
            });
            $table->editColumn('door.door_key', function ($row) {
                return $row->door ? $row->door->door_key : '';
            });
            $table->editColumn('intruder', function ($row) {
                return \Form::checkbox("intruder", 1, $row->intruder == 1, ["disabled"]);
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            return $table->make(true);
        }

        return view('pasts.index');
    }

    /**
     * Show the form for creating new Past.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('past_create')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
            'users' => \App\User::get()->pluck('email', 'id')->prepend('Please select', ''),
        ];

        return view('pasts.create', $relations);
    }

    /**
     * Store a newly created Past in storage.
     *
     * @param  \App\Http\Requests\StorePastsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePastsRequest $request)
    {
        if (! Gate::allows('past_create')) {
            return abort(401);
        }
        $past = Past::create($request->all());

        return redirect()->route('pasts.index');
    }


    /**
     * Show the form for editing Past.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('past_edit')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
            'users' => \App\User::get()->pluck('email', 'id')->prepend('Please select', ''),
        ];

        $past = Past::findOrFail($id);

        return view('pasts.edit', compact('past') + $relations);
    }

    /**
     * Update Past in storage.
     *
     * @param  \App\Http\Requests\UpdatePastsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePastsRequest $request, $id)
    {
        if (! Gate::allows('past_edit')) {
            return abort(401);
        }
        $past = Past::findOrFail($id);
        $past->update($request->all());

        return redirect()->route('pasts.index');
    }


    /**
     * Display Past.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('past_view')) {
            return abort(401);
        }
        $relations = [
            'doors' => \App\Door::get()->pluck('door_key', 'id')->prepend('Please select', ''),
            'users' => \App\User::get()->pluck('email', 'id')->prepend('Please select', ''),
        ];

        $past = Past::findOrFail($id);

        return view('pasts.show', compact('past') + $relations);
    }


    /**
     * Remove Past from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('past_delete')) {
            return abort(401);
        }
        $past = Past::findOrFail($id);
        $past->delete();

        return redirect()->route('pasts.index');
    }

    /**
     * Delete all selected Past at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('past_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Past::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
