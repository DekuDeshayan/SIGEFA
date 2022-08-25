<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="m-0">Registo de leitura de contador</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">registarleitura</li>
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
        <div class="card card-success registarLeitura">
            <div class="card-header">
                <h3 class="card-title">Dados da leitura</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="form_registar_leitura">
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
                                    <input type="text" class="form-control" placeholder="xx-xxxxxxx-xxxxxxx" name="nr_contador" data-inputmask='"mask": "99-9999999-9999999"' data-mask  autofocus >
                                </div>
                            </div>
                        </div>
                        <!--End Left column-->

                        <!--Right column-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <label >Leitura</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="xxxxxxxxxxxx" name="leitura">
                                </div>
                            </div>
                        </div>
                        <!--End Right column-->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Registar</button>
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