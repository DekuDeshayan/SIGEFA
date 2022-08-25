<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Editar grupo de permissões</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">editargrupos</li>
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
                <div class="card card-success editarGrupos">
                    <div class="card-header">
                        <h3 class="card-title">Dados do grupo de  Permissões</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" id="form_editar_grupos" name="form_cadastrar_grupos"  >
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Nome
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="nomegroup" id="nomegroup" placeholder="Nome do grupo de permissões" value="<?php echo $groupinfo['name'];?>" >
                            </div>
                        </div>
                        <div class="form-group clearfix">
                                <label>
                                Permissões a associar
                                </label>
                                <br>
                            <?php foreach($lista_de_permissoes as $mostrarlista_de_permissoes):?>
                                <div class="icheck-success">
                                    <input type="checkbox" name="params[]" id="<?php echo $mostrarlista_de_permissoes['idpermissionsparams']?>" value="<?php echo $mostrarlista_de_permissoes['idpermissionsparams']?>"  <?php echo (in_array($mostrarlista_de_permissoes['idpermissionsparams'], $groupinfo['params'] ) ) ?'checked="checked"':'' ;?> >
                                    <label for="<?php echo $mostrarlista_de_permissoes['idpermissionsparams']?>">
                                    <?php  echo $mostrarlista_de_permissoes['name']?>
                                    </label>
                                </div>
                            <?php endforeach;?>
                            <br>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Editar</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

