<div class="modal fade" id="modalEditOrganizacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <form action="{{ route('organizacion.update', $organizacion->id ?? 0) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Editar Organización</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                   value="{{ $organizacion->nombre ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">RUC</label>
                            <input type="text" name="ruc" class="form-control"
                                   value="{{ $organizacion->ruc ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control"
                                   value="{{ $organizacion->direccion ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ $organizacion->email ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">País</label>
                            <input type="text" name="pais" class="form-control"
                                   value="{{ $organizacion->pais ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                   value="{{ $organizacion->telefono ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sector</label>
                            <input type="text" name="sector" class="form-control"
                                   value="{{ $organizacion->sector ?? '' }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">

                            @if(!empty($organizacion->logo_url))
                                <img src="{{ $organizacion->logo_url }}"
                                     class="img-thumbnail mt-2"
                                     style="max-height: 120px;">
                            @endif
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Actualizar
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>