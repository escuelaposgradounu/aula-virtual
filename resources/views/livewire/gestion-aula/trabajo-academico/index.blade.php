<div>

    <livewire:components.navegacion.page-header :titulo_pasos=$titulo_page_header :titulo=$titulo_page_header
        :links_array=$links_page_header :regresar=$regresar_page_header />

    <div class="page-body">
        <div class="container-xl">

            @if($modo_admin)
            <livewire:components.curso.admin-info-usuario :usuario=$usuario :tipo_vista=$tipo_vista lazy />
            @endif

            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card card-md card-stacked animate__animated animate__fadeIn">
                        <div class="card-stamp card-stamp-lg">
                            {{-- Icono --}}
                            @if ($tipo_vista === 'cursos')
                                <div class="card-stamp-icon bg-teal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M13 5h8" />
                                        <path d="M13 9h5" />
                                        <path d="M13 15h8" />
                                        <path d="M13 19h5" />
                                        <path
                                            d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path
                                            d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    </svg>
                                </div>
                            @elseif($tipo_vista === 'carga-academica')
                                <div class="card-stamp-icon bg-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-list-details">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M13 5h8" />
                                        <path d="M13 9h5" />
                                        <path d="M13 15h8" />
                                        <path d="M13 19h5" />
                                        <path
                                            d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        <path
                                            d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row row-cards d-flex justify-content-start">

                                {{-- Boton de agregar --}}
                                @if ($tipo_vista === 'carga-academica' && $usuario->esRolGestionAula('DOCENTE',
                                $id_gestion_aula_usuario))
                                    <div class="col-lg-12">
                                        <a class="card card-link cursor-pointer" wire:click="abrir_modal_agregar_trabajo()">
                                            <div class="card-body text-secondary">
                                                <div class="row g-2">
                                                    <div
                                                        class="col-12 d-flex justify-content-center align-items-center mt-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-library-plus svg-medium">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 3m0 2.667a2.667 2.667 0 0 1 2.667 -2.667h8.666a2.667 2.667 0 0 1 2.667 2.667v8.666a2.667 2.667 0 0 1 -2.667 2.667h-8.666a2.667 2.667 0 0 1 -2.667 -2.667z" />
                                                            <path
                                                                d="M4.012 7.26a2.005 2.005 0 0 0 -1.012 1.737v10c0 1.1 .9 2 2 2h10c.75 0 1.158 -.385 1.5 -1" />
                                                            <path d="M11 10h6" />
                                                            <path d="M14 7v6" />
                                                        </svg>
                                                    </div>
                                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                                        <span class="text-muted fs-5">
                                                            Agregar trabajo académico
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif

                                @forelse($trabajos_academicos as $item)
                                    <livewire:components.trabajo-academico.card-trabajo-academico :tipo_vista=$tipo_vista
                                        :usuario=$usuario :id_gestion_aula_usuario=$id_gestion_aula_usuario
                                        :trabajo_academico=$item wire:key="{{ $item->id_trabajo_academico }}" lazy />
                                @empty
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="text-muted">
                                            No hay trabajos académicos registrados
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <livewire:components.curso.datos-curso :id_gestion_aula_usuario=$id_gestion_aula_usuario
                        :ruta_pagina=$ruta_pagina :tipo_vista=$tipo_vista lazy />
                </div>

            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="modal-trabajo-academico" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $titulo_modal }}
                    </h5>
                    <button type="button" class="btn-close icon-rotate-custom" data-bs-dismiss="modal"
                        aria-label="Close" wire:click="cerrar_modal"></button>
                </div>
                <form autocomplete="off" wire:submit="guardar_trabajo">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="nombre_recurso" class="form-label required">
                                    Nombre del trabajo académico
                                </label>
                                <input type="text" name="nombre_trabajo_academico"
                                    class="form-control @error('nombre_trabajo_academico') is-invalid @elseif(strlen($nombre_trabajo_academico) > 0) is-valid @enderror"
                                    id="nombre_trabajo_academico" wire:model.live="nombre_trabajo_academico"
                                    placeholder="Ingrese su correo electrónico" />
                                @error('nombre_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="descripcion_recurso" class="form-label">
                                    Descripción del trabajo académico
                                </label>
                                <textarea name="descripcion_trabajo_academico"
                                    class="form-control @error('descripcion_trabajo_academico') is-invalid @elseif(strlen($descripcion_trabajo_academico) > 0) is-valid @enderror"
                                    id="descripcion_trabajo_academico" wire:model.live="descripcion_trabajo_academico"
                                    placeholder="Ingrese la descripción del trabajo académico" rows="4"></textarea>
                                @error('descripcion_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="fecha_inicio_trabajo_academico" class="form-label required">
                                    Fecha de inicio
                                </label>
                                <input type="date" name="fecha_inicio_trabajo_academico"
                                    class="form-control @error('fecha_inicio_trabajo_academico') is-invalid @elseif(strlen($fecha_inicio_trabajo_academico) > 0) is-valid @enderror"
                                    id="fecha_inicio_trabajo_academico"
                                    wire:model.live="fecha_inicio_trabajo_academico" />
                                @error('fecha_inicio_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="hora_inicio_trabajo_academico" class="form-label required">
                                    Hora de inicio
                                </label>
                                <input type="time" name="hora_inicio_trabajo_academico"
                                    class="form-control @error('hora_inicio_trabajo_academico') is-invalid @elseif(strlen($hora_inicio_trabajo_academico) > 0) is-valid @enderror"
                                    id="hora_inicio_trabajo_academico"
                                    wire:model.live="hora_inicio_trabajo_academico" />
                                @error('hora_inicio_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="fecha_fin_trabajo_academico" class="form-label required">
                                    Fecha de fin
                                </label>
                                <input type="date" name="fecha_fin_trabajo_academico"
                                    class="form-control @error('fecha_fin_trabajo_academico') is-invalid @elseif(strlen($fecha_fin_trabajo_academico) > 0) is-valid @enderror"
                                    id="fecha_fin_trabajo_academico" wire:model.live="fecha_fin_trabajo_academico" />
                                @error('fecha_fin_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <label for="hora_fin_trabajo_academico" class="form-label required">
                                    Hora de fin
                                </label>
                                <input type="time" name="hora_fin_trabajo_academico"
                                    class="form-control @error('hora_fin_trabajo_academico') is-invalid @elseif(strlen($hora_fin_trabajo_academico) > 0) is-valid @enderror"
                                    id="hora_fin_trabajo_academico" wire:model.live="hora_fin_trabajo_academico" />
                                @error('hora_fin_trabajo_academico')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="archivos_trabajo_academico" class="form-label">
                                    @if ($modo === 1)
                                    Archivos del trabajo académico
                                    @else
                                    Agregar archivos al trabajo académico
                                    @endif
                                </label>
                                <input type="file" class="form-control @error('archivos_trabajo_academico') is-invalid @enderror
                                    @if(count($archivos_trabajo_academico) > 0 && $errors->has('archivos_trabajo_academico.*')) is-invalid
                                    @elseif(count($archivos_trabajo_academico) > 0) is-valid @endif"
                                    wire:model.live="archivos_trabajo_academico" id="upload{{ $iteration }}"
                                    accept=".pdf,.xls,.xlsx,.doc,.docx,.ppt,.pptx,.txt,.jpg,.jpeg,.png" multiple>
                                @error('archivos_trabajo_academico.*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-outline-secondary" data-bs-dismiss="modal" wire:click="cerrar_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                <path d="M5.7 5.7l12.6 12.6" />
                            </svg>
                            Cancelar
                        </a>

                        <div class="ms-auto">
                            <div wire:loading.remove>
                                <button type="submit" class="btn btn-primary">
                                    @if ($modo === 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path
                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    @endif
                                    {{ $accion_modal }}
                                </button>
                            </div>
                            <div wire:loading>
                                <button type="submit" class="btn btn-primary" disabled>
                                    <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                    Cargando
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
