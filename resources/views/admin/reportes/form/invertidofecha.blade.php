<div class="modal fade" id="formModal7" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Reporte de Invertido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reporteForm7">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha_inicio7" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio7" name="fecha_inicio7" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin7" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin7" name="fecha_fin7" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    <button type="button" class="btn btn-secondary" id="btnRangoPredeterminado7">Generar Reporte General</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // reporte1 entre fechas
    document.getElementById('reporteForm7').addEventListener('submit', function(event) {
        event.preventDefault();

        const fechaInicio = document.getElementById('fecha_inicio7').value;
        const fechaFin = document.getElementById('fecha_fin7').value;

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf7?fecha_inicio7=${fechaInicio}&fecha_fin7=${fechaFin}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
    //reporte1 general
    document.getElementById('btnRangoPredeterminado7').addEventListener('click', function() {
        const fechaInicio = '2023-01-01'; // Fecha de inicio predeterminada
        const fechaFin = new Date().toLocaleDateString('en-CA'); // Fecha de hoy

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf7?fecha_inicio7=${fechaInicio}&fecha_fin7=${fechaFin}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
</script>