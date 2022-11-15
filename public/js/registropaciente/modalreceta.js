$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $("#dni_b").on('keydown',function(event){
        if(event.keyCode  == 13){
             $('.buscarpaciente').click();
        }
    });


    $("#fecha").on('keydown',function(event){
        // alert(event.keyCode);
        if(event.keyCode  == 13){
             $('.buscarlistaatencion').click();
        }
    });

    $("#talla").on('change',function(e){
        debugger;
        var talla   = parseFloat($(this).val());
        var peso    = parseFloat($('#peso').val());
        var imc     = getIMC(talla,peso);
        $('#imc').val(imc);
    });


    $("#peso").on('change',function(e){
        debugger;
        var peso   = parseFloat($(this).val());
        var talla    = parseFloat($('#talla').val());
        var imc     = getIMC(talla,peso);
        $('#imc').val(imc);
    });


    function getIMC(talla,peso)
    {
        debugger;
        var imc=0.0;
        if(isNaN(talla)){
            talla=0;
        }
        if(isNaN(peso)){
            peso=0;
        }
        if(peso>0){
            imc = peso/(talla^2);
        }
        return imc.toFixed(3);
    }

    $('#modalagregarreceta').on('shown.bs.modal', function () {
        // debugger;
        limpiarFormularioModalAgregar();
        $('.nav-tabs a[href="#"]').tab('show')
    });
    


    $(".atenderpaciente").on('click','.agregarreceta', function() {
        // debugger;
        event.preventDefault();
        var control_id              = $('#control_id').val();
        var cantidad_diagnosticos   = $("#tabladiagnostico tr").length;
        if(cantidad_diagnosticos==1)
        {
            alerterrorajax("INGRESE UN DIAGNOSTICO");
            return false;
        }
        else{
            var _token          =   $('#token').val();
            var 
            data            =   {
                                    _token      : _token,
                                    control_id : control_id,
                                };
            ajax_normal_section(data,"/ajax-asignar-combo-diagnostico",'ajaxcombodiagnostico');
            ajax_normal_section(data,"/ajax-cargar-lista-medicamentos",'ajaxlsmedicamentos');
        }
        return true;
    });


    function limpiarFormularioModalAgregar(){

        $("#diagnostico_receta").val($("#diagnostico_receta option:first").val());
        $("#diagnostico_receta").change();

        $("#medicamento_id").val($("#medicamento_id option:first").val());
        $("#medicamento_id").change();

        $("#dosificacion").val($("#dosificacion option:first").val());        
        $("#dosificacion").change();
        
        $("#dias").val(0);
        $("#cantidad").val(0);
        $("#indicacion").val('');
    }

    function validarFormularioModalAgregar(diagnostico_id,medicamento_id,cantidad,dias,dosificacion,indicacion){
    
        if (diagnostico_id ==''){
            alerterrorajax('SELECCIONE DIAGNOSTICO');
            $('#diagnostico_receta').focus();
            return false;
        } 
    
        if(medicamento_id==''){
            alerterrorajax('SELECCIONE MEDICAMENTO');
            $('#medicamento_id').focus();
            return false;
        }
        
        if((cantidad=='') || (isNaN(cantidad)) ){
            alerterrorajax('INGRESE CANTIDAD');
            $('#cantidad').focus();
            return false;
        }

        if(parseInt(cantidad)<=0){
            alerterrorajax('INGRESE CANTIDAD MAYOR A CERO');
            $('#cantidad').focus();
            return false;
        }
        
        
        if((dias=='') || (isNaN(dias)) ){
            alerterrorajax('INGRESE DIAS');
            $('#dias').focus();
            return false;
        }

        if(parseInt(dias)<=0){
            alerterrorajax('INGRESE DIAS MAYOR A CERO');
            $('#dias').focus();
            return false;
        }

        
        if(dosificacion==''){
            alerterrorajax('SELECCIONE DOSIFICACION');
            $('#dosificacion').focus();
            return false;
        }

        return true;
    }


    $('#asignarmedicamento').on('click',function(event){
        var diagnostico_id  =   $('#diagnostico_receta').val();
        var medicamento_id  =   $('#medicamento_id').val();
        var cantidad        =   $('#cantidad').val();
        var dias            =   $('#dias').val();
        var dosificacion    =   $("#dosificacion").val();
        var indicacion      =   $("#indicacion").val();
 
        var _token          =   $('#token').val();
        var 
        data                =   {
                                    _token          : _token,
                                    diagnostico_id  : diagnostico_id,
                                    medicamento_id  : medicamento_id,
                                    cantidad        : cantidad,
                                    indicacion      : indicacion,
                                    dosificacion    : dosificacion,
                                    dias            : dias,
                                };
   
        if(validarFormularioModalAgregar(diagnostico_id,medicamento_id,cantidad,dias,dosificacion,indicacion))
        {
            ajax_normal_section(data,"/ajax-asignar-medicamento-receta",'ajaxlsmedicamentos');
            limpiarFormularioModalAgregar();
        }
        else{
            return false;
        }


    });


    $("#modalagregarreceta").on('click','.eliminarmed', function() {
        
        event.preventDefault();
        var detalle_control_id =   $(this).attr('data_detalle_id');
        var _token          =   $('#token').val();

        data            =   {
                                _token      : _token,
                                detalle_control_id   : detalle_control_id,
                            };
        ajax_normal_section(data,"/ajax-eliminar-medicamento-receta",'ajaxlsmedicamentos');

    });

    // $("#modalagregarreceta").on('click','.eliminarmed', function() {
        
    //     event.preventDefault();
    //     var detalle_control_id =   $(this).attr('data_detalle_id');
    //     var _token          =   $('#token').val();

    //     data            =   {
    //                             _token      : _token,
    //                             detalle_control_id   : detalle_control_id,
    //                         };
    //     ajax_normal_section(data,"/ajax-eliminar-medicamento-receta",'ajaxlsmedicamentos');

    // });


});
