@extends('layout.index')
@section('isi')

  <div class="col-sm-12">
    <div class="widget-box">

      <div class="widget-header">
        <h4 class="widget-title">Edit Data User</h4>
      </div>

      <div class="widget-body">
        <div class="widget-main">
          <form class="form-horizontal" action="{{route('manajemen-user.update', $user->id)}}" method="post">
              <input type="hidden" name="_method" value="put">
              <input type="hidden" name="user" value="{{$user->id}}">
            {!! csrf_field() !!}

            <div class="form-group  @if($errors->has('nama')) has-error @endif"">
            <label for="nama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nama" value="{{$user->nama}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('nama')}}</span>
            </div>
            </div>

            <div class="form-group  @if($errors->has('username')) has-error @endif"">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="username" value="{{$user->username}}">
              <span id="helpBlock2" class="help-block">{{$errors->first('username')}}</span>
            </div>
            </div>

              <div class="form-group">
                <label for="opd_id" class="col-sm-2 control-label">Pilih OPD</label>
                  <div class="col-sm-6">
                  <select name="opd_id" class="form-control" id="opd_id">
                    <option value="0" disabled="true" selected="true"></option>
                    @foreach($opd as $key => $value)
                    <option value="{{$key}}" {{$user->opd_id == $key ? 'selected' : ''}}>{{$value}}</option>
                    @endforeach
                  </select>
                  </div>
              </div>

              <div class="form-group">
                  <label for="role_id" class="col-sm-2 control-label">Pilih Role</label>
                    <div class="col-sm-4">
                      <select name="role_id" class="form-control" id="role_id">
                        <option value="0" disabled="true" selected="true"></option>
                        @foreach($role as $key => $value)
                        <option value="{{$key}}" {{$user->role_id == $key ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                      </select>
                    </div>
              </div>

            <div class="form-group  @if($errors->has('password')) has-error @endif"">
              <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="password" value="">
                  <span id="helpBlock2" class="help-block">{{$errors->first('password')}}</span>
                </div>
            </div>

            <div class="form-group @if($errors->has('password-confirm')) has-error @endif""">
              <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

        <div class="space-4"></div>
        <div class="clearfix">
          <div class="pull-right">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <a href="{{route('manajemen-user.index')}}" type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</a>
          </div>
        </div>

          </form>

        </div>
      </div>
    </div>
  </div>

@stop