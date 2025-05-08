<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Services\PinataService;
use App\Services\NFTMarketplaceService;
use Illuminate\Container\Attributes\Auth;

class HomeController extends Controller
{

    protected $nftService;
    protected $pinataService;
    
    public function __construct(NFTMarketplaceService $nftService, PinataService $pinataService)
    {
        $this->nftService = $nftService;
        $this->pinataService = $pinataService;
    }

    public function index(User $user)
    {

        $web3Config = $this->nftService->getWeb3Config();

        return view('pages.home.home',[
            'web3Config'=> $web3Config,
        ]);
    }





   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
