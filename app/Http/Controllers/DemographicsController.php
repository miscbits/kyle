<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DemographicService;
use App\Http\Requests\DemographicCreateRequest;
use App\Http\Requests\DemographicUpdateRequest;

class DemographicsController extends Controller
{
    public function __construct(DemographicService $demographicService)
    {
        $this->service = $demographicService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $demographics = $this->service->paginated();
        return view('demographics.index')->with('demographics', $demographics);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $demographics = $this->service->search($request->search);
        return view('demographics.index')->with('demographics', $demographics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('demographics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DemographicCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemographicCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('demographics.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('demographics.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the demographic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demographic = $this->service->find($id);
        return view('demographics.show')->with('demographic', $demographic);
    }

    /**
     * Show the form for editing the demographic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $demographic = $this->service->find($id);
        return view('demographics.edit')->with('demographic', $demographic);
    }

    /**
     * Update the demographics in storage.
     *
     * @param  \Illuminate\Http\DemographicUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DemographicUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the demographics from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('demographics.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('demographics.index'))->with('message', 'Failed to delete');
    }
}
