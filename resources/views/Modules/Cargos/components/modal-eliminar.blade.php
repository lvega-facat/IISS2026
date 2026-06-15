<div class="modal fade"
     id="eliminarModal{{ $id }}"
     tabindex="-1"
     aria-labelledby="eliminarModalLabel{{ $id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">

        {{-- Se aplica la clase universal del CSS con border-radius: 40px --}}
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
                    {{-- Removidas clases no existentes. Se usan utilidades nativas y estilos limpios --}}
                    <div class="text-center">
                        
                        {{-- Icono de advertencia adaptado con el color destructivo del sistema --}}
                        <i class="fa fa-triangle-exclamation mb-3" style="font-size: 3rem; color: #bd0909;"></i>

                        <p class="mb-2" style="font-size: 0.95rem; color: #475569;">
                            Estás a punto de eliminar el rol:
                        </p>

                        <p class="fw-bold mb-3" style="font-size: 1.1rem; color: #1e293b;">
                            {{ $nombre }}
                        </p>

                        <p style="font-size: 0.88rem; color: #64748b; line-height: 1.5;">
                            Esta acción no se puede deshacer.<br>
                            Los usuarios que tengan asignado este rol perderán los permisos asociados.
                        </p>

                    </div>
                </div>

                {{-- Footer --}}
                {{-- Contenedor de acciones alineado con el espacio gap-3 y paddings del nuevo estándar --}}
                <div class="modal-footer border-0 px-4 pb-4 pt-2 d-flex justify-content-center gap-3">

                    {{-- Botón Cancelar (En tu CSS ahora tiene fondo rojo automático) --}}
                    <button type="button"
                            class="btn-cancel-custom"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    {{-- Botón Eliminar (Reutiliza el formato de btn-cancel-custom para mantener la simetría y color destructivo rojo) --}}
                    <button type="submit"
                            class="btn-cancel-custom"
                            style="background-color: #a30808 !important;">
                        <i class="fa fa-trash me-2"></i>Eliminar
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>