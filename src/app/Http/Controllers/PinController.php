<?php

namespace App\Http\Controllers;

use App\Model\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PinController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['only' => ['store', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pins = Pin::all();
        return response()->json(['success', $pins], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $digits = $request->number;
        // return $digit;
        function generatePIN($digit)
        {
            // return $digit;

            for ($a = 0; $a <= $digit; $a++) {
                $i = 0; //counter
                $pin = ""; //our default pin is blank.
                $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                while ($i < 6) {
                    //generate a random number between 0 and 9.
                    $pin .= mt_rand(0, 9);

                    $i++;
                }
                $al = substr(str_shuffle($str), 0, 1);
                $pin .= $al;

                DB::table('pins')->insertOrIgnore([
                    ['pin' => $pin, 'created_at' => Carbon::now()],
                ]);
            }
        }
        $pins = generatePIN($request->number);

        // return $pins;

        return response()->json(['success', 'Pin created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $input = $request->all();

        try {
            // Step 2 : Create Job Skills
            $pins = DB::table('pins')->where('pin', '=', $request->pin)->first();
            if ($pins === null) {
                // return "Invalid Pin";
                return response()->json(['error', 'This Pin is Invalid', $request->pin], 400);
            } else {
                $status = DB::table('pins')
                    ->wherePinAndStatus($request->pin, '1')
                    ->first();

                if ($status === null) {
                    return response()->json(['error', 'This Pin have been Used', $request->pin], 400);
                } else {
                    // return "pin unUsed";
                    DB::table('pins')
                        ->where('pin', $request->pin)
                        ->update(['status' => 0, 'phone_number' => $request->phone_number, 'updated_at' => Carbon::now()]);
                    return response()->json(['success', 'Thank you for using this Pin', $request->pin], 200);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response('Failed', 400);
        }

        DB::commit();

        // return response()->json(['success', 'Job created successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        //
    }
}
