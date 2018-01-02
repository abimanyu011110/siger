<?php

namespace App\Http\Controllers\adminpemda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\adminpemda\User;
use App\Models\adminpemda\OPD;
use App\Models\adminpemda\Role;
use App\Http\Requests\adminpemda\reqUser;
use DB;

class UserCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = DB::table('tbl_user')
            ->select('tbl_user.id as id', 'tbl_user.nama as nama', 'tbl_user.username as username', 'tbl_opd.nama_opd as nama_opd', 'tbl_role.nama_role as nama_role')
            ->leftjoin('tbl_opd', 'tbl_user.opd_id', '=', 'tbl_opd.id')
            ->leftjoin('tbl_role', 'tbl_user.role_id', '=', 'tbl_role.id')
            ->get();       
        return view('adminpemda.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->data['opd'] = OPD::pluck('nama_opd', 'id');
        $this->data['role'] = Role::pluck('nama_role', 'id');
        return view('adminpemda.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $user = new User($input);
        $user->password = bcrypt($request['password']);
        if ($user->save()) {
            return redirect()->route('manajemen-user.index');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $this->data['opd'] = OPD::pluck('nama_opd', 'id');
        $this->data['role'] = Role::pluck('nama_role', 'id');
        $this->data['user'] = User::find($id);
        return view('adminpemda.user.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(reqUser $request, $id)
    {
        //
        $input = $request->all();
        $user = User::find($id);
        if ($user->update($input)) {
            return redirect()->route('manajemen-user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return redirect()->route('manajemen-user.index');
    }
}
