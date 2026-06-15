<div class="modal fade" id="createHorarioModal" tabindex="-1" aria-labelledby="createHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal-content">

            <div class="modal-body p-5">

                <div class="modal-title-section mb-4">
                    <h5 class="modal-title fw-bold text-secondary-custom">
                        Horario Laboral
                    </h5>

                    <span class="modal-subtitle text-muted fs-7">
                        Registrar nuevo horario de trabajo
                    </span>
                </div>

                <form action="#" method="POST" id="formCreateHorario">
                    @csrf

                    <!-- NOMBRE -->
                    <div class="form-group-custom">
                        <label for="nombre" class="form-label-custom">
                            Nombre del Horario
                        </label>

                        <input
                            type="text"
                            class="form-control-custom"
                            id="nombre"
                            name="nombre"
                            placeholder="Ej: Administrativo Mañana"
                            required>
                    </div>

                    <!-- TIPO DE JORNADA -->
                    <div class="form-group-custom mt-4">
                        <label for="tipo_jornada" class="form-label-custom">
                            Tipo de Jornada
                        </label>

                        <select
                            class="form-control-custom form-select-custom"
                            id="tipo_jornada"
                            name="tipo_jornada"
                            required>

                            <option value="" selected disabled>
                                Seleccione un tipo de jornada
                            </option>

                            <option value="completa">
                                Jornada Completa
                            </option>

                            <option value="media">
                                Media Jornada
                            </option>

                            <option value="jornalero">
                                Jornalero
                            </option>

                        </select>
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="form-group-custom mt-4">
                        <label for="descripcion" class="form-label-custom">
                            Descripción
                        </label>

                        <textarea
                            class="form-control-custom"
                            id="descripcion"
                            name="descripcion"
                            rows="3"
                            placeholder="Ingrese una descripción del horario"></textarea>
                    </div>

                    <!-- HORAS -->
                    <div class="row mt-4">

                        <div class="col-md-6">
                            <label for="hora_entrada" class="form-label-custom">
                                Hora de Entrada
                            </label>

                            <input
                                type="time"
                                class="form-control-custom"
                                id="hora_entrada"
                                name="hora_entrada"
                                required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_salida" class="form-label-custom">
                                Hora de Salida
                            </label>

                            <input
                                type="time"
                                class="form-control-custom"
                                id="hora_salida"
                                name="hora_salida"
                                required>
                        </div>

                    </div>

                    <!-- TOLERANCIA -->
                    <div class="form-group-custom mt-4">
                        <label for="tolerancia" class="form-label-custom">
                            Tolerancia de Entrada (Minutos)
                        </label>

                        <input
                            type="number"
                            min="0"
                            class="form-control-custom"
                            id="tolerancia"
                            name="tolerancia"
                            placeholder="Ej: 10">
                    </div>

                    <!-- RESUMEN VISUAL -->
                    <div class="alert alert-light border mt-4 mb-0">

                        <strong>Información:</strong>

                        <ul class="mb-0 mt-2">
                            <li>Jornada Completa: máximo 8 horas diarias.</li>
                            <li>Media Jornada: máximo 4 horas diarias.</li>
                            <li>Total semanal permitido: 48 horas.</li>
                        </ul>

                    </div>

                    <!-- BOTONES -->
                    <div class="modal-actions-container d-flex justify-content-between align-items-center mt-5">

                        <button
                            type="button"
                            class="btn btn-cancel-custom"
                            data-bs-dismiss="modal">
                            CANCELAR
                        </button>

                        <button
                            type="submit"
                            class="btn btn-create-custom">
                            CREAR
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>