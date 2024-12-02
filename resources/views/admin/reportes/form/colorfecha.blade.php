<div class="modal fade" id="formModal4" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Reporte de Ventas por Colores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="reporteForm4">
                    @csrf
                    <div class="mb-3">
                        <label for="fecha_inicio4" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio4" name="fecha_inicio4" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin4" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin4" name="fecha_fin4" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generar Reporte</button>
                    <button type="button" class="btn btn-secondary" id="btnRangoPredeterminado4">Generar Reporte General</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // reporte1 entre fechas
    document.getElementById('reporteForm4').addEventListener('submit', function(event) {
        event.preventDefault();

        const fechaInicio = document.getElementById('fecha_inicio4').value;
        const fechaFin = document.getElementById('fecha_fin4').value;

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf4?fecha_inicio4=${fechaInicio}&fecha_fin4=${fechaFin}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
    //reporte1 general
    document.getElementById('btnRangoPredeterminado4').addEventListener('click', function() {
        const fechaInicio = '2024-01-01'; // Fecha de inicio predeterminada
        const fechaFin = new Date().toLocaleDateString('en-CA'); // Fecha de hoy

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf4?fecha_inicio4=${fechaInicio}&fecha_fin4=${fechaFin}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
</script>