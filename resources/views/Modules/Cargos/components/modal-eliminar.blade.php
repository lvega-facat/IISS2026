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
                    Desactivar Cargo
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                </button>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('cargos.desactivar', $id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-body px-4 py-3">
                    <div class="text-center">

                        <i class="fa fa-triangle-exclamation mb-3"
                           style="font-size: 3rem; color: #bd0909;">
                        </i>

                        <p class="mb-2"
                           style="font-size: 0.95rem; color: #475569;">
                            Estás a punto de desactivar el cargo:
                        </p>

                        <p class="fw-bold mb-3"
                           style="font-size: 1.1rem; color: #1e293b;">
                            {{ $nombre }}
                        </p>

                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los empleados asociados podrían quedar sin un cargo asignado en el sistema.
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
                            style="background-color: #a30808 !important;">
                        <i class="fa fa-ban me-2"></i>
                        Desactivar
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>