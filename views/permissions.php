<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Permissões do sistema</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">permissoes</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-success card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item col-sm-6">
                            <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Permissões</a>
                            </li>

                            <li class="nav-item col-sm-6">
                            <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Grupos de Permissões</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
    
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                               <table class="table col-12 table-responsive   table-hover">
                                   <tr > <td colspan="3"><a href="./addpermissions" class="btn btn-sm btn block bg-success">Adicionar permissoes</a></td></tr>
                                   <tr class="text-center">
                                       <td>#ID Permissao</td>
                                       <td>Nome da Permissao</td>
                                       <td>ACCAO</td>
                                   </tr>
                                   <?php foreach($lista_de_permissoes as $mostrarLista_de_permissoes):?>
                                    <tr>
                                        <td><?php echo $mostrarLista_de_permissoes['idpermissionsparams'];?></td>
                                        <td><?php echo $mostrarLista_de_permissoes['name'];?></td>
                                        <td>
                                            <span class='removerPermissoes btn btn-sm btn-danger' data-id='<?php echo $mostrarLista_de_permissoes["idpermissionsparams"];?>' ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                               </table>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <table class="table col-12 table-responsive table-stripped table-hover">
                                   <tr > <td colspan="3"><a href="<?php echo BASE_URL?>/addgroups" class="btn btn-sm btn block bg-success">Adicionar grupos</a></td></tr>
                                   <tr class="text-center">
                                       <td>#ID Grupo</td>
                                       <td>Nome do grupo</td>
                                       <td>parametros</td>
                                       <td>ACCAO</td>
                                   </tr>
                                   <?php foreach($lista_de_grupos_de_permissoes as $mostrarlista_de_grupos_de_permissoes):?>
                                    <tr>
                                        <td><?php echo $mostrarlista_de_grupos_de_permissoes['idpermissions'];?></td>
                                        <td><?php echo $mostrarlista_de_grupos_de_permissoes['name'];?></td>
                                        <td><?php echo $mostrarlista_de_grupos_de_permissoes['params'];?></td>
                                        <td>
                                            <a href='./editargrupos?idgroup=<?php echo $mostrarlista_de_grupos_de_permissoes['idpermissions'];?>' class='btn btn-sm btn-success'>Editar</a>
                                            &nbsp;&nbsp;
                                            <span class='removerGrupos btn btn-sm btn-danger' data-id='<?php echo $mostrarlista_de_grupos_de_permissoes["idpermissions"];?>' ><i class="fa fa-trash" aria-hidden="true"></i></span>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                               </table>
                               
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>  
</section>