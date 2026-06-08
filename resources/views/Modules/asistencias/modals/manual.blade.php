<div class="modal fade" id="modalManualAsistencia" tabindex="-1">
    <div class="modal-dialog">

        <form action="{{ route('asistencias.manual') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Marcación Manual de Asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- EMPLEADO --}}
                <div class="mb-3">
                    <label class="form-label">Empleado</label>
                    <select class="form-control" name="empleado_id" required>
                        <option value="">Seleccione un empleado</option>
                        {{-- TODO: backend empleados --}}
                    </select>
                </div>

                {{-- TIPO --}}
                <div class="mb-3">
                    <label class="form-label">Tipo de marcación</label>
                    <select class="form-control" name="tipo" required>
                        <option value="">Seleccione</option>
                        <option value="entrada">Entrada</option>
                        <option value="salida">Salida</option>
                    </select>
                </div>

                {{-- FECHA --}}
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>

                {{-- HORA (opcional UI) --}}
                <div class="mb-3">
                    <label class="form-label">Hora (opcional)</label>
                    <input type="time" class="form-control" name="hora">
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </div>

        </form>

    </div>
</div>