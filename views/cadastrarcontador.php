<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h4 class="m-0">Cadastro de contador</h4>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">cadastrarcontador</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-info cadastroContadores">
                    <div class="card-header">
                        <h3 class="card-title">Dados do contador</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" id="form_cadastrar_contadores" name="form_cadastrar_contadores">
                    <div class="card-body">
                        <div class="form-group">
                            <label > Numero do contador</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-faucet"></i></span>
                                </div>
                                <input type="text" class="form-control" name="numerocontador" data-inputmask='"mask": "99-9999999-9999999"' data-mask  >
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Cadastrar</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

