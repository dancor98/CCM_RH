<input type="hidden" class="form-control formulario__input" name="colaborador_id" id="colaborador_id"
    value="<?php echo $_GET['id']; ?>" readonly>
<input type="hidden" class="form-control formulario__input" name="empresa_id" id="empresa_id"
    value="<?php echo $empresa_id; ?>" readonly>

<div class="row">
    <div class="col">
        <label for="fecha" class="formulario__label">Fecha Creacion:</label>
        <input type="text" class="form-control formulario__input" name="fecha" id="fecha"
            value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>
    <div class="col">
        <label for="empresa" class="formulario__label">Empresa:</label>
        <input type="text" class="form-control formulario__input" name="empresa" id="empresa"
            value="<?php echo $empresa_nombre; ?>" readonly>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="formulario__campo">
            <label for="periodo" class="formulario__label">Periodo:</label>
            <select class="formulario__select" id="periodo" name="periodo">
                <option value="Enero">Enero</option>
                <option value="Febrero">Febrero</option>
                <option value="Marzo">Marzo</option>
                <option value="Abril">Abril</option>
                <option value="Mayo">Mayo</option>
                <option value="Junio">Junio</option>
                <option value="Julio">Julio</option>
                <option value="Agosto">Agosto</option>
                <option value="Septiembre">Septiembre</option>
                <option value="Octubre">Octubre</option>
                <option value="Noviembre">Noviembre</option>
                <option value="Diciembre">Diciembre</option>
            </select>
        </div>
    </div>
</div>

<!-- info colaborador -->
<fieldset class="formulario__fieldset-boleta">
    <legend class="formulario__legend">Informacion Colaborador</legend>

    <div class="row row-campo">
        <div class="col">
            <label for="nombre" class="formulario__label">Nombre:</label>
            <input type="text" class="form-control formulario__input" value="<?php echo $nombre_colaborador; ?>"
                readonly>
        </div>
        <div class="col">
            <label for="apellido_paterno" class="formulario__label">Apellido:</label>
            <input type="text" class="form-control formulario__input" value="<?php echo $apellido_paterno; ?>" readonly>
        </div>
        <div class="col">
            <label for="apellido_materno" class="formulario__label">Apellido:</label>
            <input type="text" class="form-control formulario__input" value="<?php echo $apellido_materno; ?>" readonly>
        </div>
    </div>

    <div class="row row-campo">
        <div class="col">
            <label for="cedula" class="formulario__label">Cedula:</label>
            <input type="text" class="form-control formulario__input" value="<?php echo $cedula; ?>" readonly>
        </div>
        <div class="col">
            <label for="correo_electronico" class="formulario__label">Correo:</label>
            <input type="text" class="form-control formulario__input" value="<?php echo $correo_electronico; ?>"
                readonly>
        </div>
    </div>
</fieldset>

<!-- salario -->
<fieldset class="formulario__fieldset-boleta">
    <legend class="formulario__legend">Ingresos</legend>

    <div class="row row-campo">
        <div class="col">
            <label for="salario" class="formulario__label">Salario Base:</label>
            <input type="text" class="form-control formulario__input"
                value="<?php echo number_format($salario ?? 0, 2, '.', ','); ?>" id="salario" readonly>
        </div>
        <div class="col">
            <label for="quincena" class="formulario__label">Quincenal:</label>
            <input type="text" class="form-control formulario__input" name="salario_quincenal" id="salario_quincenal"
                value="<?php echo number_format($salario / 2.0, 2, '.', ','); ?>" readonly>
        </div>
    </div>
    <div class="row row-campo">

        <div class="col">
            <label for="comisiones" class="formulario__label">Comisiones:</label>
            <input type="text" class="form-control formulario__input" name="comisiones" id="comisiones"
                value="<?php echo number_format($boletapago->comisiones ?? 0, 2, '.', ','); ?>"
                onchange="calcularTotalDevengado()">
        </div>
        <div class="col">
            <label for="feriados" class="formulario__label">Feriados:</label>
            <input type="text" class="form-control formulario__input" name="feriados" id="feriados"
                value="<?php echo number_format($boletapago->feriados ?? 0, 2, '.', ','); ?>"
                onchange="calcularTotalDevengado()">
        </div>
    </div>
    <div class="row row-campo">
        <div class="col">
            <label for="total_devengado" class="formulario__label">Total Devengado:</label>
            <input type="text" class="form-control formulario__input" name="total_devengado" id="total_devengado"
                value="<?php echo number_format($boletapago->total_devengado, 2, '.', ','); ?>" readonly>
        </div>
    </div>
</fieldset>

<!-- deducciones -->
<fieldset class="formulario__fieldset-boleta">
    <legend class="formulario__legend">Deducciones</legend>

    <div class="row row-campo">
        <div class="col">
            <label for="ccss" class="formulario__label">CCSS 10.67%:</label>
            <input type="text" class="form-control formulario__input" name="ccss" id="ccss" value="0.00" readonly>
        </div>
    </div>
    <div class="row row-campo">
        <div class="col">
            <label for="impuestos_renta" class="formulario__label">Impuesto Renta:</label>
            <input type="text" class="form-control formulario__input" name="impuestos_renta" id="impuestos_renta"
                value="0.00" onchange="calcularTotalDeducciones()">
        </div>
        <div class="col">
            <label for="incapacidades" class="formulario__label">Incapacidades:</label>
            <input type="text" class="form-control formulario__input" name="incapacidades" id="incapacidades"
                value="<?php echo number_format($boletapago->incapacidades ?? 0, 2, '.', ','); ?>"
                onchange="calcularTotalDeducciones()">
        </div>
    </div>

    <div class="row row-campo">
        <div class="col">
            <label for="otras_deducciones" class="formulario__label">Otras:</label>
            <input type="text" class="form-control formulario__input" name="otras_deducciones" id="otras_deducciones"
                value="<?php echo number_format($boletapago->otras_deducciones ?? 0, 2, '.', ','); ?>"
                onchange="calcularTotalDeducciones()">
        </div>
        <div class="col">
            <label for="embargo" class="formulario__label">Embargo:</label>
            <input type="text" class="form-control formulario__input" name="embargo" id="embargo"
                value="<?php echo number_format($boletapago->embargo ?? 0, 2, '.', ','); ?>"
                onchange="calcularTotalDeducciones()">
        </div>
    </div>
    <div class="row row-campo">
        <div class="col">
            <label for="total_deducciones" class="formulario__label">Total Deducciones:</label>
            <input type="text" class="form-control formulario__input" name="total_deducciones" id="total_deducciones"
                value="0.00" readonly>
        </div>
    </div>
</fieldset>

<!-- Total -->
<fieldset class="formulario__fieldset-boleta">
    <legend class="formulario__legend">Total Quincenal</legend>

    <div class="row row-campo">
        <div class="col">
            <label for="primer_quincena" class="formulario__label">Primera Quincena:</label>
            <input type="text" class="form-control formulario__input" name="primer_quincena" id="primer_quincena"
                value="0.00" readonly>
        </div>
        <div class="col">
            <label for="segunda_quincena" class="formulario__label">Segunda Quincena:</label>
            <input type="text" class="form-control formulario__input" name="segunda_quincena" id="segunda_quincena"
                value="0.00" readonly>
        </div>
    </div>
</fieldset>

<script>
function formatMiles(valor) {
    return valor.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function parseMiles(valor) {
    return parseFloat(valor.replace(/,/g, '')) || 0;
}

function calcularTotalDevengado() {
    var salario = parseMiles(document.getElementById('salario').value) || 0;
    var comisiones = parseMiles(document.getElementById('comisiones').value) || 0;
    // var incapacidades = parseMiles(document.getElementById('incapacidades').value) || 0;
    var feriados = parseMiles(document.getElementById('feriados').value) || 0;

    var total = salario + comisiones + feriados;

    document.getElementById('total_devengado').value = formatMiles(total.toFixed(2));

    calcularTotalDeducciones();
    calcularSalarioTotal();
}

function calcularTotalDeducciones() {
    var total_devengado = parseMiles(document.getElementById('total_devengado').value);

    var ccss = total_devengado * 0.1067; // CCSS 10.67%
    var impuesto_renta = parseMiles(document.getElementById('impuestos_renta').value) || 0;
    var otrasDeducciones = parseMiles(document.getElementById('otras_deducciones').value) || 0;
    var incapacidades = parseMiles(document.getElementById('incapacidades').value) || 0;
    var embargo = parseMiles(document.getElementById('embargo').value) || 0;

    var totalDeducciones = ccss + impuesto_renta + otrasDeducciones + embargo + incapacidades;

    document.getElementById('ccss').value = formatMiles(ccss.toFixed(2));
    document.getElementById('total_deducciones').value = formatMiles(totalDeducciones.toFixed(2));

    calcularSalarioTotal();
}

function calcularSalarioTotal() {
    var total_deduccion = parseMiles(document.getElementById('total_deducciones').value) || 0;
    var total_ingreso = parseMiles(document.getElementById('total_devengado').value) || 0;

    var TotalQuincenal = (total_ingreso - total_deduccion) / 2;

    document.getElementById('primer_quincena').value = formatMiles(TotalQuincenal.toFixed(2));
    document.getElementById('segunda_quincena').value = formatMiles(TotalQuincenal.toFixed(2));
}

function applyFormatting(event) {
    event.target.value = formatMiles(event.target.value.replace(/,/g, ''));
    calcularTotalDevengado();
}

// Eventos onchange y oninput para actualizar los cálculos dinámicamente
document.getElementById('salario_quincenal').onchange = function() {
    calcularTotalDevengado();
};

document.getElementById('comisiones').onchange = function() {
    calcularTotalDevengado();
};

document.getElementById('incapacidades').onchange = function() {
    calcularTotalDeducciones();
};

document.getElementById('feriados').onchange = function() {
    calcularTotalDevengado();
};

document.getElementById('impuestos_renta').onchange = function() {
    calcularTotalDeducciones();
};

document.getElementById('otras_deducciones').onchange = function() {
    calcularTotalDeducciones();
};

document.getElementById('embargo').onchange = function() {
    calcularTotalDeducciones();
};

// Eventos oninput para formatear los campos manualmente
document.getElementById('comisiones').oninput = applyFormatting;
document.getElementById('incapacidades').oninput = applyFormatting;
document.getElementById('feriados').oninput = applyFormatting;
document.getElementById('impuestos_renta').oninput = applyFormatting;
document.getElementById('otras_deducciones').oninput = applyFormatting;
document.getElementById('embargo').oninput = applyFormatting;

// Calcular totales iniciales al cargar la página
window.onload = function() {
    calcularTotalDevengado();
    calcularTotalDeducciones();
    calcularSalarioTotal();
};
</script>