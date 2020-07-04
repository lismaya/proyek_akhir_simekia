@extends('resepsionis.layout')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Data Orangtua</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/resepsionis">Home</a></li>
              <li class="breadcrumb-item"><a href="/resepsionis/ortu">Data Orangtua</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Data Orangtua</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="/resepsionis/ortu-edit/{{ $ortu->id }}">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="" name="username" value="{{ old('username') ?? $ortu->username ?? '' }}">
                     @if($errors->has('username'))
                          <div class="text-danger">
                              {{ $errors->first('username')}}
                          </div>
                     @endif
                  </div>
                  
                  <div class="form-group">
                    <label>Nama Ayah</label>
                    <input type="text" class="form-control" placeholder="" name="nama_ayah" value="{{ old('nama_ayah') ?? $ortu->nama_ayah ?? '' }}">
                     @if($errors->has('nama_ayah'))
                          <div class="text-danger">
                              {{ $errors->first('nama_ayah')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Nama Ibu</label>
                    <input type="text" class="form-control" placeholder="" name="nama_ibu" value="{{ old('nama_ibu') ?? $ortu->nama_ibu ?? '' }}">
                     @if($errors->has('nama_ibu'))
                          <div class="text-danger">
                              {{ $errors->first('nama_ibu')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control" name="alamat">{{ old('alamat') ?? $ortu->alamat ?? '' }}</textarea>
                     @if($errors->has('alamat'))
                          <div class="text-danger">
                              {{ $errors->first('alamat')}}
                          </div>
                     @endif    
                  </div>
                  <div class="form-group">
                    <label>No.Telp</label>
                    <input type="text" class="form-control" placeholder="" name="telp" value="{{ old('telp') ?? $ortu->telp ?? ''}}">
                      @if($errors->has('telp'))
                          <div class="text-danger">
                              {{ $errors->first('telp')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="" name="email" value="{{ old('email') ?? $ortu->email ?? ''}}">
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
