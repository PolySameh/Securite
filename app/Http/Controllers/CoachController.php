<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Coach;
use Redirect,Response;
class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coachs = Coach::latest()->paginate(4);
		return view('coachs.index',compact('coachs'))->with('i', (request()->input('page', 1) - 1) * 4);
	/////////////////////////////////////////////////////////////
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coachs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     //   dd($request);
		$r=$request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            ]);

            $custId = $request->cust_id;
		Coach::updateOrCreate(['id' => $custId],['nom' => $request->nom, 'prenom' => $request->prenom, 'email' => $request->email ]);
		if(empty($request->cust_id))
			$msg = 'Coach entry created successfully';
		else
			$msg = 'Coach data is updated successfully';
		return redirect()->route('coachs.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('coachs.show',compact('coach'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
		$coach = Coach::where($where)->first();
		return Response::json($coach);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cust = Coach::where('id',$id)->delete();
		return Response::json($cust);
    }
}
