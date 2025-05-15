<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function userList()
    {
        $this->data['user'] = User::where('status','1')->get();
        return view('user.list',$this->data);
    }
    public function userAdd()
    {
        $this->data['role'] = Role::where('status','1')->get();
        return view('user.user',$this->data);
    }
    public function userEdit($id,Request $request)
    {
        $edit_data = User::where('id',$id)->first();
        $role = Role::where('status','1')->get();
        $data = array(
            'edit_data' => $edit_data,
            'role' => $role,
        );
        return view('user.user',$data);
    }
    public function userSave(Request $request) {
        $validateFields = [
            'fname' => 'required',
            'password' => 'required',
            'email' => 'required'
        ];

        $validator = Validator::make($request->all(), $validateFields);

        if ($validator->fails()) {
            return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
        }

      
        $empCheck = User::where('email',$request->email)->first();

        if(isset($empCheck) && $empCheck!=''){
            return redirect()
            ->back()
            ->withErrors(['error' => 'Already exists']) 
            ->withInput();
        }
      
        $insertRecord = [
            'name' => $request->input('fname'),
            "user_role" => $request->user_role,
            "address" => $request->address,
            "email" => $request->email,
            "mobile_no" => $request->mobile_no,
            "password" => Hash::make($request->password),
            "show_password" => encrypt($request->password),
            "status" => 1,
            'created_by' => 1
        ];
     
       
        try {
            if ($request->id) {
                $id = $request->id ? $request->id : '';
                if ($id) {
                    $update = User::where('id', $id)->update($insertRecord);
                    Session::flash('success', 'User Details updated successfully');
                } else {
                    Session::flash('warning', 'User Details not Found');
                }
            } else {
                $insert = User::insert($insertRecord);
                Session::flash('success', 'User Details created successfully');
            }
        } catch (Exception $ex) {
            Session::flash('warning', $ex);
        }

        return redirect(route('userList'));
    }

    public function deactivate(Request $request)
    {
        
            $id = $request->get('id');
            /* Checking Id */
            if ($id == "") {

                return redirect('user_list')->withErrors(['Please try again later!']); // Error bag
            }
            /* Check User */
            $chcking_unique = Users::where('id', $id)->where('status', '!=', '0')->get();

            if (count($chcking_unique) == 0) {
                return redirect('userList')->withErrors(['Please try again later!']); // Error bag
            }

            $update_data = [
                'status' => '1'
            ];

            $update_company = Users::where('id', $id)->update($update_data);


            if ($update_company) {
                return redirect('userList')->with(['success' => 'User Activated Successfully!']);
            } else {
                return redirect('userList')->with(['success' => 'User not activated!']);
            }
        
    }

    public function activate(Request $request)
    {
            $id = $request->get('id');

            /* Checking Id */
            if ($id == "") {
                return redirect('userList')->withErrors(['Please try again later!']); // Error bag
            }
            /* Check user */
            $chcking_unique = User::where('id', $id)->where('status', '!=', '0')->get();

            if (count($chcking_unique) == 0) {
                return redirect('userList')->withErrors(['Please try again later!']); // Error bag
            }

            $update_data = [
                'user_status' => '2'
            ];

            $update_company = User::where('id', $id)->update($update_data);

           

            if ($update_company) {
                return redirect('userList')->with(['success' => 'User Deactivated Successfully!']);
            } else {
                return redirect('userList')->with(['success' => 'User not deactivated!']);
            }
        
    }

}
