<div class="modal fade"
     id="eliminarModal{{ $id }}"
     tabindex="-1"
     aria-labelledby="eliminarModalLabel{{ $id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">

        <div class="modal-content custom-modal-content">

            {{-- Header --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark"
                    id="eliminarModalLabel{{ $id }}">
                    Eliminar Tipo de Contrato
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                </button>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('tipos-contrato.destroy', $id) }}" method="POST">
                @csrf
                @slot('method')
                    @method('DELETE')
                @endslot

                <div class="modal-body px-4 py-3">
                    <div class="text-center">

                        <i class="fa fa-triangle-exclamation mb-3"
                           style="font-size: 3rem; color: #bd0909;">
                        </i>

                        <p class="mb-2"
                           style="font-size: 0.95rem; color: #475569;">
                            Estás a punto de eliminar el tipo de contrato:
                        </p>

                        <p class="fw-bold mb-3"
                           style="font-size: 1.1rem; color: #1e293b;">
                            {{ $nombre }}
                        </p>

                        {{-- Nota informativa obligatoria por HU (Criterio de aceptación 8) --}}
                        <div class="p-2 mb-3 text-start" style="background-color: #f8fafc; border-left: 4px solid #64748b; border-radius: 4px;">
                           <p class="mb-0 text-muted" style="font-size: 0.82rem; line-height: 1.4;">
                                <i class="fa fa-info-circle me-1 text-secondary"></i>
                                <strong>Validación del sistema:</strong> Si este contrato posee empleados vinculados activos, la acción será rechazada automáticamente informando el motivo.
                           </p>
                        </div>

                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción ejecutará una eliminación lógica y quedará registrada en las bitácoras de auditoría del sistema.
                        </p>

                    </div>
                </div>

            {{-- Footer --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">

                    <button type="button"
                            class="btn-cancel-custom"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="btn-cancel-custom"
                            style="background-color: #a30808 !important; color: #ffffff !important;">
                        <i class="fa fa-trash me-2"></i>
                        Confirmar Eliminar
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>