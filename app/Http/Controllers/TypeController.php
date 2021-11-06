<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Type;
use Redirect,Response;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::latest()->paginate(4);
		return view('types.index',compact('types'))->with('i', (request()->input('page', 1) - 1) * 4);
	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('types.create');
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
            'name' => 'required',
            'price' => 'required',
            ]);

            $custId = $request->cust_id;
		Type::updateOrCreate(['id' => $custId],['name' => $request->name, 'price' => $request->price]);
		if(empty($request->cust_id))
			$msg = 'Type entry created successfully.';
		else
			$msg = 'Type data is updated successfully';
		return redirect()->route('types.index')->with('success',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('types.show',compact('type'));

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
		$type = Type::where($where)->first();
		return Response::json($type);
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
        $cust = Type::where('id',$id)->delete();
		return Response::json($cust);
    }
}

