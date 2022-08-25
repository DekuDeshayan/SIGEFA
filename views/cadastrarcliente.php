<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="m-0">Cadastro de clientes</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">cadastrarcliente</li>
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
        <div class="card card-success cadastrarClientes">
            <div class="card-header">
                <h3 class="card-title">Dados do cliente</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" id="cadastrarClientes">
                <div class="card-body">
                    <div class="row">
                        <!--Left column-->
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label >Nome</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Primeiro nome" name="nome">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Bilhete de Identidade</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número de BI" name="bi">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Telefone 1</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Telefone 1 (obrigatório)" name="telefone1">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Sexo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                                    </div>
                                    <select class="form-control"  name="sexo">
                                        <option disabled selected   >Seleccione o sexo</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option> 
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Nacionalidade</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nacionalidade" name="nacionalidade">
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
                                <label >Número de casa</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número de casa" name="nr_casa">
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label >Nome de utilizador</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nome de utilizador" name="username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Palavra passe</label>
                                <input type="password"  class="form-control"  placeholder="Palavra passe"  name="palavra_passe" id="palavra_passe">
                            </div>

                            <div class="form-group">
                                <label>Confirme a palavra passe</label>
                                <input type="password" class="form-control"  placeholder="Confirme a palavra passe"  name="confirmar_p_passe">
                            </div>

                        </div>
                        <!--End Left column-->

                        <!--Right column-->
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Apelido</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Apelido" name="apelido">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Nuit</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Número Nuit" name="nuit">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Telefone 2</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Telefone 1 (opcional)" name="telefone2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Data de nascimento</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Data de nascimento" name="data_nascimento">
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
                                <label >Quarteirão</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Quarteirão" name="quarteirao">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Email</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email de utilizador" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label >Data de cadastro (Data de inicio)</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="date" class="form-control"  name="data_inicio">
                                </div>
                            </div>

                        </div>
                        <!--End Right column-->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
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