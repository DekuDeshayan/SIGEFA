<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h3 class="m-0">Pagamento de facturas</h3>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="./home">Home</a></li>
            <li class="breadcrumb-item active">pagarfactura</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <div class="row EfectuarPayment">
        <div class="col-lg-4 mb-lg-0 mb-3">
            <div class="card p-3">
                <div class="img-box" style="width:100px; height:50px"> <img src="<?php echo BASE_URL;?>/assets/images/mpesa.jpg" alt=""> </div>
                <div class="number"> <label class="fw-bold" for="">**** **** **** </label> </div> 
                <div class="d-flex align-items-center justify-content-between"> <small><span class="fw-bold">MPESA</span></small> </div>
            </div>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-3">
            <div class="card p-3">
                <div class="img-box"> <img src="https://www.freepnglogos.com/uploads/mastercard-png/file-mastercard-logo-svg-wikimedia-commons-4.png" alt=""> </div>
                <div class="number"> <label class="fw-bold">**** **** **** </label> </div>
                <div class="d-flex align-items-center justify-content-between"> <small><span class="fw-bold">MASTERCARD</span></small>  </div>
            </div>
        </div>
        <div class="col-lg-4 mb-lg-0 mb-3">
            <div class="card p-3">
                <div class="img-box"> <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt=""> </div>
                <div class="number"> <label class="fw-bold">**** **** ****</label> </div>
                <div class="d-flex align-items-center justify-content-between"> <small><span class="fw-bold">VISA</span></small> </div>
            </div>
        </div>
       

        <div class="col-12">
            <div class="card p-3">
                <div class="card-body border p-0">
                    <div class="collapse p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-8">
                                <p class="h4 mb-0">Summary</p>
                                <p class="mb-0"><span class="fw-bold">Product:</span><span class="c-green">: Name of product</span></p>
                                <p class="mb-0"><span class="fw-bold">Price:</span><span class="c-green">:$452.90</span></p>
                                <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque nihil neque quisquam aut repellendus, dicta vero? Animi dicta cupiditate, facilis provident quibusdam ab quis, iste harum ipsum hic, nemo qui!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border p-0">
                    <p> <a class="btn btn-primary p-2 w-100 h-100 d-flex align-items-center justify-content-between"  role="button" aria-expanded="true" aria-controls="collapseExample"> <span class="fw-bold">PAGAMENTO VIA M-PESA BUSINESS</span> <span class=""> </span> </span> </a> </p>
                    <div class="collapse show p-3 pt-0" id="collapseExample">
                        <div class="row">
                            <div class="col-lg-5 mb-lg-0 mb-3">
                                <p class="h4 mb-0">Detalhes</p>
                                <p class="mb-0"><span class="fw-bold">Cliente:</span><span class="c-green">: <?php echo $infopayment['nome']." ".$infopayment['apelido']; ?> </span> </p>
                                <p class="mb-0"><span class="fw-bold">Factura №:</span><span class="c-green">: <?php if(isset($_GET['factura'])) echo $_GET['factura'];?> </span> </p>
                                <p class="mb-0"><span class="fw-bold">Contador №:</span><span class="c-green">: <?php echo $infopayment['nr_contador'];?></span> </p>
                                <p class="mb-0"> <span class="fw-bold">Valor a pagar:</span> <span class="c-green">: <?php if(isset($_GET['valor'])) echo $_GET['valor']."MZN";?></span> </p>
                                <p class="mb-0"> <span class="fw-bold">Multa:</span> <span class="c-green">: 0.0 MZN</span> </p>
                                <p class="mb-0"> <span class="fw-bold">Total:</span> <span class="c-green">: <?php if(isset($_GET['valor'])) echo $_GET['valor']."MZN";?></span> </p>
                                <p class="mb-0"> <span class="fw-bold">Endereco do contrato:</span> <span class="c-green">: <?php echo $infopayment['cidade'].", ".$infopayment['endcontrBairro'].", Av. ".$infopayment['avenida'].", Q. ".$infopayment['endcontrQuarte'].", Casa №. ".$infopayment['endcontrNrcasa'];?></span> </p>
                                <!--//endcontr.nr_casa as endcontrNrcasa, endcontr.quarteirao as endcontrQuarte, endcontr.bairro as endcontrBairro, endcontr.avenida, endcontr.cidade -->
                            </div>
                            <div class="col-lg-7">
                                <form method="POST" id="form_efectuar_payment">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form__div"> <label for="" class="form__label">Telefone</label> <input type="text" class="form-control" name="telefone" placeholder="telefone">  </div>
                                        </div>
                                      
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100 payment ">Pagar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.row -->
    </div><!-- /-fluid -->
</section>
<!-- /.content -->
<br>
<br>
<br>
<br>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');



 {
    margin: 30px auto
}

 .card {
    width: 100%;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background: #fff;
    border-radius: 0px
}

body {
    background: #eee
}

.btn.btn-primary {
    background-color: #ddd;
    color: black;
    box-shadow: none;
    border: none;
    font-size: 20px;
    width: 100%;
    height: 100%
}

.btn.btn-primary:focus {
    box-shadow: none
}

 .card .img-box {
    width: 80px;
    height: 50px
}

 .card img {
    width: 100%;
    object-fit: fill
}

 .card .number {
    font-size: 24px
}

 .card-body .btn.btn-primary .fab.fa-cc-paypal {
    font-size: 32px;
    color: #3333f7
}

.fab.fa-cc-amex {
    color: #1c6acf;
    font-size: 32px
}

.fab.fa-cc-mastercard {
    font-size: 32px;
    color: red
}

.fab.fa-cc-discover {
    font-size: 32px;
    color: orange
}

.c-green {
    color: green
}

.box {
    height: 40px;
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ddd
}

.btn.btn-primary.payment {
    background-color: #1c6acf;
    color: white;
    border-radius: 0px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 24px
}

</style>