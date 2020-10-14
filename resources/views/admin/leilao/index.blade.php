@extends('admin.layout.main')
@section('main')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Leilão</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("admin-dashboard")}}">Home</a></li>
            <li class="breadcrumb-item active">Leilão</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <a href="{{route("admin-leilao-create")}}">
                                <button class="btn-lg btn-success">Criar Leilão</button>
                            </a>
                            <a href="">
                                <button style="margin-left: 10px" class="btn-lg btn-info">Leilões Encerrados</button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{!! \Session::get('error') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    @if (\Session::has('message'))
                                        <div class="alert alert-primary">
                                            <ul>
                                                <li>{!! \Session::get('message') !!}</li>
                                            </ul>
                                        </div>
                                    @endif
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th style="width: 125px">Foto</th>
                                                <th>Nome</th>
                                                <th>URL</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($leiloes as $leilao)
                                            <tr role="row" class="odd">
                                                <td><img src="{{ Storage::url($leilao->foto)}}" width="100px" alt=""></td>
                                                <td><a href="#">{{$leilao->nome}}</a></td>
                                                <td>{{$leilao->url}}</td>
                                                <td>
                                                    <a href="{{route("admin-leilao-edit", $leilao->id)}}">
                                                        <button class="btn-xs btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>

                                                <th rowspan="1" colspan="1">Foto</th>
                                                <th rowspan="1" colspan="1">Nome</th>
                                                <th rowspan="1" colspan="1" >URL</th>
                                                <th rowspan="1" colspan="1" >Ação</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Anterior</a></li>
                                            <li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                            <li class="paginate_button page-item"><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                            <li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Próximo</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>

        
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
