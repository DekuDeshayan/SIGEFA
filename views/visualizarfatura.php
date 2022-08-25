<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Ver Minhas Facturas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">visualizarfaturas</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>


<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header ">
                <h3 class="card-title">Dados das faturas</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="pesquisar">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead >
                    <tr>
                      <th>#Número da factura</th>
                      <th>#Data de Emissao</th>
                      <th>#Data Limite de pagamento</th>
                      <th>#Valor a Pagar</th>
                      <th>#Status</th>
                      <th>#Accao</th>
                    </tr>
                  </thead>
                  <tbody>
                     	
                    <?php foreach($facturas as $visualizarfacturas):?>
                      <tr>
                        <td><?php echo $visualizarfacturas['idfactura'];?></td>
                        <td><?php echo $visualizarfacturas['data_emissao'];?></td>
                        <td><?php echo $visualizarfacturas['data_limite'];?></td>
                        <td><?php echo $visualizarfacturas['valor_pagar'];?></td>
                        <td><?php if ($visualizarfacturas['status_pagamento']==1){echo "Pago";}else if($visualizarfacturas['status_pagamento']==0){echo "Não Pago";} ;?></td>
                        <td> <a href="./visualizarfatura/gerarPDF/<?php echo $visualizarfacturas['idfactura'];?>" target="_blank"  class="btn btn-sm btn-danger ">PDF <i class="far fa-file-pdf fa-1x"></i> </a> <a href="./pagamento?factura=<?php echo $visualizarfacturas['idfactura'].'&valor='.$visualizarfacturas['valor_pagar'];?>" class="btn btn-sm btn-success <?php if ($visualizarfacturas['status_pagamento']==1){echo "disabled";}?>"> PAGAR <i class="far fa-credit-card"></i> </a> </td>
                      </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>  
</section>




