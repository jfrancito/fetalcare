$(document).ready(function(){

    var carpeta = $("#carpeta").val();


    $(".registropaciente").on('click','.eliminarmodalcontrol', function() {

        var control_id              =   $(this).attr('data_control_id');
        var nombre_id               =   $(this).attr('data_nombre_id');
        var _token                  =   $('#token').val();        

        if (confirm("!Desea eliminar el control del paciente  "+nombre_id) == true) {

            data            =   {
                                    _token      : _token,
                                    control_id  : control_id,
                                };

            mensaje         =   "Control del aciente "+nombre_id+" eliminado exitoso";

            click           =   'buscarlistaatencion';
            ajax_normal_form_alert(data,"/ajax-eliminar-control",mensaje,click);
           
        }


    });

    $(".registropaciente").on('click','.modificar_datos', function() {

        event.preventDefault();
        var dni                     =   $('#dni').val();
        var nombres                 =   $('#nombres').val();
        var apellido_paterno        =   $('#apellido_paterno').val();
        var apellido_materno        =   $('#apellido_materno').val();
        var direccion               =   $('#direccion').val();
        var telefono                =   $('#telefono').val();
        var direccion               =   $('#direccion').val();
        var sexo                    =   $('#sexo').val();
        var fecha_nacimiento        =   $('#fecha_nacimiento').val();
        var ind_paciente            =   $('#ind_paciente').val();
        var _token                  =   $('#token').val();
        //validacioones
        if(ind_paciente =='0'){ alerterrorajax("Buscar paciente."); return false;}
        if(dni ==''){ alerterrorajax("Ingrese un dni."); return false;}
        if(nombres ==''){ alerterrorajax("Ingrese un nombres."); return false;}
        if(apellido_paterno ==''){ alerterrorajax("Ingrese un apelido paterno."); return false;}
        if(apellido_materno ==''){ alerterrorajax("Ingrese un apellido materno."); return false;}
        if(telefono ==''){ alerterrorajax("Ingrese un telefono."); return false;}
        if(sexo ==''){ alerterrorajax("Selecciona un sexo."); return false;}
        if(fecha_nacimiento ==''){ alerterrorajax("Ingrese una fecha nacimiento."); return false;}

        data            =   {
                                _token      : _token,
                                dni         : dni,
                                nombres     : nombres,
                                apellido_paterno : apellido_paterno,
                                apellido_materno : apellido_materno,
                                direccion        : direccion,
                                telefono         : telefono,
                                sexo             : sexo,
                                direccion        : direccion,
                                fecha_nacimiento : fecha_nacimiento,
                            };


        mensaje         =   "Paciente "+nombres +" "+ apellido_paterno +" "+ apellido_materno+" modificado exitoso";
        click           =   'buscarlistaatencion';
        ajax_normal_form_alert(data,"/ajax-eliminar-control",mensaje,click);

    });


    $(".registropaciente").on('click','.buscarpaciente', function() {

        event.preventDefault();
        var dni        =   $('#dni_b').val();
        var idopcion    =   $('#idopcion').val();
        var _token      =   $('#token').val();

        //validacioones
        if(dni ==''){ alerterrorajax("Ingrese un dni."); return false;}

        data            =   {
                                _token      : _token,
                                dni         : dni,
                                idopcion    : idopcion,
                            };
        ajax_normal_form(data,"/ajax-buscar-paciente");

    });


    $(".buscarpacientetop").on('click','.buscarpaciente', function() {

        event.preventDefault();
        var dni        =   $('#dni_b').val();
        var idopcion    =   $('#idopcion').val();
        var _token      =   $('#token').val();

        //validacioones
        if(dni ==''){ alerterrorajax("Ingrese un dni."); return false;}

        data            =   {
                                _token      : _token,
                                dni         : dni,
                                idopcion    : idopcion,
                            };
        ajax_normal(data,"/ajax-buscar-paciente-xdni");

    });


    $(".registropaciente").on('click','.buscarlistaatencion', function() {

        event.preventDefault();
        var fecha        =   $('#fecha').val();
        var idopcion   =   $('#idopcion').val();
        var _token     =   $('#token').val();

        //validacioones
        if(fecha ==''){ alerterrorajax("Ingrese un fecha."); return false;}

        data            =   {
                                _token      : _token,
                                fecha        : fecha,
                                idopcion    : idopcion,
                            };
        ajax_normal(data,"/ajax-buscar-controles-recepcionista-xdia");

    });


    $(".atenderpaciente").on('click','.buscarlistaatender', function() {

        event.preventDefault();
        var fecha      =   $('#fecha').val();
        var idopcion   =   $('#idopcion').val();
        var _token     =   $('#token').val();

        //validacioones
        if(fecha ==''){ alerterrorajax("Ingrese un fecha."); return false;}

        data            =   {
                                _token      : _token,
                                fecha        : fecha,
                                idopcion    : idopcion,
                            };
        ajax_normal(data,"/ajax-buscar-controles-doctor-xdia");

    });


    $(".atenderpaciente").on('dblclick','.dobleclickpc', function(e) {

        var _token                  =   $('#token').val();
        var control_id              =   $(this).attr('data_control_id');
        var idopcion                =   $('#idopcion').val();
        $(this).addClass("pintar_sel");
        $('.dobleclickpc').removeClass("pintar_sel");
        $(this).addClass("pintar_sel");

        data                        =   {
                                            _token                  : _token,
                                            control_id              : control_id,
                                            idopcion                : idopcion
                                        };
        ajax_normal_form(data,"/ajax-buscar-control-historial");

    });


    function validarDiagnostico(diagnostico)
    {
        debugger;
        var swguardar =false;
        var countcarrito=0;
        $("#tabladiagnostico tr").each(function(){
            var codigocie = $(this).find('.codigocie_ls').html();
            if(codigocie==diagnostico){
                 swguardar=true;
            }
            countcarrito = countcarrito + 1;
        });
        return swguardar;
    }

    $(".atenderpaciente").on('click','.asignarcie', function() {
        debugger;
        event.preventDefault();
        var cie_id          =   $('#cie_id').val();
        var control_id      =   $('#control_id').val();
        var combo_cie_text  =   $('#cie_id').find('option:selected').text();
        var array_cie       =   combo_cie_text.split(" - ");
        var diagnostico     =   array_cie[0];
        var _token          =   $('#token').val();
        
        if(cie_id ==''){ alerterrorajax("Seleccione un Diagnostico."); return false;}
        if(validarDiagnostico(diagnostico)){alerterrorajax("Diagnostico "+ diagnostico + " ya Registrado."); return false;}
        data            =   {
                                _token      : _token,
                                cie_id      : cie_id,
                                control_id  : control_id,
                            };
        ajax_normal_section(data,"/ajax-asignar-cie-control",'listajax_detalle');

        $("#cie_id").val($("#cie_id option:first").val());
        $("#cie_id").change();

    });


    $(".atenderpaciente").on('click','.eliminarcie', function() {

        event.preventDefault();
        var detalle_control_id =   $(this).attr('data_detalle_id');
        var control_id      =   $('#control_id').val();
        var _token          =   $('#token').val();

        data            =   {
                                _token      : _token,
                                detalle_control_id   : detalle_control_id,
                                control_id   : control_id,
                            };
        ajax_normal_section(data,"/ajax-eliminar-cie-control",'listajax_detalle');

    });


    $(".atenderpaciente").on('click','.eliminardoc', function() {

        event.preventDefault();
        var detalle_control_id =   $(this).attr('data_detalle_id');
        var control_id      =   $('#control_id').val();
        var _token          =   $('#token').val();

        data            =   {
                                _token      : _token,
                                detalle_control_id   : detalle_control_id,
                                control_id   : control_id,
                            };
        ajax_normal_section(data,"/ajax-eliminar-doc-control",'listajax_detalle_doc');

    });






});
