<?php

namespace App\Http\Controllers;

use App\Models\Sales_Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesTeamController extends Controller
{
  

    public function index(){

        $data = Sales_Team::paginate(10);
        return view('sales_team')->with('data', $data);

    }



    public function add_new_member(){

        return view('add_member');

    }

    //add sales member

    public function submit_member_details(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email|unique:sales__teams',
            'phone' => 'required',
            'joined_date' => 'required',
            'role' => 'required|max:255',
            'comments' => 'required|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->messages(),
                'status'=> 422,
            ]);
        }
        else
        {

        $data = new Sales_Team;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->joined_date = $request->joined_date;
        $data->currunt_role = $request->role;
        $data->comments = $request->comments;
        $data->save();

        return response()->json([
            'status'=> 200,
            'message'=>'Student Added Successfully',
        ]);

        }

    }

//view sales member
    public function view_member($id){

        $details =  Sales_Team::find($id);
        return response()->json([
        'status'=>200,
        'data'=>$details
        ]);

    }

    public function edit_member($id){

        $data = Sales_Team::find($id);
        return view('edit_member')->with('data', $data);
       

    }

    //update sales member
    public function update_member_details(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|max:100',
            'email' => 'required|email',
            'phone' => 'required',
            'joined_date' => 'required',
            'role' => 'required|max:255',
            'comments' => 'required|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->messages(),
                'status'=> 422,
            ]);
        }
        else
        {

        $data =  Sales_Team::find($request->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->joined_date = $request->joined_date;
        $data->currunt_role = $request->role;
        $data->comments = $request->comments;
        $data->save();
        return response()->json([
            'status'=> 200,
            'message'=>'Updated Successfully',
        ]);

        }

    }

//delete sales member
    public function delete_member($id){

        $data = Sales_Team::find($id);
        $data->delete();
        session()->flash('alert-success', 'Deleted Successfully');
        return redirect()->back();

    }
    


    


}
