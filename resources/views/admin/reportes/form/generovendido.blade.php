<div class="modal fade" id="formModal6" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Reporte de Venta por Edad-Genero</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-secondary" id="btnRangoPredeterminado6">Infantil</button>
                <button type="button" class="btn btn-secondary" id="btnRangoPredeterminado61">Juvenil</button>
                <button type="button" class="btn btn-secondary" id="btnRangoPredeterminado62">Adulto</button>

            </div>
        </div>
    </div>
</div>
<script>
    
    document.getElementById('btnRangoPredeterminado6').addEventListener('click', function() {
        const tallaini = 16; // Fecha de inicio predeterminada
        const tallaFin = 29; // Fecha de hoy
        const edad = 'Infantil'

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf6?tallaini=${tallaini}&tallafin=${tallaFin}&edad=${edad}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
    document.getElementById('btnRangoPredeterminado61').addEventListener('click', function() {
        const tallaini = 30; // Fecha de inicio predeterminada
        const tallaFin = 39; // Fecha de hoy
        const edad = 'Juvenil'

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf6?tallaini=${tallaini}&tallafin=${tallaFin}&edad=${edad}`;

        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
    document.getElementById('btnRangoPredeterminado62').addEventListener('click', function() {
        const tallaini = 40; // Fecha de inicio predeterminada
        const tallaFin = 50; // Fecha de hoy
        const edad = 'Adulto'

        const iframe = document.getElementById('reporteIframe');
        iframe.src = `/generar-pdf6?tallaini=${tallaini}&tallafin=${tallaFin}&edad=${edad}`;
        const modal = new bootstrap.Modal(document.getElementById('reporteModal'));
        modal.show();
    });
</script>