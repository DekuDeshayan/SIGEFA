<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="m-0">Celebração de contratos</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">celebrarcontrato</li>
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
        <div class="card card-success celebrarContrato">
            <div class="card-header">
                <h3 class="card-title">Dados do contrato</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="form_celebrar_contrato">
                <div class="card-body">
                    <div class="row">
                        <!--Left column-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Pesquise o cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="cliente" >
                                    <option disabled selected >pesquise o cliente</option>
                                        <?php foreach($cliente as $buscarcliente):?>
                                            <option value="<?php echo $buscarcliente['idcliente'];?>" ><?php echo $buscarcliente['nome']." ".$buscarcliente['apelido'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label >Cidade</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-city"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Cidade" name="cidade">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Número de casa</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número de casa" name="nr_casa">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Avenida</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Avenida" name="avenida">
                                </div>
                            </div>


                        </div>
                        <!--End Left column-->

                        <!--Right column-->
                        <div class="col-md-6">

                            
                            <div class="form-group">
                                <label >Pesquise o contador</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-faucet"></i></span>
                                    </div>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="contador" >
                                        <option disabled selected >xx-xxxxxxx-xxxxxxx</option>
                                        <?php foreach($contador as $contadorsemcontrato):?>
                                            <option value="<?php echo $contadorsemcontrato['idcontador']; ?>"><?php echo $contadorsemcontrato['nr_contador']; ?> </option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Bairro</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Bairro" name="bairro">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Quarteirão</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Quarteirão" name="quarteirao">
                                </div>
                            </div>
                        </div>
                        <!--End Right column-->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Submeter</button>
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