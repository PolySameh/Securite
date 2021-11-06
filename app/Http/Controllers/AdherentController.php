<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Adherent;
use Redirect,Response;
class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adherents = Adherent::latest()->paginate(4);
		return view('adherents.index',compact('adherents'))->with('i', (request()->input('page', 1) - 1) * 4);
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adherents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
		$r=$request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'type' => 'required',
            ]);

            $custId = $request->cust_id;
        Adherent::updateOrCreate(['id' => $custId],['nom' => $request->nom, 'prenom' => $request->prenom, 'email' => $request->email, 'type' => $request->type]);
		if(empty($request->cust_id))
			$msg = 'Adherent entry created successfully.';
		else
			$msg = 'Adherent data is updated successfully';
		return redirect()->route('adherents.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('adherents.show',compact('adherent'));

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
		$adherent = Adherent::where($where)->first();
		return Response::json($adherent);
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
        $cust = Adherent::where('id',$id)->delete();
		return Response::json($cust);
    }
}
