@extends('master')

@section('body')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>@yield('header')</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">@yield('subheader')</h3>
                
                @hasSection('add-button-url')
                <a class="float-right btn btn-sm btn-primary" href="@yield('add-button-url')" role="button"><i class="fa fa-plus"></i> @yield('add-button-text')</a>  
                @endif
      <!--          <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>-->
              </div>
              <div class="card-body">
                  @yield('content')
              </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

@endsection
