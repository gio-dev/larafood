<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Http\Requests\StoreUpdateTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    private $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->repository->latest()->paginate();

        return view('admin.pages.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTable  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idTable
     * @return \Illuminate\Http\Response
     */
    public function show($idTable)
    {
        $table = $this->repository->find($idTable);

        if(!$table)
            return redirect()->back();

        return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idTable
     * @return \Illuminate\Http\Response
     */
    public function edit($idTable)
    {
        $table = $this->repository->find($idTable);

        if(!$table)
            return redirect()->back();

        return view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdateTable  $request
     * @param  int  $idTable
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $idTable)
    {
        $table = $this->repository->find($idTable);

        if(!$table)
            return redirect()->back();

        $table->update($request->all());

        return redirect()->route('tables.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idTable
     * @return \Illuminate\Http\Response
     */
    public function destroy($idTable)
    {
        $table = $this->repository->find($idTable);

        if(!$table)
            return redirect()->back();

        $table->delete();

        return redirect()->route('tables.index');
    }

    public function search(Request $request){

        $filters = $request->except('_token');
        $tables = $this->repository->search($request->filter);

        return view('admin.pages.tables.index', compact([
            'tables',
            'filters'
        ]));

    }
}
