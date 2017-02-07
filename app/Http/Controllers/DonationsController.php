<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\DonationService;
use App\Http\Requests\DonationCreateRequest;
use App\Http\Requests\DonationUpdateRequest;

class DonationsController extends Controller
{
    public function __construct(DonationService $donationService)
    {
        $this->service = $donationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $donations = $this->service->paginated();
        return view('donations.index')->with('donations', $donations);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $donations = $this->service->search($request->search);
        return view('donations.index')->with('donations', $donations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\DonationCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationCreateRequest $request)
    {
        $result = $this->service->create($request->except('_token'));

        if ($result) {
            return redirect(route('donations.edit', ['id' => $result->id]))->with('message', 'Successfully created');
        }

        return redirect(route('donations.index'))->with('message', 'Failed to create');
    }

    /**
     * Display the donation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = $this->service->find($id);
        return view('donations.show')->with('donation', $donation);
    }

    /**
     * Show the form for editing the donation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = $this->service->find($id);
        return view('donations.edit')->with('donation', $donation);
    }

    /**
     * Update the donations in storage.
     *
     * @param  \Illuminate\Http\DonationUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonationUpdateRequest $request, $id)
    {
        $result = $this->service->update($id, $request->except('_token'));

        if ($result) {
            return back()->with('message', 'Successfully updated');
        }

        return back()->with('message', 'Failed to update');
    }

    /**
     * Remove the donations from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->service->destroy($id);

        if ($result) {
            return redirect(route('donations.index'))->with('message', 'Successfully deleted');
        }

        return redirect(route('donations.index'))->with('message', 'Failed to delete');
    }
}
