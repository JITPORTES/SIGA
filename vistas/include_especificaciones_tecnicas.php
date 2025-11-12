<style>
.tabsinclude {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-wrap: wrap;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
}
.tabsinclude > label {
  -webkit-box-ordinal-group: 2;
  -webkit-order: 1;
  -ms-flex-order: 1;
  order: 1;
  display: block;
  padding: 1rem 2rem;
  margin-right: 0.2rem;
  cursor: pointer;
  background: #90CAF9;
  font-weight: bold;
  -webkit-transition: background ease 0.2s;
  transition: background ease 0.2s;
}
.tabsinclude .tabr {
  -webkit-box-ordinal-group: 100;
  -webkit-order: 99;
  -ms-flex-order: 99;
  order: 99;
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
  width: 100%;
  display: none;
  padding: 1rem;
  background: #f1f1f1;
}
.tabsinclude input[type="radio"] {
  position: absolute;
  opacity: 0;
}
/* Efecto sombreado para el tab seleccionado */
.tabsinclude input[type="radio"]:checked + label { 
  background: #c6f7ff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  border-bottom: 3px solid #007acc;
  transform: translateY(-2px);
  z-index: 10;
  position: relative;
}

/* Hover effect para mejor interacción */
.tabsinclude > label:hover {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  transform: translateY(-1px);
}

.tabsinclude input[type="radio"]:checked + label + .tabr { display: block; }
@media (max-width: 45em) {
  .tabsinclude .tabr,  .tabsinclude > label {
    -webkit-box-ordinal-group: NaN;
    -webkit-order: initial;
    -ms-flex-order: initial;
    order: initial;
  }
  .tabsinclude > label {
    width: 100%;
    margin-right: 0;
    margin-top: 0.2rem;
  }
}
/**
 * Generic Styling
*/
</style>
<input type="hidden" id="Id_Esp_Tec" value="">
<div class="tabsinclude">
  <input type="radio" name="tabs" id="tabcomercial" checked="checked">
  <label for="tabcomercial" style="background: #fdc05f;">Comercial</label>
  <div class="tabr">
    <div class="row">
        <!-- <div class="col-md-3 col-sm-12 form-group">
            <label for="cmbcondicion" class="control-label" style="font-size: 11px;">&nbsp;Condición</label>
            <select class="form-control" id="cmbcondicion">
                <option value="">--Condición--</option>
            </select>
        </div> -->
        <div class="col-md-3 col-sm-12 form-group">
            <label for="cmbproyeccion" class="control-label" style="font-size: 11px;">&nbsp;Proyección</label>
            <select class="form-control" id="cmbproyeccion">
                <option value="">--Proyección--</option>
            </select>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabfisicas">
  <label for="tabfisicas" style="background: #ff0000;">Físicas</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Dimensiones máximas en cm</label>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="Largo" class="control-label" style="font-size: 11px;">&nbsp;L</label>
            <input type="text" class="form-control" id="f_largo" placeholder="Largo" maxlength="15">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="Profundo" class="control-label" style="font-size: 11px;">&nbsp;P</label>
            <input type="text" class="form-control" id="f_profundo" placeholder="Profundo" maxlength="15">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="Alto" class="control-label" style="font-size: 11px;">&nbsp;H</label>
            <input type="text" class="form-control" id="f_alto" placeholder="Alto" maxlength="15">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="Peso" class="control-label" style="font-size: 11px;">&nbsp;Peso (Kg)</label>
            <input type="text" class="form-control" id="f_peso" placeholder="Peso en kg" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="F_Movilidad" class="control-label" style="font-size: 11px;">&nbsp;Movilidad</label>
            <select class="form-control" id="F_Movilidad">
                <option value="">--Movilidad--</option>
                <option value="P">Portatil</option>
                <option value="R">Rodable</option>
                <option value="F">Fijo</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="simbologia" class="control-label" style="font-size: 11px;">&nbsp;Simbología Equipo</label>
            <input type="text" class="form-control" id="Identif_Simbologia" placeholder="Simbología" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="f_observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabmobiladicional">
  <label for="tabmobiladicional" style="background: #c38337;">Mobiliario Adicional</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-6 col-sm-12 form-group">
            <label for="Requerimientos_Especiales" class="control-label" style="font-size: 11px;">&nbsp;Requerimientos Especiales</label>
            <input type="text" class="form-control" id="Mob_Req_Esp" placeholder="Requerimientos Especiales" maxlength="250">
        </div>
        <div class="col-md-6 col-sm-12 form-group">
            <label for="cmbproyeccion" class="control-label" style="font-size: 11px;">&nbsp;¿Lugar Para Resguardar Equipo?</label>
            <select class="form-control" id="Mob_Lugar_Resg_Eq">
                <option value="">--Si/No--</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
                <option value="N/A">N/A</option>
            </select>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="Mob_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabelectrico">
  <label for="tabelectrico" style="background: #ffc427;">Eléctrico</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Tipo de Alimentación</label>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="Elec_Tip_Bateria" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <select class="form-control" id="Elec_Tip_Bateria">
                <option value="">--Tipo--</option>
                <option value="BAT">Baterías/Pilas</option>
                <option value="CD">Corriente Directa</option>
                <option value="CA">Corriente Alterna</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Directa/Voltaje (V)</label>
            <input type="text" class="form-control" id="Elec_Tip_Direct_Volt" placeholder="Voltaje" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Directa/Amperaje (A)</label>
            <input type="text" class="form-control" id="Elec_Tip_Direct_Amp" placeholder="Amperaje" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="Elec_Tip_Alt_Sis_El" class="control-label" style="font-size: 11px;">&nbsp;Alterna/Sistema Eléctrico</label>
            <select class="form-control" id="Elec_Tip_Alt_Sis_El">
                <option value="">--Tipo--</option>
                <option value="Monofásico">Monofásico</option>
                <option value="Trifásico">Trifásico</option>
                <option value="Bifásico">Bifásico</option>
            </select>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Alterna/Voltaje Nominal (V)</label>
            <input type="text" class="form-control" id="Elec_Tip_Alt_Volt" placeholder="Voltaje" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Alterna/Amperaje (A)</label>
            <input type="text" class="form-control" id="Elec_Tip_Alt_Amp" placeholder="Amperaje" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Alterna/Consumo Unitario (V*A)</label>
            <input type="text" class="form-control" id="Elec_Tip_Alt_Consum" placeholder="Consumo" maxlength="20" disabled="true">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <br>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="Elec_Bat_Integrada" class="control-label" style="font-size: 11px;">&nbsp;¿Batería Integrada?</label>
            <select class="form-control" id="Elec_Bat_Integrada">
                <option value="">--Si/No--</option>
                <option value="Si">Si</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="Elec_Req_UPS" class="control-label" style="font-size: 11px;">&nbsp;¿Requiere UPS?</label>
            <select class="form-control" id="Elec_Req_UPS">
                <option value="">--UPS--</option>
                <option value="Obligatorio">Obligatorio</option>
                <option value="Recomendada">Recomendada</option>
                <option value="No Necesario">No Necesario</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="Elec_Req_Ener_Regul" class="control-label" style="font-size: 11px;">&nbsp;Requiere Energía Regulada</label>
            <select class="form-control" id="Elec_Req_Ener_Regul">
                <option value="">--Requiere Energía--</option>
                <option value="Obligatorio">Obligatorio</option>
                <option value="Recomendada">Recomendada</option>
                <option value="No Necesario">No Necesario</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="Elec_Planta_Emerg" class="control-label" style="font-size: 11px;">&nbsp;¿Planta de Emergencia?</label>
            <select class="form-control" id="Elec_Planta_Emerg">
                <option value="">--Planta de Emergencia--</option>
                <option value="Obligatorio">Obligatorio</option>
                <option value="Recomendada">Recomendada</option>
                <option value="No Necesario">No Necesario</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <br>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Contactos</label>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <input type="text" class="form-control" id="Elec_Cont_Tipo" placeholder="Tipo" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Color</label>
            <input type="text" class="form-control" id="Elec_Cont_Color" placeholder="Color" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Elec_Cont_Cant" placeholder="Cantidad" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Elec_Cont_Alt_SNPT" placeholder="Altura" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Elec_Cont_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Elec_Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="Elec_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <br>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Carga Eléctrica</label>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;QTY</label>
            <input type="text" class="form-control" id="Elec_Carg_Elec_QTY" placeholder="QTY" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Carga Eléctrica Total (VA)</label>
            <input type="text" class="form-control" id="Elec_Carg_Elec_Total" placeholder="Total" maxlength="20" disabled="true">
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabHVAC">
  <label for="tabHVAC" style="background: #ff9e94;">HVAC</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Temperatura Set Point (°C)</label>
            <input type="text" class="form-control" id="Hvac_Temp_Set_Point" placeholder="Temperatura" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Temperatura Rango Operación (°C)</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Hvac_Temp_Rang_Oper_Min" placeholder="Min" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Hvac_Temp_Rang_Oper_Max" placeholder="Max" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Temeperatura Gradiente Variación (°C)</label>
            <input type="text" class="form-control" id="Hvac_Temp_Gradiente" placeholder="Temperatura" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Humedad Rango Operación (%)</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Hvac_Humedad_Rango_Min" placeholder="Min" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="Hvac_Humedad_Rango_Max" placeholder="Max" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Discipación Térmica (BTU/Hora)</label>
            <input type="text" class="form-control" id="Hvac_Discip_Term" placeholder="Discipación Térmica" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Recambios por Hora</label>
            <input type="text" class="form-control" id="Hvac_Recam_X_Hora" placeholder="Recambios por hora" maxlength="20">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Renovaciones Aire</label>
            <input type="text" class="form-control" id="Hvac_Renovaciones_Aire" placeholder="Renovaciones Aire" maxlength="100">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Eficiencia Filtrado</label>
            <select class="form-control" id="Hvac_Efici_Filtrado">
                <option value="">--Eficiencia--</option>
                <option value="MERV1">MERV1</option>
                <option value="MERV2">MERV2</option>
                <option value="MERV3">MERV3</option>
                <option value="MERV4">MERV4</option>
                <option value="MERV5">MERV5</option>
                <option value="MERV6">MERV6</option>
                <option value="MERV7">MERV7</option>
                <option value="MERV8">MERV8</option>
                <option value="MERV9">MERV9</option>
                <option value="MERV10">MERV10</option>
                <option value="MERV11">MERV11</option>
                <option value="MERV12">MERV12</option>
                <option value="MERV13">MERV13</option>
                <option value="MERV14">MERV14</option>
                <option value="MERV15">MERV15</option>
                <option value="MERV16">MERV16</option>
                <option value="HEPA">HEPA</option>
                <option value="ULPA">ULPA</option>
            </select>
        </div>
    </div>    
  </div>
  <input type="radio" name="tabs" id="tabtelecomunicaciones">
  <label for="tabtelecomunicaciones" style="background: #50cb33;">Telecomunicaciones</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Nodos Red</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Tel_Nodred_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <input type="text" class="form-control" id="Tel_Nodred_Tipo" placeholder="Tipo" maxlength="200">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Tel_Nodred_Alt_Sntp" placeholder="Altura" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Tel_Nodred_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Nodos Com</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Tel_Nodcom_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <input type="text" class="form-control" id="Tel_Nodcom_Tipo" placeholder="Tipo" maxlength="200">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Tel_Nodcom_Alt_Sntp" placeholder="Altura" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Tel_Nodcom_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Nodos Video</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Tel_Nodvideo_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <input type="text" class="form-control" id="Tel_Nodvideo_Tipo" placeholder="Tipo" maxlength="200">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Tel_Nodvideo_Alt_Sntp" placeholder="Altura" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Tel_Nodvideo_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Equipo Computo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo</label>
            <input type="text" class="form-control" id="Tel_Ec_Tipo" placeholder="Tipo" maxlength="200">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Requerimientos Mínimos</label>
            <input type="text" class="form-control" id="Tel_Ec_Req_Min" placeholder="Requerimientos Mínimos" maxlength="15">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="Tel_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabhidrosanitario">
  <label for="tabhidrosanitario" style="background: #39a2d8;">Hidrosanitario</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Hidráulico Agua Caliente</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Material</label>
            <input type="text" class="form-control" id="Hid_Agcal_Material" placeholder="Material" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Diámetro (in)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Diametro" placeholder="Diámetro" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión (psi)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Presion" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Gasto (lpm)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Gasto" placeholder="Gasto" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Temperatura (°C)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Temp" placeholder="Temperatura" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Calidad (µS)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Calidad" placeholder="Calidad" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Hid_Agcal_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Hid_Agcal_Alt_SNPT" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Hid_Agcal_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Hidráulico Agua Fría</label>
        </div>
        <hr>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Material</label>
            <input type="text" class="form-control" id="Hid_Agfria_Material" placeholder="Material" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Diámetro (in)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Diametro" placeholder="Diámetro" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión (psi)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Presion" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Gasto (lpm)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Gasto" placeholder="Gasto" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Temperatura (°C)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Temp" placeholder="Temperatura" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Calidad (µS)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Calidad" placeholder="Calidad" maxlength="100">
        </div>
        <div class="col-md-2 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Hid_Agfria_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Hid_Agfria_Alt_SNPT" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Hid_Agfria_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="Hid_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 11px;">Sanitario (Drenaje)</label>
        </div>
        <hr>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Material</label>
            <input type="text" class="form-control" id="Hid_Sanit_Material" placeholder="Material" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Diámetro (in)</label>
            <input type="text" class="form-control" id="Hid_Sanit_Diametro" placeholder="Diámetro" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Caudal (lpm)</label>
            <input type="text" class="form-control" id="Hid_Sanit_Caudal" placeholder="Caudal" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="Hid_Sanit_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="Hid_Sanit_Alt_SNPT" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="Hid_Sanit_Ubicacion" placeholder="Ubicación" maxlength="500">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="Hid_Sanit_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabgasesmedicinales">
  <label for="tabgasesmedicinales" style="background: #7e20ff;">Gases Medicinales</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Oxígeno</label>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Especificaciones Equipo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Operación (Rango) [psi]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Ox_Presion_Rang_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Ox_Presion_Rang_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Operación (Rango) [lpm]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Ox_Fluj_Oper_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Ox_Fluj_Oper_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Toma Mural</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Toma Mural (psi)</label>
            <input type="text" class="form-control" id="GM_Ox_Pres_Tom_Mural" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Mínimo Toma Mural (lpm)</label>
            <input type="text" class="form-control" id="GM_Ox_Fluj_Min" placeholder="Flujo Mínimo" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo Conector</label>
            <input type="text" class="form-control" id="GM_Ox_Tipo_Conect" placeholder="Tipo Conector" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="GM_Ox_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="GM_Ox_Alt_SNTP" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="GM_Ox_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="GM_Ox_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Aire</label>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Especificaciones Equipo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Operación (Rango) [psi]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Air_Presion_Rang_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Air_Presion_Rang_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Operación (Rango) [lpm]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Air_Fluj_Oper_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Air_Fluj_Oper_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Toma Mural</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Toma Mural (psi)</label>
            <input type="text" class="form-control" id="GM_Air_Pres_Tom_Mural" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Mínimo Toma Mural (lpm)</label>
            <input type="text" class="form-control" id="GM_Air_Fluj_Min" placeholder="Flujo Mínimo" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo Conector</label>
            <input type="text" class="form-control" id="GM_Air_Tipo_Conect" placeholder="Tipo Conector" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="GM_Air_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="GM_Air_Alt_SNTP" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="GM_Air_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="GM_Air_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;N2</label>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Especificaciones Equipo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Operación (Rango) [psi]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_N2_Presion_Rang_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_N2_Presion_Rang_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Operación (Rango) [lpm]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_N2_Fluj_Oper_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_N2_Fluj_Oper_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Toma Mural</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Toma Mural (psi)</label>
            <input type="text" class="form-control" id="GM_N2_Pres_Tom_Mural" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Mínimo Toma Mural (lpm)</label>
            <input type="text" class="form-control" id="GM_N2_Fluj_Min" placeholder="Flujo Mínimo" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo Conector</label>
            <input type="text" class="form-control" id="GM_N2_Tipo_Conect" placeholder="Tipo Conector" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="GM_N2_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="GM_N2_Alt_SNTP" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="GM_N2_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="GM_N2_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;CO2</label>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Especificaciones Equipo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Operación (Rango) [psi]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Co2_Presion_Rang_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Co2_Presion_Rang_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Operación (Rango) [lpm]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Co2_Fluj_Oper_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Co2_Fluj_Oper_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Toma Mural</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Toma Mural (psi)</label>
            <input type="text" class="form-control" id="GM_Co2_Pres_Tom_Mural" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Mínimo Toma Mural (lpm)</label>
            <input type="text" class="form-control" id="GM_Co2_Fluj_Min" placeholder="Flujo Mínimo" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo Conector</label>
            <input type="text" class="form-control" id="GM_Co2_Tipo_Conect" placeholder="Tipo Conector" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="GM_Co2_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="GM_Co2_Alt_SNTP" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="GM_Co2_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="GM_Co2_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 14px;">&nbsp;Vacío</label>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Especificaciones Equipo</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Operación (Rango) [psi]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Vac_Presion_Rang_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Vac_Presion_Rang_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Operación (Rango) [lpm]</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Vac_Fluj_Oper_Max" placeholder="Max" maxlength="100">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="GM_Vac_Fluj_Oper_Min" placeholder="Min" maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 form-group">
            <label class="control-label" style="font-size: 12px;">&nbsp;Toma Mural</label>
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Presión Toma Mural (psi)</label>
            <input type="text" class="form-control" id="GM_Vac_Pres_Tom_Mural" placeholder="Presión" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Flujo Mínimo Toma Mural (lpm)</label>
            <input type="text" class="form-control" id="GM_Vac_Fluj_Min" placeholder="Flujo Mínimo" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Tipo Conector</label>
            <input type="text" class="form-control" id="GM_Vac_Tipo_Conect" placeholder="Tipo Conector" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad</label>
            <input type="text" class="form-control" id="GM_Vac_Cantidad" placeholder="Cantidad" maxlength="15">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Altura SNPT (cm)</label>
            <input type="text" class="form-control" id="GM_Vac_Alt_SNTP" placeholder="Altura SNPT" maxlength="100">
        </div>
        <div class="col-md-3 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Ubicación</label>
            <input type="text" class="form-control" id="GM_Vac_Ubicacion" placeholder="Ubicación" maxlength="100">
        </div>
        <div class="col-md-12 col-sm-12 form-group"></div>
        <div class="col-md-12 col-sm-12 form-group">
            <label for="Observaciones" class="control-label" style="font-size: 11px;">&nbsp;Observaciones</label>
            <textarea rows="4" class="form-control" id="GM_Vac_Observaciones" placeholder="Observaciones" maxlength="5000"></textarea>
        </div>
    </div>
  </div>
  <input type="radio" name="tabs" id="tabFinanciero">
  <label for="tabFinanciero" style="background: #2ba093;">Financiero</label>
  <div class="tabr">
    <div class="row">
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Proveedor Sugerido</label>
            <input type="text" class="form-control" id="Finan_Proveedor" placeholder="Proveedor" maxlength="500" disabled="true">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Inversión Estimada Unitaria</label>
            <input type="text" class="form-control" id="Finan_Inv_Esti_Unit" placeholder="Inversión" maxlength="50" disabled="true">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Cantidad a Adquirir</label>
            <input type="text" class="form-control" id="Finan_Cant_A_Adquirir" placeholder="Cantidad" maxlength="50">
        </div>
        <div class="col-md-4 col-sm-12 form-group">
            <label for="" class="control-label" style="font-size: 11px;">&nbsp;Total Inversión Estimada</label>
            <input type="text" class="form-control" id="Finan_Tot_Inv_Estim" placeholder="Total" maxlength="50" disabled="true">
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
function cargarComboCatalogo(tabla, idCampo, descCampo, comboId) {
    fetch('../fachadas/activos/siga_activos/Siga_activosFacade.Class.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            accion: 'getcatalogo',
            tabla: tabla,
            id_campo: idCampo,
            campo: descCampo
        })
    })
    .then(response => response.json())
    .then(data => {
        const combo = document.getElementById(comboId);
        if (data.totalCount > 0 && Array.isArray(data.data)) {
            data.data.forEach(item => {
                const option = document.createElement('option');
                option.value = item[idCampo];
                option.textContent = item[descCampo];
                combo.appendChild(option);
            });
        }
    })
    .catch(error => console.error('Error al cargar ' + comboId + ':', error));
}

//cargarComboCatalogo('Siga_cat_condicion', 'Id_Condicion', 'Descripcion', 'cmbcondicion');
cargarComboCatalogo('Siga_cat_proyeccion', 'Id_Proyeccion', 'Descripcion', 'cmbproyeccion');
var idareasesion = document.getElementById("idareasesion").value;
if (idareasesion == 1) {
    document.getElementById("especificaciones_tecnicas").style.display = "inline";
} else {
    document.getElementById("especificaciones_tecnicas").style.display = "none";
}

function validarNumeroConDecimal(event) {
  const input = event.target;
  let valor = input.value;

  // Solo permitir dígitos y un solo punto decimal
  valor = valor.replace(/[^0-9.]/g, "");   // quita letras y símbolos
  const partes = valor.split(".");
  
  if (partes.length > 2) {
    // Si hay más de un punto, conserva solo el primero
    valor = partes[0] + "." + partes.slice(1).join("");
  }
  
  // Limitar a máximo 2 decimales
  if (partes.length === 2 && partes[1].length > 2) {
    valor = partes[0] + "." + partes[1].substring(0, 2);
  }

  input.value = valor;
}

function validarSoloEnteros(event) {
  const input = event.target;
  let valor = input.value;

  // Solo permitir dígitos (0-9)
  valor = valor.replace(/[^0-9]/g, "");

  input.value = valor;
}
document.getElementById("f_largo").addEventListener("input", validarNumeroConDecimal);
document.getElementById("f_profundo").addEventListener("input", validarNumeroConDecimal);
document.getElementById("f_alto").addEventListener("input", validarNumeroConDecimal);
document.getElementById("f_peso").addEventListener("input", validarNumeroConDecimal);

document.getElementById("Elec_Tip_Direct_Volt").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Tip_Direct_Amp").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Tip_Alt_Volt").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Tip_Alt_Amp").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Tip_Alt_Consum").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Cont_Alt_SNPT").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Cont_Cant").addEventListener("input", validarSoloEnteros);
document.getElementById("Elec_Carg_Elec_QTY").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Elec_Carg_Elec_Total").addEventListener("input", validarNumeroConDecimal);

document.getElementById("Hvac_Temp_Set_Point").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Temp_Rang_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Temp_Rang_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Temp_Gradiente").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Humedad_Rango_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Humedad_Rango_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Discip_Term").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Recam_X_Hora").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hvac_Renovaciones_Aire").addEventListener("input", validarNumeroConDecimal);

document.getElementById("Tel_Nodred_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Tel_Nodred_Alt_Sntp").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Tel_Nodcom_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Tel_Nodcom_Alt_Sntp").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Tel_Nodvideo_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Tel_Nodvideo_Alt_Sntp").addEventListener("input", validarNumeroConDecimal);

//document.getElementById("Hid_Agcal_Diametro").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agcal_Presion").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agcal_Gasto").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agcal_Temp").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agcal_Calidad").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hid_Agcal_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Hid_Agcal_Alt_SNPT").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agfria_Diametro").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agfria_Presion").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agfria_Gasto").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agfria_Temp").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Agfria_Calidad").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hid_Agfria_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Hid_Agfria_Alt_SNPT").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Sanit_Diametro").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Hid_Sanit_Caudal").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Hid_Sanit_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("Hid_Sanit_Alt_SNPT").addEventListener("input", validarNumeroConDecimal);

document.getElementById("GM_Ox_Presion_Rang_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Presion_Rang_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Fluj_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Fluj_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Pres_Tom_Mural").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Fluj_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Ox_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_Ox_Alt_SNTP").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_Air_Presion_Rang_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Presion_Rang_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Fluj_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Fluj_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Pres_Tom_Mural").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Fluj_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Air_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_Air_Alt_SNTP").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Presion_Rang_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Presion_Rang_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Fluj_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Fluj_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Pres_Tom_Mural").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Fluj_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_N2_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_N2_Alt_SNTP").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Presion_Rang_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Presion_Rang_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Fluj_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Fluj_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Pres_Tom_Mural").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Fluj_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Co2_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_Co2_Alt_SNTP").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Presion_Rang_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Presion_Rang_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Fluj_Oper_Max").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Fluj_Oper_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Pres_Tom_Mural").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Fluj_Min").addEventListener("input", validarNumeroConDecimal);
document.getElementById("GM_Vac_Cantidad").addEventListener("input", validarSoloEnteros);
document.getElementById("GM_Vac_Alt_SNTP").addEventListener("input", validarNumeroConDecimal);

document.getElementById("Finan_Inv_Esti_Unit").addEventListener("input", validarNumeroConDecimal);
document.getElementById("Finan_Cant_A_Adquirir").addEventListener("input", validarNumeroConDecimal);
//document.getElementById("Finan_Tot_Inv_Estim").addEventListener("input", validarNumeroConDecimal);


</script>