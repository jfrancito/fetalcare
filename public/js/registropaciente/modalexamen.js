$(document).ready(function(){

    var carpeta = $("#carpeta").val();

    $("#dni_b").on('keydown',function(event){
        if(event.keyCode  == 13){
             $('.buscarpaciente').click();
        }
    });


     

    $('#modalagregarexamen').on('shown.bs.modal', function () {
        // debugger;
        limpiarFormularioModalAgregarDiagnosticoExamen();
        $('.nav-tabs a[href="#"]').tab('show')
    });
    


    $(".atenderpaciente").on('click','.agregarexamen', function() {

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
            ajax_normal_section(data,"/ajax-asignar-combo-diagnostico-examen",'ajaxcombodiagnosticoexamenes');
            ajax_normal_section(data,"/ajax-cargar-lista-examenes",'ajaxlsexamenes');

        }
        return true;
    });


    function limpiarFormularioModalAgregarDiagnosticoExamen(){

        $("#diagnostico_examen").val($("#diagnostico_examen option:first").val());
        $("#diagnostico_examen").change();

        $("#examen_id").val($("#examen_id option:first").val());
        $("#examen_id").change();
    }

    function validarFormularioModalAgregarDiagnosticoExamen(diagnostico_id,examen_id){
    
        if (diagnostico_id ==''){
            alerterrorajax('SELECCIONE DIAGNOSTICO');
            $('#diagnostico_examen').focus();
            return false;
        } 
    
        if(examen_id==''){
            alerterrorajax('SELECCIONE MEDICAMENTO');
            $('#examen_id').focus();
            return false;
        }
        

        return true;
    }

    // -----------------------------------------------------------------------------------
    // --  DIAGNOSTICO EXAMENES
    // -----------------------------------------------------------------------------------
    $('#asignarexamen').on('click',function(event){

        var diagnostico_id  =   $('#diagnostico_examen').val();
        var examen_id       =   $('#examen_id').val();
        var _token          =   $('#token').val();
        var 
        data                =   {
                                    _token          : _token,
                                    diagnostico_id  : diagnostico_id,
                                    examen_id  : examen_id,
                                };

        if(validarFormularioModalAgregarDiagnosticoExamen(diagnostico_id,examen_id))
        {
            ajax_normal_section(data,"/ajax-asignar-diagnostico-examen",'ajaxlsexamenes');
            limpiarFormularioModalAgregarDiagnosticoExamen();
        }
        else{
            return false;
        }


    });


    $("#modalagregarexamen").on('click','.eliminardiagexam', function() {
        
        event.preventDefault();
        var detalle_control_id =   $(this).attr('data_detalle_id');
        var _token          =   $('#token').val();

        data            =   {
                                _token      : _token,
                                detalle_control_id   : detalle_control_id,
                            };
        ajax_normal_section(data,"/ajax-eliminar-diagnostico-examen",'ajaxlsexamenes');

    });


});
