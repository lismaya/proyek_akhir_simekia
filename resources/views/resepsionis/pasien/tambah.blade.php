@extends('resepsionis.layout')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/resepsionis">Home</a></li>
              <li class="breadcrumb-item"><a href="/resepsionis/ortu">Data Orangtua</a></li>
              <li class="breadcrumb-item"><a href="/resepsionis/pasien/{{ $ortu_id }}">Data Pasien</a></li>
              <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Form Data Pasien</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="/resepsionis/pasien-tambah/{{ $ortu_id }}">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Nama Pasien</label>
                    <input type="text" class="form-control" placeholder="" name="nama" value="{{ old('nama') }}">
                     @if($errors->has('nama'))
                          <div class="text-danger">
                              {{ $errors->first('nama')}}
                          </div>
                     @endif
                  </div>
                  <div class="form-group">
                    <label>Jenis kelamin</label>
                    <select class="form-control" name="jk">
                      <option value="L" {{ (old('jk') === 'L') ? 'selected' : '' }}>Laki-laki</option>
                      <option value="P" {{ (old('jk') === 'P') ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @if($errors->has('jk'))
                          <div class="text-danger">
                              {{ $errors->first('jk')}}
                          </div>
                     @endif                    
                  </div>
                  <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" placeholder="" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                    @if($errors->has('tempat_lahir'))
                          <div class="text-danger">
                              {{ $errors->first('tempat_lahir')}}
                          </div>
                     @endif      
                  </div>
                  <div class="form-group">
                    <label>Tanggal lahir</label>
                    <!-- <input type="text" class="form-control" placeholder="" name="tgl_lahir" value="{{ old('tgl_lahir') }}"> -->
                    <div class="input-group date" id="tgl_lahir" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}"/>
                        <div class="input-group-append" data-target="#tgl_lahir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @if($errors->has('tgl_lahir'))
                          <div class="text-danger">
                              {{ $errors->first('tgl_lahir')}}
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
