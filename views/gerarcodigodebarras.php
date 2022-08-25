<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Área de geração de código de barras</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">gerarcodigodebarras</li>
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
            <div class="card card-success gerarBarcode">
                <div class="card-header hide-on-print" >
                    <h3 class="card-title hide-on-print" >Dados do contador</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <div class="row">
                        <div class="col-md-5 well">
                            <hr style="border-top:1px dotted #ccc;"/>
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <form method="POST" id="form_gerarcodigodebarras">
                                    <div class="form-group">
                                        <label class="hide-on-print">Introduza o numero do contador</label>
                                        <input type="text" class="form-control hide-on-print" name="numerocontador" data-inputmask='"mask": "99-9999999-9999999"' data-mask/>
                                        <?php //include 'generate.php'?>
                                    </div>
                                    
                                    <br/>
                                        <center><button type="submit" class="btn btn-success hide-on-print" >Gerar</button></center>
                                    <br />
                                </form>
                            </div>
                        </div>
                        <div class="col-md-1 well"></div>
                        <div id="barcode" class="col-md-5 well " style="background:#f4f6f9;border-radius:4px; padding:40px 0;">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>