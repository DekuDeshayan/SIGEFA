<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="m-0">Emissão de faturas</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">emitirfatura</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-success emitirfactura">
            <div class="card-header">
                <h3 class="card-title">Dados da fatura</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="form_emitir_fatura">
                <div class="card-body">
                    <div class="row">
                        <!--Left column-->
                        <div class="col-md-7">

                            <div class="form-group">
                                <label >Aponte o código de barras ou introduze o número do contador do cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-barcode fa-x1"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xx-xxxxxxx-xxxxxxx" name="nr_contador" id="numbercontador" data-inputmask='"mask": "99-9999999-9999999"' data-mask autofocus >
                                </div>
                            </div>

                            <div class="form-group">
                                <label id="id_leitura_act" >Leitura actual m<sup>3</sup></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="" placeholder="xxxx"  id="leitura_actual" name="leitura_actual" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Valor a pagar</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-coins"></i> </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Valor a pagar" name="valor_pagar" id="valor_pagar">
                                </div>
                            </div>

                        </div>
                        <!--End Left column-->

                        <!--Right column-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label >Leitura anterior m<sup>3</sup></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xxxx"  id="leitura_anterior" name="leitura_anterior">
                                </div>
                            </div>
                            <div class="form-group">
                                <label >Consumo m<sup>3</sup></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hourglass-half"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xxxx" name="consumo" id="consumo" >
                                </div>
                            </div>
                        </div>
                        <!--End Right column-->
                    </div>

                    <div class="row mt-4">
                        <!--Info's do cliente-->
                        <div class="col-12 col-sm-6 col-md-7 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-primary border-bottom-0">
                                    Informações do cliente
                                    </div>
                                    <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                        
                                        <p class="text-muted text-sm " ><b class="enderecoCli"></b></p>

                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                            <li class="small mb-3">
                                                <span class="fa-li"><i class="fas fa-lg fa-key"></i></span> <b>Número do Cliente:</b>
                                                <span  id="nrCli"></span>
                                            </li>
                                            <li class="small mb-3">
                                                <span class="fa-li"><i class="fas fa-lg fa-user"></i></span> <b>Nome:</b> 
                                                <span id="nomeCli"></span>
                                            </li>
                                            <li class="small mb-3">
                                                <span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> <b>Nuit:</b> 
                                                <span id="nuitCli"></span>
                                            </li>
                                            <li class="small mb-3"><span class="fa-li">
                                                <i class="fas fa-lg fa-building"></i></span> <b>Endereco:</b>
                                                <span id="enderecoCli"></span>
                                            </li>
                                            <li class="small mb-3">
                                                <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> <b>Data de adesão:</b>
                                                <span id="dataAdesaoCli"></span>
                                            </li>
                                            <li class="small mb-3">
                                                <span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> <b>Telefone #:</b>
                                                <span id="telefoneCli"></span>
                                            </li>
                                        </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                        <img src="<?php echo BASE_URL;?>/views/plugins/adminlte/img/avatar4.png" alt="user-avatar" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Fim Info's do cliente-->

                         <!--Info's do contrato-->
                       
                        <div class="col-12 col-sm-6 col-md-5 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-primary border-bottom-0 ">
                                   Informações do contrato
                                    </div>
                                    <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                        
                                            <p class="text-muted text-sm mb-3"><b> </b> </p>

                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small mb-3">
                                                    <span class="fa-li"><i class="fas fa-lg fa-key"></i></span> <b>Número do contrato:</b>
                                                    <span id="nrContrato"></span>
                                                </li>
                                                <li class="small mb-3">
                                                    <span class="fa-li"><i class="fas fa-lg fa-calendar"></i></span> <b>Data de início:</b>
                                                    <span id="dataInicioContrato"></span>
                                                </li>
                                                <li class="small mb-3">
                                                    <span class="fa-li"><i class="fas fa-lg fa-faucet"></i></span> <b>Número do contador:</b>
                                                    <span  id="nrContador"></span>
                                                </li>
        
                                                <li class="small mb-3">
                                                    <span class="fa-li"><i class="fas fa-lg fa-building"></i></span> <b>Endereco do contrato:</b>
                                                    <span id="enderecoContrato"></span>
                                                </li>
                                            </ul>
                                        </div>
                                       
                                    </div>
                                    </div>
                                    <div class="card-footer">
                                    <div class="text-right">
                                        <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-signature"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Fim Info's do contrato-->
                    </div>
                    <br>
                    <br>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success" id="emitirInvoice">Emitir</button>
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
<!-- /.content -->