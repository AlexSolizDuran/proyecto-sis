@extends('layout')

@section('contenido')

<div class="container mt-5">
    <h2 class="mb-4 text-center">REPORTES</h2>

    <!-- Contenedor de botones de reportes -->
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal1">Reporte de Ventas</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal2">Reporte de Ganancia</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal3">Reporte de Ventas Marca - Modelo</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal4">Reporte de Ventas Colores</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal5">Reporte de Ventas Tallas</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal6">Reporte de Ventas Edad - Genero</button>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal7">Reporte de lo Invertido</button>
    </div>

    <!-- Modal para mostrar el PDF -->
    <div class="modal fade" id="reporteModal" tabindex="-1" aria-labelledby="reporteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reporteModalLabel">Reportes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe id="reporteIframe" src="" frameborder="0" style="width: 100%; height: 600px;"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inclusión de los modales de selección de fechas -->
@include('admin.reportes.form.ventafecha')
@include('admin.reportes.form.gananciafecha')
@include('admin.reportes.form.marcafecha')
@include('admin.reportes.form.colorfecha')
@include('admin.reportes.form.tallafecha')
@include('admin.reportes.form.generovendido')
@include('admin.reportes.form.invertidofecha')

@endsection
