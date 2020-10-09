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
            <li class="breadcrumb-item active"><a href="{{route("admin-leilao")}}">Leilão</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

        <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- jquery validation -->
                  <div class="card card-primary">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" id="quickForm" novalidate="novalidate">
                      <div class="card-body">

                        <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="foto">Foto pricipal</label>
                                  <input type="file" name="foto" class="form-control-file" accept="image/*" id="foto" placeholder="foto" >
                              </div>
                          </div>
                      </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" >
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="url">URL</label>
                                    <input type="text" name="url" class="form-control" id="url" placeholder="URL" >
                                  </div>
                            </div>
                        </div>
                        

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="cep">CEP</label>
                              <input type="text" name="cep" class="form-control" id="cep">
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="uf">UF</label>
                              <input type="text" name="uf" class="form-control" id="uf" placeholder="Ex: SP" >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="ceidade">Cidade</label>
                              <input type="text" name="ceidade" class="form-control" id="ceidade" placeholder="Ex: São Paulo" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="endereco">Endereço</label>
                              <input type="text" name="endereco" class="form-control" id="endereco"  placeholder="Ex: Rua 14 Lote 7..." >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="bairro">Bairro</label>
                              <input type="text" name="bairro" class="form-control" id="bairro"  placeholder="Ex: Santo André" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="numero">Número</label>
                              <input type="text" name="numero" class="form-control" id="numero"  >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="complemento">Complemento</label>
                              <input type="text" name="complemento" class="form-control" id="complemento"  placeholder="Ex: Em frente a padaria Santa Luz" >
                          </div>
                        </div>
                      </div>                    

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="latitude">Latitude</label>
                              <input type="text" class="form-control" name="latitude" id="latitude" placeholder="-22.95162" >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="longitude">Longitude</label>
                              <input type="text" class="form-control" name="longitude" id="longitude" placeholder="-43.21077" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                              <label for="localidade">Localidade</label>
                              <input type="text" class="form-control" name="localidade" id="localidade" placeholder="CarBus, São Paulo, SA" >
                          </div>
                        </div>

                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" required id="status" class="form-control">
                              <option value="">Selecione o status do leilão </option>
                              <option value="0">Não visivel</option>
                              <option value="1">Normal</option>
                              <option value="2">Reagendado</option>
                              <option value="3">Cancelado</option>
                            </select>
                        </div>
                        </div>
                      </div>
                      

                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Criar</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->
                  </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">
      
                </div>
                <!--/.col (right) -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection