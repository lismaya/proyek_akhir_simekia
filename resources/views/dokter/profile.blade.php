@extends('dokter.layout')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dokter">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
             
             
            <!-- general form elements -->
            @if(\Session::has('alert-danger'))
                <div class="alert alert-danger">
                    <div>{{Session::get('alert-danger')}}</div>
                </div>
            @endif
            @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
            @endif
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Data Profile</h3>
              </div>

              <!-- /.card-header -->
              <!-- form start -->

              
              <form role="form" method="POST" action="/dokter/profile">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input disabled="" type="text" class="form-control" placeholder="" name="username" value="{{ old('username') ?? $pengguna->username ?? '' }}">
                     @if($errors->has('username'))
                          <div class="text-danger">
                              {{ $errors->first('username')}}
                          </div>
                     @endif
                  </div>
                  
                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="" name="nama" value="{{ old('nama') ?? $pengguna->nama ?? '' }}">
                     @if($errors->has('nama'))
                          <div class="text-danger">
                              {{ $errors->first('nama')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Telp</label>
                    <input type="text" class="form-control" placeholder="" name="telp" value="{{ old('telp') ?? $pengguna->telp ?? '' }}">
                     @if($errors->has('telp'))
                          <div class="text-danger">
                              {{ $errors->first('telp')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="" name="email" value="{{ old('email') ?? $pengguna->email ?? ''}}">
                      @if($errors->has('email'))
                          <div class="text-danger">
                              {{ $errors->first('email')}}
                          </div>
                     @endif      
                  </div>                   
                  
                                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
        </div>
      </div>
    </section>
@endsection
