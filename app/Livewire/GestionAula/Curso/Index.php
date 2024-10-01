<?php

namespace App\Livewire\GestionAula\Curso;

use App\Models\AsistenciaAlumno;
use App\Models\ForoRespuesta;
use App\Models\GestionAula;
use App\Models\GestionAulaUsuario;
use App\Models\TrabajoAcademico;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Vinkla\Hashids\Facades\Hashids;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public $id_usuario_hash;
    public $usuario;
    public $usuario_sesion;
    public $gestion_aulas;

    public $modo_admin = false;// Modo admin, para saber si se esta en modo administrador
    public $tipo_vista; // Tipo de vista, para saber si es alumno o docente
    public $ruta_vista;

    // Variables para page-header
    public $titulo_page_header;
    public $links_page_header = [];
    public $regresar_page_header;


    public function mostrar_cursos()
    {
        if($this->tipo_vista === 'cursos')
        {
            $gestion_aulas = GestionAula::with(['gestionAulaAlumno', 'curso'])
                ->whereHas('gestionAulaAlumno', function ($query) {
                    $query->where('id_usuario', $this->usuario->id_usuario)
                        ->estado(true);
                })
                ->estado(true)
                ->enCurso(true)
                ->orderBy('created_at', 'desc')
                ->get();
            $gestion_aulas = $gestion_aulas->sortBy('curso.nombre_curso');

            $gestion_aulas_finalizadas = GestionAula::with(['gestionAulaAlumno', 'curso'])
                ->whereHas('gestionAulaAlumno', function ($query) {
                    $query->where('id_usuario', $this->usuario->id_usuario)
                        ->estado(true);
                })
                ->estado(true)
                ->enCurso(false)
                ->orderBy('created_at', 'desc')
                ->get();
            $gestion_aulas_finalizadas = $gestion_aulas_finalizadas->sortBy('curso.nombre_curso');
        } else {
            $gestion_aulas = GestionAula::with(['gestionAulaDocente', 'curso'])
                ->whereHas('gestionAulaDocente', function ($query) {
                    $query->where('id_usuario', $this->usuario->id_usuario)
                        ->estado(true);
                })
                ->estado(true)
                ->enCurso(true)
                ->orderBy('created_at', 'desc')
                ->get();
            $gestion_aulas = $gestion_aulas->sortBy('curso.nombre_curso');

            $gestion_aulas_finalizadas = GestionAula::with(['gestionAulaDocente', 'curso'])
                ->whereHas('gestionAulaDocente', function ($query) {
                    $query->where('id_usuario', $this->usuario->id_usuario)
                        ->estado(true);
                })
                ->estado(true)
                ->enCurso(false)
                ->orderBy('created_at', 'desc')
                ->get();
            $gestion_aulas_finalizadas = $gestion_aulas_finalizadas->sortBy('curso.nombre_curso');
        }

        $this->gestion_aulas = $gestion_aulas->merge($gestion_aulas_finalizadas);

    }

    /* =============== OBTENER DATOS PARA MOSTRAR EL COMPONENTE PAGE HEADER =============== */
        public function obtener_datos_page_header()
        {
            if($this->tipo_vista === 'cursos')
            {
                $this->titulo_page_header = 'Mis Cursos';
            } else {
                $this->titulo_page_header = 'Carga Académica';
            }

            // Regresar

            if($this->modo_admin)
            {
                if($this->tipo_vista === 'cursos')
                {
                    $this->regresar_page_header = [
                        'route' => 'alumnos',
                        'params' => []
                    ];
                } else {
                    $this->regresar_page_header = [
                        'route' => 'docentes',
                        'params' => []
                    ];
                }
            }

            // Links --> Inicio
            $this->links_page_header = [
                [
                    'name' => 'Inicio',
                    'route' => 'inicio',
                    'params' => []
                ]
            ];

        }
    /* ===================================================================================== */


    public function mount($id_usuario, $tipo_vista)
    {
        $this->tipo_vista = $tipo_vista;

        $user = Auth::user();
        $this->usuario_sesion = Usuario::find($user->id_usuario);

        if ($this->usuario_sesion->esRol('ADMINISTRADOR'))
        {
            $this->modo_admin = true;
        }

        $this->id_usuario_hash = $id_usuario;
        $id = Hashids::decode($id_usuario);
        $this->usuario = Usuario::find($id[0]);

        $this->ruta_vista = request()->route()->getName();

        $this->obtener_datos_page_header();
        $this->mostrar_cursos();

    }

    public function render()
    {
        return view('livewire.gestion-aula.curso.index');
    }
}
