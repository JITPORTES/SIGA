<style>
.table-scroll-container {
    overflow-x: auto;
    overflow-y: auto;
    max-height: 75vh;
    border: 1px solid #ddd;
    position: relative;
}

.table-scroll-container table {
    margin: 0;
    border-collapse: collapse;
    min-width: 6000px; /* Aumentado para más espacio */
    width: auto;
}

.table-scroll-container thead {
    position: sticky;
    top: 0;
    z-index: 20;
    background: #fff;
}

.table-scroll-container th {
    position: sticky;
    top: 0;
    background: inherit;
    z-index: 10;
    white-space: nowrap;
    min-width: 150px; /* Aumentado de 100px a 150px */
    padding: 12px; /* Aumentado el padding */
}

.table-scroll-container td {
    min-width: 150px; /* Asegurar que las celdas también sean más anchas */
    padding: 12px;
    border: 1px solid #ddd;
    white-space: nowrap;
}

/* Scrollbar personalizado */
.table-scroll-container::-webkit-scrollbar {
    height: 12px;
    width: 12px;
}

.table-scroll-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.table-scroll-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 6px;
}

.table-scroll-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Responsive */
@media (max-width: 768px) {
    .modal-dialog {
        width: 95% !important;
        margin: 10px auto !important;
    }
    
    .table-scroll-container {
        max-height: 60vh;
    }
}

#modalexpeciftec thead th {
    color: #000 !important;
}
</style>
<div class="modal fade modalchs" id="modalexpeciftec" data-backdrop="false">
	<div class="modal-dialog modal-xl" style="width: 95%; max-width: 1400px;">
		<div class="modal-content">
			<!-- ==== Titulo de la Ventana Modal ==== -->
			<div class="modal-header azul">
				<button type="button" class="close" aria-label="Close" onclick="$(this).parents('.modal').modal('hide');"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-object-group" aria-hidden="true"></i> Especificaciones Técnicas</h4>
			</div>

			<!-- ==== Cuerpo de la Ventana Modal ==== -->
			<div class="modal-body nopsides" style="padding: 0; max-height: 80vh; overflow: hidden;">
                <div class="table-responsive" style="overflow-x: auto; overflow-y: auto; max-height: 75vh; padding: 15px;">
                    <table style="text-align: center; border-collapse: collapse; margin: 0; min-width: 4000px; width: auto;">
                        <thead style="position: sticky; top: 0; z-index: 10;">
							<tr>
								<th colspan="5" style="text-align: center; background-color: #9DC3E6;">Datos del Equipo</th>
								<th colspan="4" style="text-align: center; background-color: #CCFF99;">Identificaci&oacute;n</th>
								<th colspan="3" style="text-align: center; background-color: #fdc05f;">Comercial</th>
								<th colspan="6" style="text-align: center; background-color: #ff0000;">F&iacute;sicas</th>
								<th colspan="3" style="text-align: center; background-color: #c38337;">Mobiliario Adicional</th>
								<th colspan="19" style="text-align: center; background-color: #ffc427;">El&eacute;ctrico</th>
								<th colspan="10" style="text-align: center; background-color: #ff9e94;">HVAC</th>
								<th colspan="15" style="text-align: center; background-color: #50cb33;">Telecomunicaciones</th>
								<th colspan="26" style="text-align: center; background-color: #39a2d8;">Hidrosanitaria</th>
								<th colspan="55" style="text-align: center; background-color: #7e20ff;">Gases Medicinales</th>
								<th colspan="4" style="text-align: center; background-color: #2ba093;">Financiero</th>
							</tr>
							<tr>
								<!--Datos del Equipo-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #9DC3E6;">No.&nbsp;Activo&nbsp;Asignado</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #9DC3E6;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Marca&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #9DC3E6;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modelo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #9DC3E6;">No.&nbsp;Serie</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #9DC3E6;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descripción&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<!--Identificación-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #CCFF99;">Ubicaci&oacute;n&nbsp;Primaria</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #CCFF99;">Ubicaci&oacute;n&nbsp;Secundaria</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #CCFF99;">Ubicaci&oacute;n&nbsp;Espec&iacute;fica</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #CCFF99;">Simbolog&iacute;a</th>
								<!--Comercial-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #fdc05f;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Propiedad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #fdc05f;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Condición&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #fdc05f;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Proyección&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<!----Físicas-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">Dimensiones&nbsp;m&aacute;ximas&nbsp;[cm] L</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">Dimensiones&nbsp;m&aacute;ximas&nbsp;[cm] P</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">Dimensiones&nbsp;m&aacute;ximas&nbsp;[cm] H</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">Peso&nbsp;[kg]</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Movilidad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff0000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Observaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<!----Mobiliario Adicional-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #c38337;">Requerimientos&nbsp;especiales</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #c38337;">¿Lugar&nbsp;para&nbsp;resguardar&nbsp;equipo?</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #c38337;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Observaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<!--Eléctrico-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Directa / Voltaje (V)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Directa / Amperaje (A)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Alterna / Sistema Eléctrico</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Alterna / Voltaje Nominal (V)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Alterna / Amperaje (A)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Tipo&nbsp;de&nbsp;Alimentación / Alterna / Consumo Unitario (V*A)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">¿Batería&nbsp;Integrada?</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">¿Requiere&nbsp;UPS?</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Requiere&nbsp;Energía&nbsp;Regulada</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">¿Planta&nbsp;de&nbsp;Emergencia?</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Contacto&nbsp;/&nbsp;Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Contacto&nbsp;/&nbsp;Color</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Contacto&nbsp;/&nbsp;Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Contacto&nbsp;/&nbsp;Altura SNPT (CM)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Contacto&nbsp;/&nbsp;Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Observaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QTY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ffc427;">Carga&nbsp;Eléctrica&nbsp;total&nbsp;(VA)</th>
								<!--HVAC-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Temperatura&nbsp;Set&nbsp;Point&nbsp;(°C)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Temperatura&nbsp;Rango Operación&nbsp;(°C) Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Temperatura&nbsp;Rango Operación&nbsp;(°C) Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Temeperatura&nbsp;Gradiente Variación&nbsp;(°C)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Humedad&nbsp;Rango Operación&nbsp;(%) Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Humedad&nbsp;Rango Operación&nbsp;(%) Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Discipación&nbsp;Térmica&nbsp;(BTU/Hora)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Recambios&nbsp;por&nbsp;Hora</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Renovaciones&nbsp;Aire</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #ff9e94;">Eficiencia&nbsp;Filtrado</th>
								<!--Telecomunicaciones-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Red / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Red / Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Red / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Red / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Com / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Com / Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Com / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Com / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Video / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Video / Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Video / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Nodos&nbsp;Video / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Equipo&nbsp;Computo / Tipo</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">Equipo&nbsp;Computo / Requerimientos Mínimos</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #50cb33;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Observaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<!--Hidrosanitaria-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Material</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Diámetro (in)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Presión (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Gasto (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Temperatura (°C)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Calidad (µS)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Caliente / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Material</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Diámetro (in)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Presión (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Gasto (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Temperatura (°C)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Calidad (µS)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Hidráulico&nbsp;Agua Fría / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Observaciones&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Material</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Diámetro (in)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Caudal (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #39a2d8;">Sanitario&nbsp;(Drenaje) / Observaciones</th>
								<!--Gases Medicinales-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Presión Toma Mural (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Flujo Mínimo Toma Mural (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Tipo Conector</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Toma Mural / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Oxígeno&nbsp;/&nbsp;Observaciones</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Presión Toma Mural (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Flujo Mínimo Toma Mural (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Tipo Conector</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Toma Mural / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Aire&nbsp;/&nbsp;Observaciones</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Presión Toma Mural (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Flujo Mínimo Toma Mural (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Tipo Conector</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Toma Mural / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">N2&nbsp;/&nbsp;Observaciones</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Presión Toma Mural (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Flujo Mínimo Toma Mural (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Tipo Conector</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Toma Mural / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">CO2&nbsp;/&nbsp;Observaciones</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Especificaciones Equipo /  Presión Operación (Rango) [psi] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Max</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Especificaciones Equipo /  Flujo Operación (Rango) [lpm] Min</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Presión Toma Mural (psi)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Flujo Mínimo Toma Mural (lpm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Tipo Conector</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Cantidad</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Altura SNPT (cm)</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Toma Mural / Ubicación</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #7e20ff;">Vacío&nbsp;/&nbsp;Observaciones</th>
								<!--Financiero-->
								<th style="text-align: center; border: 1px solid #ddd; background-color: #2ba093;">Proveedor&nbsp;Sugerido</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #2ba093;">Inversión&nbsp;Estimada Unitaria</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #2ba093;">Cantidad&nbsp;a&nbsp;Adquirir</th>
								<th style="text-align: center; border: 1px solid #ddd; background-color: #2ba093;">Total&nbsp;Inversión&nbsp;Estimada</th>										
							</tr>
						</thead>
						<tbody id="tbody_especificaciones_tecnicas_view" style="border: 1px solid #ddd;">
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>