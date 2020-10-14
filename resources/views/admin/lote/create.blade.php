@extends('admin.layout.main')
@section('main')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Lote</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route("admin-dashboard")}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{route("admin-lote")}}">Lote</a></li>
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
                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('error') !!}</li>
                        </ul>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">

                        <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="foto">Foto pricipal <span style="color: red">*</span></label>
                                  <input type="file" name="foto" class="form-control-file" accept="image/*" id="foto" placeholder="foto" >
                              </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                                <label for="foto">Fotos</label>
                                <input type="file" name="fotos[]" multiple class="form-control-file" accept="image/*" id="fotos" placeholder="foto" >
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col col-sm-6">
                          <div class="form-group">
                              <label for="id-leilao">Leilão <span style="color: red">*</span></label>
                              <select name="id-leilao" required id="id-leilao" class="form-control">
                                <option value="">Selecione o leilao</option>
                                @foreach ($leiloes as $leilao)
                                <option value="{{$leilao->id}}">{{$leilao->nome}}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="lote">LOTE <span style="color: red">*</span></label>
                              <input type="number" required min="0" name="lote" class="form-control" id="lote" placeholder="Ex: Lote: 01" >
                            </div>
                        </div>
                      </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome">Nome <span style="color: red">*</span></label>
                                    <input type="text" name="nome" required class="form-control" id="nome" placeholder="Nome" >
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="url">URL <span style="color: red">*</span></label>
                                    <input type="text" name="url" required class="form-control" id="url" placeholder="URL" >
                                  </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="data-init">Data ínicio <span style="color: red">*</span></label>
                                  <input type="datetime-local" required name="data-init" class="form-control" id="data-init" placeholder="DD-MM-AAAA HH:MM">
                                  <small id="passwordHelpBlock" class="form-text text-muted">
                                    É obrigatorio o formato dia (DD), mês (MM), ano (AAAA), hora(s) (HH), minuto(s) (MM) <br>DD-MM-AAAA HH:MM
                                  </small>
                              </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                                <label for="data-fim">Data Final <span style="color: red">*</span></label>
                                <input type="datetime-local" required name="data-fim" class="form-control" id="data-fim" placeholder="DD-MM-AAAA HH:MM">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                  É obrigatorio o formato dia (DD), mês (MM), ano (AAAA), hora(s) (HH), minuto(s) (MM) <br>DD-MM-AAAA HH:MM
                                </small>
                            </div>
                        </div>
                      </div>

                      <script>
                        $("#data-init").mask("00-00-0000 00:00");
                        $("#data-fim").mask("00-00-0000 00:00");
                      </script>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="categoria">Categoria <span style="color: red">*</span></label>
                              <input type="text" name="categoria" required class="form-control" id="categoria" placeholder="Ex: Carro, Moto, Celular..." >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="codigo">Código</label>
                              <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Ex: B54ADF" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="lance-inicial">Lance ínicial</label>
                              <input type="text" name="lance-inicial" onkeyup="formatarMoeda()" class="form-control" id="lance-inicial"  placeholder="Ex: 15,493.97" >
                              <script>
                                
                                function formatarMoeda(){
                                  var elemento = document.getElementById('lance-inicial');
                                  var valor = elemento.value;
                                  
                                  if(valor != "") {
                                    valor = valor + '';
                                    valor = parseInt(valor.replace(/[\D]+/g,''));
                                    valor = valor + '';
                                    valor = valor.replace(/([0-9]{2})$/g, ",$1");

                                    if (valor.length > 6) {
                                      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                                    }

                                    elemento.value = valor;
                                  }

                                }
                              </script>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="tipo">Tipo <span style="color: red">*</span></label>
                              <select name="tipo" id="tipo" required class="form-control">
                                <option value="">Selecione o tipo do Lote </option>
                                <option value="Extrajudicial">Extrajudicial</option>
                                <option value="Recuperação de financiamento">Recuperação de financiamento</option>
                                <option value="Sucata">Sucata</option>
                              </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="modalidade">Modalidade <span style="color: red">*</span></label>
                              <select name="modalidade" required id="modalidade" class="form-control">
                                <option value="">Selecione a modalidade do Lote </option>
                                <option value="1">Online</option>
                                <option value="2">Precensial</option>
                                <option value="3">Online e Precensial</option>
                              </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="aovivo">Iframe aovivo</label>
                              <input type="text" class="form-control" name="aovivo" id="aovivo" placeholder="ex: <iframe src=..." >
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="mb-3">
                              <textarea name="descricao" id="descricao" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"></textarea>
                            </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                            <label for="informacoes">Informações</label>
                            <div class="mb-3">
                              <textarea name="informacoes" id="informacoes" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;"></textarea>
                            </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="status">Status <span style="color: red">*</span></label>
                            <select name="status" required id="status" class="form-control">
                              <option value="">Selecione o status do Lote </option>
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