$(document).ready(function(){

    $(document).on("keydown", "form", function(event) { 
        return event.key != "Enter";
    });

    // $('#imprimirBarcode').on('click', function(){
    //    window.print();
    //    return false;
    // });

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
    theme: 'bootstrap4'
    })

    //Initialize Jquery input mask
    $('[data-mask]').inputmask();

    /*
    *Metodo de validacao customizado: para verificar numero de contador
    *
    */

    jQuery.validator.addMethod("validarNumeroContador", function(value) {
        return (/^\d{2}\-\d{7}\-\d{7}$/.test(value));
    }, "*Número de contador inválido, o número de contador deve possuir no mínimo/máximo 16 dígitos");


    
    /*
    *Metodo de validacao customizado: para campos que apena aceitam letras e nenhum espaço
    *
    */

    jQuery.validator.addMethod("verificarletrasApenasEespaco", function(value) {
        return (/^[A-Za-z]+$/.test(value));
    }, "*Este campo aceita apenas letras e nenhum espaço");


    /*
    *Metodo de validacao customizado: para campos que apena aceitam letras e espaço
    *
    */

    jQuery.validator.addMethod("apenasLetraseEspacos", function(value) {
        return (/^[a-zA-Z\s]*$/.test(value));
    }, "*Este campo aceita apenas letras e espacos");


    /*
    *Metodo de validacao customizado : para verificar número de telefone
    *
    */

    jQuery.validator.addMethod("verificarNumerodetelefone", function(value) {
        return (/^(84|82|83|85|86|87)([0-9]{7})$/.test(value));
    }, "*Número de telefone inválido");

    
    /*
    *Metodo de validacao customizado : para verificar número de Bilhete de Identidade
    *
    */
    
    jQuery.validator.addMethod("verificarNumerodeBi", function(value) {
        return (/^[0-9]{12}[A-Z]$/.test(value));
    }, "*Número de BI inválido");


    /**
     * Efectuar pagamento
     */

    //x

    $("#form_efectuar_payment").validate({
        rules: {
            telefone: {
            required: true,
            minlength:0,
            maxlength:9,
            verificarNumerodetelefone: true
            }
        },
        messages: {
            telefone: {
            required: "Este campo é obrigatório!",
            minlength: "O telefone tem no minimo 9 digitos!",
            maxlength: "O telefone tem no máximo 9 digitos"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {

            const urlParams = new URLSearchParams(window.location.search);
            const invoiceID = urlParams.get('factura');
            const valor_pagar = urlParams.get('valor');
            
            $(".EfectuarPayment").preloader({
                text: 'A processar o pagamento, aguarde', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                dataType: 'json',
                async: 'true',
                url:BASE_URL+"/ajax/pagarFactura",
                data:$(form).serialize()+'&facturid='+invoiceID+'&valor='+valor_pagar,
                success:function(jSon){

                    //console.log(invoiceID+" "+valor_pagar);

                    //console.log(jSon);
                    //console.log(jSon.respon);

                 // for(var i in jSon.respon){

                    if(jSon.respon=='success'){

                        form.reset();
            
                        setTimeout(function(){
                            $('.EfectuarPayment').preloader('remove');
                        },4000);


                        setTimeout(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'Pagamento efectuado com sucesso, Obrigado pela preferência!',
                                showConfirmButton: true,                              
                            });
                        },5000);

                    }

                  //}
                    
                
                }
            });
        
         return false;
        }
    });




    //busca de informacoes e calculos para  a facturacao

    //validar registo de leitura de contador

    $('#numbercontador').change(function(){
        if( $(this).val() ) {
    
                $(".emitirfactura").preloader({
                    text: 'A processar', 
                    zIndex: '1',
                    setRelative: true 
                });

            $.getJSON(BASE_URL+'/ajax/buscarDadosPraFatura',{nr_contador: $(this).val(), ajax: 'true'}, function(jSon){
      
            // console.log(jSon)

              if(jSon.dados_factura.resultado == 'void' || jSon.dados_factura.length==0){

                    setTimeout(function(){
                        $('.emitirfactura').preloader('remove');
                    },500);

                    setTimeout(function(){

                        Swal.fire({
                            icon: 'error',
                            title: 'Nenhum resultado foi encontrado para este contador',
                            showConfirmButton: true
                        });

                    },700);

              }else{

                //Calculos de valores a pagar na factura
                var  l_anterior  = jSon.dados_factura.ultima_associada;
                var  l_actual  = jSon.dados_factura.ultima_n_associada;
                let consumo =  jSon.dados_factura.ultima_n_associada-jSon.dados_factura.ultima_associada;
                let valor_pagar = consumo * 60;

                if(consumo<0){

                $('#emitirInvoice').prop('disabled', true);

                }

               //populacao de informacoes do cliente 
               $("#nrCli").text(jSon.dados_factura.info_cliente_contrato.idcliente);
               $("#nrCli").attr("data-id", jSon.dados_factura.info_cliente_contrato.idcliente);
               $("#nomeCli").text(jSon.dados_factura.info_cliente_contrato.nome+" "+jSon.dados_factura.info_cliente_contrato.apelido);
               $("#nuitCli").text(jSon.dados_factura.info_cliente_contrato.nuit);
               $("#enderecoCli, .enderecoCli").text(jSon.dados_factura.info_cliente_contrato.cliBairro+", Casa № "+jSon.dados_factura.info_cliente_contrato.cliNrcasa+", Quart № "+jSon.dados_factura.info_cliente_contrato.cliQuarte);
               $("#dataAdesaoCli").text(jSon.dados_factura.info_cliente_contrato.cliDataInic);
               $("#telefoneCli").text(jSon.dados_factura.info_cliente_contrato.telefone1);

               //populacao de informacoes do contrato 
               $("#nrContrato").text(jSon.dados_factura.info_cliente_contrato.idcontrato);
               $("#dataInicioContrato").text(jSon.dados_factura.info_cliente_contrato.contraDataInic);
               $("#nrContador").text(jSon.dados_factura.info_cliente_contrato.nr_contador);
               $("#nrContador").attr("data-id", jSon.dados_factura.info_cliente_contrato.idcontador);
               $("#enderecoContrato").text(jSon.dados_factura.info_cliente_contrato.cidade+", "+jSon.dados_factura.info_cliente_contrato.endcontrBairro+", Av. "+jSon.dados_factura.info_cliente_contrato.avenida+", Casa № "+jSon.dados_factura.info_cliente_contrato.endcontrNrcasa+", Quart № "+jSon.dados_factura.info_cliente_contrato.endcontrQuarte);
              

                //calculo de consumo de agua...
                //1m^3 de agua custa 60MZN
                
                $("#leitura_anterior").val(l_anterior).prop("readonly", true);;
                $("#leitura_actual").val(l_actual).prop("readonly", true);
                $("#id_leitura_act").attr("data-id", jSon.dados_factura.ultima_n_associada_id);
                $("#consumo").val(consumo).prop("readonly", true);
                $("#valor_pagar").val(valor_pagar).prop("readonly", true);


              
                setTimeout(function(){
                    $('.emitirfactura').preloader('remove');
                },500);
	
              }

            
              
                
               
            });

           
        }
    });


    /**
     * Emitir factura
     */



    $("#form_emitir_fatura").validate({

        rules: {
            nr_contador: {
            required: true,
            validarNumeroContador:true
            },
            leitura_actual: {
            required: true,
            number:true
            },
            valor_pagar: {
            required: true,
            number:true
            },
            leitura_anterior: {
            required: true,
            number:true
            },
            consumo: {
            required: true,
            number:true
            }
        },
        messages: {
            nr_contador: {
            required: "Este campo é obrigatório!",
            },
            leitura_actual:{
            required: "Este campo é obrigatório!",
            number: "A leitura possui apenas dígitos"
            },
            valor_pagar:{
            required: "Este campo é obrigatório!",
            number: "O valor a pagar são números"
            },
            leitura_anterior:{
            required: "Este campo é obrigatório!",
            number: "A leitura possui apenas dígitos"
            },
            consumo:{
            required: "Este campo é obrigatório!",
            number: "O consumo possui apenas dígitos"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".emitirfactura").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });

        
            let id_leitura_act = $("#id_leitura_act").data("id");
            let id_cliente = $("#nrCli").data("id");

            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/emitirFactura", 
                data:$(form).serialize()+'&id_leitura_act='+id_leitura_act+'&id_cliente='+id_cliente,
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                        $('.emitirfactura').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            icon: 'success',
                            title: 'factura emitida com sucesso!',
                            showConfirmButton: true,
                        });

                    },5000);
        
                }
            });
        
         return false;
        }


    });


  
  



    /**
     * Registar leitura de contador
     */

    

     $("#form_registar_leitura").validate({
        rules: {
            nr_contador: {
            required: true,
            validarNumeroContador:true
            },
            leitura: {
            required: true,
            number:true
            }
        },
        messages: {
            nr_contador: {
            required: "Este campo é obrigatório!",
            },
            leitura:{
            required: "Este campo é obrigatório!",
            number: "A leitura possui apenas dígitos"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".registarLeitura").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/registarLeitura",
                data:$(form).serialize(),
                success:function(dados){
                    //console.log(dados);
                
                    form.reset();
            
                    setTimeout(function(){
                        $('.registarLeitura').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Leitura registada com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
         return false;
        }
    });


    
    /*
    *Celebracao de contrato :validacao de formulario e ajax
    *
    */


    $("#form_celebrar_contrato").validate({
        rules: {
            cliente: {
            required: true
            },
            contador: {
            required: true
            },
            avenida: {
            required: true,
            minlength:3
            },
            nr_casa:{
                required:true,
                number:true
            },
            bairro:{
                required:true,
                minlength:3
            },
            quarteirao:{
                required:true,
                number:true
            },
            cidade:{
                required:true,
                minlength:3,
                verificarletrasApenasEespaco: true
            }
        },
        messages: {
            nr_casa: {
                required: "Este campo é obrigatório!",
                number: "O numero de casa possui apenas dígitos",
            },
            bairro: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
            },
            quarteirao: {
                required: "Este campo é obrigatório!",
                number: "Este campo aceita apenas dígitos",
            },
            cidade: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            avenida: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
            },
            cliente: {
                required: "Este campo é obrigatório!",
            },
            contador: {
                required: "Este campo é obrigatório!",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".celebrarContrato").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/celebrarContract",
                data:$(form).serialize(),
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                        $('.celebrarContrato').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Contrato celebrado com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });


    
    /*
    *Cadastrar contador no sistema:validacao de formulario e ajax
    *
    */


    $("#form_cadastrar_contadores").validate({
        rules: {
            numerocontador: {
            required: true,
            validarNumeroContador:true
            }
        },
        messages: {
            numerocontador: {
            required: "Este campo é obrigatório!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".cadastroContadores").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                dataType: 'json',
                async: 'true',
                url:BASE_URL+"/ajax/cadastrarContador",
                data:$(form).serialize(),
                success:function(jSon){

                   console.log(jSon.info);


                   
             
                  // for(var i in jSon.resultado ){

                   // console.log(jSon.resultado[i].resultado);

                    if(jSon.info=="exists"){

                        form.reset();
            

                        setTimeout(function(){
                            $('.cadastroContadores').preloader('remove');
                        },4000);


                        setTimeout(function(){

                            Swal.fire({
                                //position: 'top-end',
                                icon: 'error',
                                title: 'Erro, nao pode cadastrar um contador existente',
                                showConfirmButton: true,
                                //timer: 1500
                            });
    

                        },5000);



                       
                    }else if(jSon.info=="not_exists"){

                        
                        form.reset();
            
                        setTimeout(function(){
                            $('.cadastroContadores').preloader('remove');
                        },4000);

                        
                        setTimeout(function(){

                            Swal.fire({
                                //position: 'top-end',
                                icon: 'success',
                                title: 'Contador cadastrado com sucesso!',
                                showConfirmButton: true,
                                //timer: 1500
                            });

                        },5000);





                       
                    }
        
                


                    
                }




            });
        
        
         return false;
        }
    });




    /**
     * Validacao do formulario para gerar código de barras
     */

     $("#form_gerarcodigodebarras").validate({
        rules: {
            numerocontador: {
            required: true,
            minlength:3,
            validarNumeroContador:true
            }
        },
        messages: {
            numerocontador: {
            required: "Este campo é obrigatório!",
            minlength: "Este campo requer pelo menos 3 caracteres"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".gerarBarcode").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                dataType: 'json',
                async: 'true',
                url:BASE_URL+"/ajax/gerarBarcode",
                data:$(form).serialize(),
                success:function(jSon){
                    $('#barcode').html("");
                    form.reset();
                    // console.log(jSon.printUrl);
                    $('#barcode').append(jSon.barcode+"</br>");
                    $('#barcode').append(`<center>${jSon.printUrl}</center>`);
                 
        
                    setTimeout(function(){
                        $('.gerarBarcode').preloader('remove');
                    },1000);
                   
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Código de barra gerado com sucesso, imprima-o pelo botao do lado esquerdo',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },2000);                    
                }

            });
        
        
         return false;
        }

    });


    /*
    *Cadastrar clientes no sistema:validacao de formulario e ajax
    *
    */

    $("#cadastrarClientes").validate({
        rules: {
            nome: {
            required: true,
            minlength:3,
            verificarletrasApenasEespaco: true
            },
            apelido: {
                required: true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            sexo: {
                required: true,
            },
            nacionalidade: {
                required: true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            data_nascimento: {
                required: true,
                date: true
            },
            data_inicio: {
                required: true,
                date: true
            },
            nuit:{
                required:true,
                minlength:9,
                maxlength:9,
                number:true
            },
            bi:{
                required:true,
                verificarNumerodeBi:true,
                minlength:13,
                maxlength:13

            },
            nr_casa:{
                required:true,
                number:true
            },
            bairro:{
                required:true,
                minlength:3,
            },
            quarteirao:{
                required:true,
                number:true
            },
            cidade:{
                required:true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            telefone1:{
                required:true,
                number: true,
                verificarNumerodetelefone:true,
                maxlength:9,
                minlength:9
            },
            telefone2:{
                required:false,
                number: true,
                verificarNumerodetelefone:true,
                maxlength:9,
                minlength:9
            },
            email:{
                required:true,
                email:true
            },
            username:{
                required:true,
                minlength:3,
                verificarletrasApenasEespaco:true
            },
            palavra_passe:{
                required:true,
                minlength:8
            },
            confirmar_p_passe:{
                required:true,
                minlength:8,
                equalTo:"#palavra_passe"
            }

        },
        messages: {
            nome: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            apelido: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            sexo: {
                required: "Este campo é obrigatório!"
            },
            nacionalidade: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            data_nascimento: {
                required: "Este campo é obrigatório!",
                date: "Esta data é inválida"
            },
            data_inicio: {
                required: "Este campo é obrigatório!",
                date: "Esta data é inválida"
            },
            nuit: {
                required:"Este campo é obrigatório!",
                minlength:"O nuit possui no minimo 9 digitos",
                maxlength:"O nuit possui no máximo 9 digitos",
                number:"Nuit Inválido, o nuit possui apenas dígitos"
            },
            bi: {
                required: "Este campo é obrigatório!",
                minlength: "O numero de bi possui no mínimo 13 digitos",
                verificarNumerodeBi:"Número de BI Inválido",
                maxlength:"O numero de bi possui no máximo 13 digitos"
            },
            nr_casa: {
                required: "Este campo é obrigatório!",
                number: "O numero de casa possui apenas dígitos",
            },
            bairro: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
            },
            quarteirao: {
                required: "Este campo é obrigatório!",
                number: "Este campo aceita apenas dígitos",
            },
            cidade: {
                required: "Este campo é obrigatório!",
                minlength: "Introduza no minimo 3 dígitos",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            telefone1: {
                required:"Este campo é obrigatório!",
                number: "Este campo aceita apenas dígitos",
                verificarNumerodetelefone:"Número de telefone inválido",
                maxlength:"O telefone possui no minimo 9 digitos",
                minlength:"O telefone possui no máximo 9 digitos"
            },
            telefone2: {
                number: "Este campo aceita apenas dígitos",
                verificarNumerodetelefone:"Número de telefone inválido",
                maxlength:"O telefone possui no máximo 9 digitos",
                minlength:"O telefone possui no minimo  9 digitos"
            },
            email: {
                required:"Este campo é obrigatório!",
                email:"Email inválido"
            },
            username: {
                required: "Este campo é obrigatório!",
                minlength: "O nome do grupo da permissão deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            palavra_passe: {
                required:"Este campo é obrigatório",
                minlength:"Introduza pelo menos 8 digitos na palavra passe"

            },
            confirmar_p_passe:{
                required:"Este campo é obrigatório",
                minlength:"Introduza pelo menos 8 digitos na palavra passe",
                equalTo:"Estas palavras passes não são iguais"
            }

           
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".cadastrarClientes").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/cadastrarClient",
                data:$(form).serialize(),
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                    $('.cadastrarClientes').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Cliente cadastrado com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });


    /*
    *Cadastrar agentes no sistema:validacao de formulario e ajax
    *
    */

    $("#cadastrarAgentes").validate({
        rules: {
            nome: {
            required: true,
            minlength:3,
            verificarletrasApenasEespaco: true
            },
            apelido: {
                required: true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            sexo: {
                required: true,
            },
            nacionalidade: {
                required: true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            data_nascimento: {
                required: true,
                date: true
            },
            data_inicio: {
                required: true,
                date: true
            },
            nuit:{
                required:true,
                minlength:9,
                maxlength:9,
                number:true
            },
            bi:{
                required:true,
                verificarNumerodeBi:true,
                minlength:13,
                maxlength:13

            },
            nr_casa:{
                required:true,
                number:true
            },
            bairro:{
                required:true,
                minlength:3,
            },
            quarteirao:{
                required:true,
                number:true
            },
            cidade:{
                required:true,
                minlength:3,
                verificarletrasApenasEespaco: true
            },
            telefone1:{
                required:true,
                number: true,
                verificarNumerodetelefone:true,
                maxlength:9,
                minlength:9
            },
            telefone2:{
                required:false,
                number: true,
                verificarNumerodetelefone:true,
                maxlength:9,
                minlength:9
            },
            email:{
                required:true,
                email:true
            },
            username:{
                required:true,
                minlength:3,
                verificarletrasApenasEespaco:true
            },
            palavra_passe:{
                required:true,
                minlength:8
            },
            confirmar_p_passe:{
                required:true,
                minlength:8,
                equalTo:"#palavra_passe"
            }

        },
        messages: {
            nome: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            apelido: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            sexo: {
                required: "Este campo é obrigatório!"
            },
            nacionalidade: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            data_nascimento: {
                required: "Este campo é obrigatório!",
                date: "Esta data é inválida"
            },
            data_inicio: {
                required: "Este campo é obrigatório!",
                date: "Esta data é inválida"
            },
            nuit: {
                required:"Este campo é obrigatório!",
                minlength:"O nuit possui no minimo 9 digitos",
                maxlength:"O nuit possui no máximo 9 digitos",
                number:"Nuit Inválido, o nuit possui apenas dígitos"
            },
            bi: {
                required: "Este campo é obrigatório!",
                minlength: "O numero de bi possui no mínimo 13 digitos",
                verificarNumerodeBi:"Número de BI Inválido",
                maxlength:"O numero de bi possui no máximo 13 digitos"
            },
            nr_casa: {
                required: "Este campo é obrigatório!",
                number: "O numero de casa possui apenas dígitos",
            },
            bairro: {
                required: "Este campo é obrigatório!",
                minlength: "Este campo deve conter pelo menos 3 letras!",
            },
            quarteirao: {
                required: "Este campo é obrigatório!",
                number: "Este campo aceita apenas dígitos",
            },
            cidade: {
                required: "Este campo é obrigatório!",
                minlength: "Introduza no minimo 3 dígitos",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
                
            },
            telefone1: {
                required:"Este campo é obrigatório!",
                number: "Este campo aceita apenas dígitos",
                verificarNumerodetelefone:"Número de telefone inválido",
                maxlength:"O telefone possui no minimo 9 digitos",
                minlength:"O telefone possui no máximo 9 digitos"
            },
            telefone2: {
                number: "Este campo aceita apenas dígitos",
                verificarNumerodetelefone:"Número de telefone inválido",
                maxlength:"O telefone possui no máximo 9 digitos",
                minlength:"O telefone possui no minimo  9 digitos"
            },
            email: {
                required:"Este campo é obrigatório!",
                email:"Email inválido"
            },
            username: {
                required: "Este campo é obrigatório!",
                minlength: "O nome do grupo da permissão deve conter pelo menos 3 letras!",
                verificarletrasApenasEespaco: "Este campo aceita apenas letras e nenhum espaco"
            },
            palavra_passe: {
                required:"Este campo é obrigatório",
                minlength:"Introduza pelo menos 8 digitos na palavra passe"

            },
            confirmar_p_passe:{
                required:"Este campo é obrigatório",
                minlength:"Introduza pelo menos 8 digitos na palavra passe",
                equalTo:"Estas palavras passes não são iguais"
            }

           
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".cadastrarAgentes").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/cadastrarAgent",
                data:$(form).serialize(),
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                    $('.cadastrarAgentes').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Agente cadastrado com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });



    /*
    *Cadastrar permissoes de sistema:validacao de formulario e ajax
    *
    */


    $("#form_cadastrar_permissoes").validate({
        rules: {
            nomeperm: {
            required: true,
            minlength:3,
            verificarletrasApenasEespaco: true,
            }
        },
        messages: {
            nomeperm: {
            required: "Este campo é obrigatório!",
            minlength: "O nome da permissão deve conter pelo menos 3 letras!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".cadastroPermissoes").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/addPermisions",
                data:$(form).serialize(),
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                    $('.cadastroPermissoes').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Permissao adicionada com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });


    
    /*
    *Cadastrar grupos de permissoes de sistema:validacao de formulario e ajax
    *
    */

    $("#form_cadastrar_grupos").validate({
        rules: {
            nomegroup: {
            required: true,
            minlength:3,
            verificarletrasApenasEespaco: true,
            },
            'params[]': {
                required: true
            }
        },
        messages: {
            nomeperm: {
            required: "Este campo é obrigatório!",
            minlength: "O nome do grupo da permissão deve conter pelo menos 3 letras!"
            },
            'params[]': {
                required: "Este campos são obrigatórios!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            
            $(".cadastroGroups").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/addPermissionsGroups",
                data:$(form).serialize(),
                success:function(){
                
                    form.reset();
            
                    setTimeout(function(){
                    $('.cadastroGroups').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Grupo de permissões adicionado com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });





    //Deletes



    /*
     * Ajax eliminacao de permissoes do sistema
     *
    */

    $('.removerPermissoes').click(function(){

            let elemento = this;
            let data_id=$(this).data('id');
            let confirmar= confirm("Tem certeza que deseja eliminar? está acção é irreversível");
            
            if(confirmar==true){
                $.ajax({
                    type:"POST",
                    data:{id:data_id},
                    url:BASE_URL+'/ajax/deletePermissions',
                    success:function(){
                        $(elemento).closest('tr').css('background','tomato');
                        $(elemento).closest('tr').fadeOut('fast',function(){
                            $(this).remove();
                        });

                        setTimeout(function(){
                            Swal.fire({
                                //position: 'top-end',
                                icon: 'success',
                                title: 'Permissao Removida com sucesso!',
                                showConfirmButton: true,
                                //timer: 1500
                            });
                        },500);

                    }
                });       
            }

    });

    
    /*
     * Ajax eliminacao de grupos de permissoes do sistema
     *
    */

    $('.removerGrupos').click(function(){
        let elemento = this;
        let data_id=$(this).data('id');
        let confirmar= confirm("Tem certeza que deseja eliminar? está acção é irreversível");
        
        if(confirmar==true){
            
            $.ajax({
                type:"POST",
                dataType: 'json',
                async: 'true',
                data:{id:data_id},
                url:BASE_URL+'/ajax/deletePermissionsGroups',
                success:function(jSon){

                for(var i in jSon.resp ){
                      

                    if (jSon.resp[i] == 'success' ) {
                
                        $(elemento).closest('tr').css('background','tomato');
                        $(elemento).closest('tr').fadeOut('fast',function(){
                            $(this).remove();
                        });

                        setTimeout(function(){
                            Swal.fire({
                                icon: 'success',
                                title: 'Grupo de permissões Removido com sucesso!',
                                showConfirmButton: true,                              
                            });
                        },500);

                    } else if (jSon.resp[i] == "error") {

                        Swal.fire({
                            icon: 'error',
                            title: 'Este grupo de permissões não pode ser removido, pois encontra-se associado a um ou mais utilizadores',
                            showConfirmButton: true,
                        });
        
                        
                    
                    }
                    

                    }


                        
                    }
                    
                });       
            }


        });

    
    

    //Updates



      /*
    *Cadastrar grupos de permissoes de sistema:validacao de formulario e ajax
    *
    */

    $("#form_editar_grupos").validate({
        rules: {
            nomegroup: {
            required: true,
            minlength:3,
            verificarletrasApenasEespaco: true,
            },
            'params[]': {
                required: true
            }
        },
        messages: {
            nomeperm: {
            required: "Este campo é obrigatório!",
            minlength: "O nome do grupo da permissão deve conter pelo menos 3 letras!"
            },
            'params[]': {
                required: "Este campos são obrigatórios!"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {

            const urlParams = new URLSearchParams(window.location.search);
            const idgroup = urlParams.get('idgroup');

            $(".editarGrupos").preloader({
                text: 'A processar', 
                zIndex: '1',
                setRelative: true 
            });  
            
            $.ajax({
                type:"POST",
                url:BASE_URL+"/ajax/editPermissionsGroups",
                data:$(form).serialize()+'&idgrupo='+idgroup,
                success:function(){
                
                    //form.reset();
            
                    setTimeout(function(){
                    $('.editarGrupos').preloader('remove');
                    },4000);
                
        
                    setTimeout(function(){

                        Swal.fire({
                            //position: 'top-end',
                            icon: 'success',
                            title: 'Grupo de permissões actualizado com sucesso!',
                            showConfirmButton: true,
                            //timer: 1500
                        });

                    },5000);
        
                }
            });
        
        
         return false;
        }
    });



























});

