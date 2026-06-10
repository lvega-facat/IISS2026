<div class="modal fade"
     id="toggleModal{{ $id }}"
     tabindex="-1"
     aria-labelledby="toggleModalLabel{{ $id }}"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-content">

            {{-- Header --}}
            <div class="modal-header border-0 px-4 pt-4 pb-2">
                <h5 class="modal-title fw-bold text-dark"
                    id="toggleModalLabel{{ $id }}">
                    {{ $accion === 'desactivar' ? 'Desactivar Usuario' : 'Activar Usuario' }}
                </h5>
                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                </button>
            </div>

            {{-- Formulario --}}
            <form action="{{ route('usuarios.toggle', $id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-body px-4 py-3">
                    <div class="delete-confirm-block text-center">

                        @if($accion === 'desactivar')
                            <i class="fa fa-triangle-exclamation delete-warn-icon mb-3"></i>
                        @else
                            <i class="fa fa-circle-check mb-3"
                               style="font-size:2.4rem;color:#16a34a;display:block;"></i>
                        @endif

                        <p class="mb-2" style="font-size: 0.95rem; color: #334155;">
                            {{ $accion === 'desactivar'
                                ? 'Estás a punto de desactivar al usuario:'
                                : 'Estás a punto de activar al usuario:' }}
                        </p>

                        <p class="fw-bold mb-3" style="font-size: 1rem; color: #1e293b;">
                            {{ $nombre }}
                        </p>

                        <p style="font-size: 0.88rem; color: #64748b;">
                            @if($accion === 'desactivar')
                                El usuario no podrá ingresar al sistema mientras esté desactivado.
                                Su historial y datos se conservarán intactos.
                            @else
                                El usuario recuperará el acceso al sistema con los permisos
                                de su rol asignado.
                            @endif
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
                            class="{{ $accion === 'desactivar' ? 'btn-toggle-desactivar' : 'btn-toggle-activar' }}">
                        @if($accion === 'desactivar')
                            <i class="fa fa-ban me-2"></i>Desactivar
                        @else
                            <i class="fa fa-circle-check me-2"></i>Activar
                        @endif
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>