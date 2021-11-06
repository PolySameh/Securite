<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Entraineur;
use App\Models\Type;
use Redirect,Response;
class EntraineurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        $entraineurs = Entraineur::latest()->paginate(4);
		return view('entraineurs.index',compact(['entraineurs','types']))->with('i', (request()->input('page', 1) - 1) * 4);
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entraineurs.create');
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
            'type_id' => 'required',
            ]);
            
           

            $custId = $request->cust_id;
        Entraineur::updateOrCreate(['id' => $custId],['nom' => $request->nom, 'prenom' => $request->prenom, 'email' => $request->email, 'type_id' => $request->type_id]);
		if(empty($request->cust_id))
			$msg = 'Entraineur entry created successfully.';
		else
			$msg = 'Entraineur data is updated successfully';
		return redirect()->route('entraineurs.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('entraineurs.show',compact('entraineur'));

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
		$entraineur = Entraineur::where($where)->first();
		return Response::json($entraineur);
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
        $cust = Entraineur::where('id',$id)->delete();
		return Response::json($cust);
    }
}

