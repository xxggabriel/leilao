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
                            <h1>Nome do leilão: {{$nomeLeilao}}</h1>
                          </div>
                        </div><br>
                        <div class="row">
                          <div class="col">
                              <div class="form-group">
                                <img src="{{ Storage::url($lote->foto)}}" style="width: 100px; margin: 5px;" alt="">
                                  <label for="foto">Foto pricipal <span style="color: red">*</span></label>
                                  <input type="file" name="foto" class="form-control-file" accept="image/*" id="foto" placeholder="foto" >
                              </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <div class="row">
                                @foreach (explode(";", $lote->fotos) as $foto)
                                <img src="{{ Storage::url($foto)}}" style="width: 100px;margin: 5px;" alt="">
                                @endforeach
                              </div>
                                <label for="foto">Fotos</label>
                                <input type="file" name="fotos[]" multiple class="form-control-file" accept="image/*" id="fotos" placeholder="foto" >
                            </div>
                        </div>
                      </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nome">Nome <span style="color: red">*</span></label>
                                    <input type="text"  value="{{$lote->nome}}" name="nome" required class="form-control" id="nome" placeholder="Nome" >
                                  </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="url">URL <span style="color: red">*</span></label>
                                    <input type="text"  value="{{$lote->url}}" name="url" required class="form-control" id="url" placeholder="URL" >
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label for="data-init">Lote <span style="color: red">*</span></label>
                              <input type="number" required min="0" value="{{$lote->lote}}" name="lote" class="form-control" id="lote">
                              
                          </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                              <div class="form-group">
                                  <label for="data-init">Data ínicio <span style="color: red">*</span></label>
                                  <input type="datetime-local" required  value="{{str_replace(" ", "T", $lote->data_init)}}" name="data-init" class="form-control" id="data-init" placeholder="DD-MM-AAAA HH:MM">
                                  
                              </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                                <label for="data-fim">Data Final <span style="color: red">*</span></label>
                                <input type="datetime-local" required  value="{{str_replace(" ", "T", $lote->data_fim)}}" name="data-fim" class="form-control" id="data-fim" placeholder="DD-MM-AAAA HH:MM">
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="categoria">Categoria <span style="color: red">*</span></label>
                              <input type="text"  value="{{$lote->categoria}}" name="categoria" required class="form-control" id="categoria" placeholder="Ex: Carro, Moto, Celular..." >
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="codigo">Código</label>
                              <input type="text"  value="{{$lote->codigo}}" name="codigo" class="form-control" id="codigo" placeholder="Ex: B54ADF" >
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group">
                              <label for="lance-inicial">Lance ínicial</label>       
                              <input type="text"  value="{{money_format("%(#10n", $lote->lance_inicial)}}" name="lance-inicial" onkeyup="formatarMoeda()" onfocus="formatarMoeda()" class="form-control" id="lance-inicial"  placeholder="Ex: 15,493.97" >
                             
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="lance-minimo">Lance Minimo</label>
                              <input type="text" value="{{money_format("%(#10n",$lote->lance_minimo)}}"  name="lance-minimo" id="lance-minimo" onkeyup="formatarMoeda()" onfocus="formatarMoeda()" class="form-control">
                          </div>
                        </div>
                      </div>
                      <script>
                        $(function(){
                          formatarMoeda()
                        })
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
                          var elemento = document.getElementById('lance-minimo');
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
                      <div class="row">
                        <div class="col-6">
                          
                            <div class="form-group">
                                <label for="tipo">Tipo <span style="color: red">*</span></label>
                                <select   name="tipo" id="tipo" required class="form-control">
                                  <option value="{{$lote->tipo}}">{{$lote->tipo}}</option>
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
                              <select   name="modalidade" required id="modalidade" class="form-control">
                                
                                <option value="{{$lote->modalidade}}">
                                  @if($lote->status == 0)
                                  Online
                                  @elseif($lote->status == 1)
                                  Precensial
                                  @elseif($lote->status == 2)
                                  Online e Precensial
                                  @endif
                                </option>
                                <option value="1">Online</option>
                                <option value="2">Precensial</option>
                                <option value="3">Online e Precensial</option>
                              </select>
                          </div>
                        </div>
                        <div class="col">
                          <div class="form-group">
                              <label for="aovivo">Iframe aovivo</label>
                              <input type="text" class="form-control"  value="{{$lote->aovivo}}" name="aovivo" id="aovivo" placeholder="ex: <iframe src=..." >
                          </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <div class="mb-3">
                              <textarea  name="descricao" id="descricao" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;">
                                {{$lote->descricao}}
                              </textarea>
                            </div>
                        </div>
                      </div>

                      <div class="col">
                        <div class="form-group">
                            <label for="informacoes">Informações</label>
                            <div class="mb-3">
                              <textarea  name="informacoes" id="informacoes" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px; display: none;">
                                {{$lote->informacoes}}
                              </textarea>
                            </div>
                        </div>
                      </div>


                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="form-group">
                            <label for="status">Status <span style="color: red">*</span></label>
                            <select   name="status" required id="status" class="form-control">
                              <option value="{{$lote->status}}">
                                @if($lote->status == 0)
                                Não visivel
                                @elseif($lote->status == 1)
                                Normal
                                @elseif($lote->status == 2)
                                Reagendado
                                @elseif($lote->status == 2)
                                Cancelado
                                @endif
                              </option>
                              
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
                        <button type="submit" class="btn btn-primary">Atualizar</button>
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