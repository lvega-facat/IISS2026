<form>

    {{-- CARD CONTENEDOR (solo visual con Bootstrap) --}}
    <div class="card p-4 shadow-sm border-0">

        {{-- NOMBRE --}}
        <div class="mb-3">
            <label class="form-label-custom">Nombre</label>

            <input type="text"
                   class="form-control-custom form-control"
                   placeholder="Ingrese el nombre del departamento"
                   required>
        </div>

        {{-- CÓDIGO --}}
        <div class="mb-3">
            <label class="form-label-custom">Código *</label>

            <input type="text"
                   class="form-control-custom form-control"
                   placeholder="Ingrese el código"
                   required>
        </div>

        {{-- DESCRIPCIÓN --}}
        <div class="mb-3">
            <label class="form-label-custom">Descripción</label>

            <textarea class="form-control-custom form-control"
                      rows="4"
                      placeholder="Ingrese una descripción"></textarea>
        </div>

        {{-- FUNCIÓN PRINCIPAL --}}
        <div class="mb-3">
            <label class="form-label-custom">Función Principal *</label>

            <input type="text"
                   class="form-control-custom form-control"
                   placeholder="Ingrese la función principal"
                   required>
        </div>

        {{-- DEPARTAMENTO PADRE --}}
        <div class="mb-3">
            <label class="form-label-custom">Departamento Padre</label>

            <select class="form-select form-select-custom">

                <option value="">Ninguno</option>
                <option value="1">dato de prueba 1</option>
                <option value="2">dato de prueba 2</option>

            </select>
        </div>

        {{-- BOTONES --}}
        <div class="d-flex justify-content-end gap-2 mt-4">

            <button type="button" class="btn btn-light">
                Cancelar
            </button>

            <button type="submit" class="btn btn-primary">
                Guardar
            </button>

        </div>

    </div>

</form>