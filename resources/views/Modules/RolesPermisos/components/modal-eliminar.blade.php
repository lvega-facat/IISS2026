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
                    Eliminar Rol
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                </button>

            </div>

            {{-- Formulario --}}
            <form action="{{ route('roles.destroy', $id) }}" method="POST">

                @csrf
                @method('DELETE')

                <div class="modal-body px-4 py-3">

                    <div class="delete-confirm-block text-center">

                        <i class="fa fa-triangle-exclamation delete-warn-icon mb-3"></i>

                        <p class="mb-2" style="font-size: 0.95rem; color: #334155;">
                            Estás a punto de eliminar el rol:
                        </p>

                        <p class="fw-bold mb-3" style="font-size: 1rem; color: #1e293b;">
                            {{ $nombre }}
                        </p>

                        <p style="font-size: 0.88rem; color: #64748b;">
                            Esta acción no se puede deshacer.
                            Los usuarios que tengan asignado este rol perderán los permisos asociados.
                        </p>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-end gap-3">

                    <button type="button"
                            class="btn-cancel-custom"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="btn-delete-confirm">
                        <i class="fa fa-trash me-2"></i>
                        Eliminar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>