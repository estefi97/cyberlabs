<?php


namespace App\Http\Controllers\Facade;

//  Importamos las Controladoras
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InscriptionsController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebinarController;
use Illuminate\Http\Request;

//  Importamos los Modelos
use App\Article;
use App\Comment;
use App\Course;
use App\Module;
use App\Plan;
use App\Specialty;
use App\Subscription;
use App\Teacher;
use App\User;
use App\Webinar;

class AdminFacade
{

    //  Definimos e Inicializamos las diferentes Controladoras
    public function __construct (){
        $this->AdminController = new AdminController();
        $this->ArticleController = new ArticleController();
        $this->AuditoriaController = new AuditoriaController();
        $this->CommentController = new CommentController();
        $this->CourseController = new CourseController();
        $this->InscriptionsController = new InscriptionsController();
        $this->ModuleController = new ModuleController();
        $this->PlanController = new PlanController();
        $this->ProfileController = new ProfileController();
        $this->SpecialtyController  = new SpecialtyController();
        $this->SubscriptionController = new SubscriptionController();
        $this->TeacherController = new TeacherController();
        $this->UserController = new UserController();
        $this->WebinarController = new WebinarController();
    }

    ///////////////////////////////////////
    //      AdminController Métodos     //
    /////////////////////////////////////

    public function verDashboard (User $user, Specialty $specialty, Course $course) {
        return $this->AdminController->inicio($user, $specialty, $course);
    }

    public function verDashboardArticulos (Article $article) {
        return $this->AdminController->articulos($article);
    }

    public function verDashboardAgregarArticulos () {
        return $this->AdminController->articulos_agregar();
    }

    public function verDashboardEditarArticulos (Request $request) {
        return $this->AdminController->articulos_editar($request);
    }

    public function verDashboardComentarios (Comment $comment) {
        return $this->AdminController->comentarios($comment);
    }

    public function verDashboardEditarComentarios (Request $request) {
        return $this->AdminController->comentarios_editar($request);
    }

    public function verDashboardCursos (Course $course) {
        return $this->AdminController->cursos($course);
    }

    public function verDashboardAgregarCursos () {
        return $this->AdminController->cursos_agregar();
    }

    public function verDashboardEditarCursos (Request $request) {
        return $this->AdminController->cursos_editar($request);
    }

    public function verDashboardEspecialidades (Specialty $specialty) {
        return $this->AdminController->especialidades($specialty);
    }

    public function verDashboardAgregarEspecialidades (Specialty $specialty) {
        return $this->AdminController->especialidades_agregar($specialty);
    }

    public function verDashboardEditarEspecialidades (Request $request) {
        return $this->AdminController->especialidades_editar($request);
    }

    public function verDashboardModulos (Module $module) {
        return $this->AdminController->moduloscursos($module);
    }

    public function verDashboardAgregarModulos (Module $module) {
        return $this->AdminController->moduloscursos_agregar($module);
    }

    public function verDashboardEditarModulos (Request $request) {
        return $this->AdminController->moduloscursos_editar($request);
    }

    public function verDashboardPlanes (Plan $plan) {
        return $this->AdminController->planes($plan);
    }

    public function verDashboardAgregarPlanes (Plan $plan) {
        return $this->AdminController->planes_agregar($plan);
    }

    public function verDashboardEditarPlanes (Request $request) {
        return $this->AdminController->planes_editar($request);
    }

    public function verDashboardProfesores (Teacher $teacher) {
        return $this->AdminController->profesores($teacher);
    }

    public function verDashboardAgregarProfesores () {
        return $this->AdminController->profesores_agregar();
    }

    public function verDashboardEditarProfesores (Request $request) {
        return $this->AdminController->profesores_editar($request);
    }

    public function verDashboardSuscripciones (Subscription $subscription) {
        return $this->AdminController->suscripciones($subscription);
    }

    public function verDashboardAgregarSuscripciones () {
        return $this->AdminController->suscripciones_agregar();
    }

    public function verDashboardEditarSuscripciones (Request $request) {
        return $this->AdminController->suscripciones_editar($request);
    }

    public function verDashboardUsuarios (User $user) {
        return $this->AdminController->usuarios($user);
    }

    public function verDashboardAgregarUsuarios () {
        return $this->AdminController->usuarios_agregar();
    }

    public function verDashboardEditarUsuarios (Request $request) {
        return $this->AdminController->usuarios_editar($request);
    }

    public function verDashboardWebinars (Webinar $webinar) {
        return $this->AdminController->webinars($webinar);
    }

    public function verDashboardAgregarWebinars () {
        return $this->AdminController->webinars_agregar();
    }

    public function verDashboardEditarWebinars (Request $request) {
        return $this->AdminController->webinars_editar($request);
    }

    /////////////////////////////////////////
    //      ArticleController Métodos     //
    ///////////////////////////////////////

    public function agregarArticulo (Request $request) {
        return $this->ArticleController->agregarArticulo($request);
    }

    public function editarArticulo (Request $request) {
        return $this->ArticleController->editarArticulo($request);
    }

    public function eliminarArticulo (Request $request) {
        return $this->ArticleController->eliminarArticulo($request);
    }

    ///////////////////////////////////////////
    //      AuditoriaController Métodos     //
    /////////////////////////////////////////

    public function verDashboardAuditoriaArticulos (Article $article) {
        return $this->AuditoriaController->verDashboardAuditoriaArticulos($article);
    }

    public function verDashboardAuditoriaComentarios (Comment $comment) {
        return $this->AuditoriaController->verDashboardAuditoriaComentarios($comment);
    }

    public function verDashboardAuditoriaCursos (Course $course) {
        return $this->AuditoriaController->verDashboardAuditoriaCursos($course);
    }

    public function verDashboardAuditoriaModulos (Module $module) {
        return $this->AuditoriaController->verDashboardAuditoriaModulos($module);
    }

    public function verDashboardAuditoriaPlanes (Plan $plan) {
        return $this->AuditoriaController->verDashboardAuditoriaPlanes($plan);
    }

    public function verDashboardAuditoriaEspecialidades (Specialty $specialty) {
        return $this->AuditoriaController->verDashboardAuditoriaEspecialidades($specialty);
    }

    public function verDashboardAuditoriaSuscripciones (Subscription $subscription) {
        return $this->AuditoriaController->verDashboardAuditoriaSuscripciones($subscription);
    }
    
    public function verDashboardAuditoriaProfesores (Teacher $teacher) {
        return $this->AuditoriaController->verDashboardAuditoriaProfesores($teacher);
    }
    
    public function verDashboardAuditoriaUsuarios (User $user) {
        return $this->AuditoriaController->verDashboardAuditoriaUsuarios($user);
    }
    
    public function verDashboardAuditoriaWebinars (Webinar $webinar) {
        return $this->AuditoriaController->verDashboardAuditoriaWebinars($webinar);
    }
    
    public function verDashboardAuditoriaInscripciones () {
        return $this->AuditoriaController->verDashboardAuditoriaInscripciones();
    }

    /////////////////////////////////////////
    //      CommentController Métodos     //
    ///////////////////////////////////////

    public function editarComentario (Request $request) {
        return $this->CommentController->editarComentario($request);
    }

    public function eliminarComentario (Request $request) {
        return $this->CommentController->eliminarComentario($request);
    }

    ////////////////////////////////////////
    //      CourseController Métodos     //
    //////////////////////////////////////

    public function agregarCurso (Request $request) {
        return $this->CourseController->agregarCurso($request);
    }

    public function editarCurso (Request $request) {
        return $this->CourseController->editarCurso($request);
    }

    public function eliminarCurso (Request $request) {
        return $this->CourseController->eliminarCurso($request);
    }

    ///////////////////////////////////////////
    //      InscriptionsController Métodos     //
    /////////////////////////////////////////

    public function verDashboardInscripciones () {
        return $this->InscriptionsController->verDashboardInscripciones();
    }

    public function verDashboardAgregarInscripciones () {
        return $this->InscriptionsController->verDashboardAgregarInscripciones();
    }

    public function agregarInscripcion (Request $request) {
        return $this->InscriptionsController->agregarInscripcion($request);
    }

    public function eliminarInscripcion (Request $request) {
        return $this->InscriptionsController->eliminarInscripcion($request);
    }

    ////////////////////////////////////////
    //      ModuleController Métodos     //
    //////////////////////////////////////

    public function agregarModulo (Request $request) {
        return $this->ModuleController->agregarModulo($request);
    }

    public function editarModulo (Request $request) {
        return $this->ModuleController->editarModulo($request);
    }

    public function eliminarModulo (Request $request) {
        return $this->ModuleController->eliminarModulo($request);
    }

    //////////////////////////////////////
    //      PlanController Métodos     //
    ////////////////////////////////////

    public function agregarPlan (Request $request) {
        return $this->PlanController->agregarPlan($request);
    }

    public function editarPlan (Request $request) {
        return $this->PlanController->editarPlan($request);
    }

    public function eliminarPlan (Request $request) {
        return $this->PlanController->eliminarPlan($request);
    }

    ///////////////////////////////////////////
    //      SpecialtyController Métodos     //
    /////////////////////////////////////////

    public function agregarEspecialidad (Request $request) {
        return $this->SpecialtyController->agregarEspecialidad($request);
    }

    public function editarEspecialidad (Request $request) {
        return $this->SpecialtyController->editarEspecialidad($request);
    }

    public function eliminarEspecialidad (Request $request) {
        return $this->SpecialtyController->eliminarEspecialidad($request);
    }

    //////////////////////////////////////////////
    //      SubscriptionController Métodos     //
    ////////////////////////////////////////////

    public function agregarSuscripcion (Request $request) {
        return $this->SubscriptionController->agregarSuscripcion($request);
    }

    public function editarSuscripcion (Request $request) {
        return $this->SubscriptionController->editarSuscripcion($request);
    }

    public function eliminarSuscripcion (Request $request) {
        return $this->SubscriptionController->eliminarSuscripcion($request);
    }

    /////////////////////////////////////////
    //      TeacherController Métodos     //
    ///////////////////////////////////////

    public function agregarProfesor (Request $request) {
        return $this->TeacherController->agregarProfesor($request);
    }

    public function editarProfesor (Request $request) {
        return $this->TeacherController->editarProfesor($request);
    }

    public function eliminarProfesor (Request $request) {
        return $this->TeacherController->eliminarProfesor($request);
    }

    //////////////////////////////////////
    //      UserController Métodos     //
    ////////////////////////////////////

    public function agregarUsuario (Request $request) {
        return $this->UserController->agregarUsuario($request);
    }

    public function editarUsuario (Request $request) {
        return $this->UserController->editarUsuario($request);
    }

    public function eliminarUsuario (Request $request) {
        return $this->UserController->eliminarUsuario($request);
    }

    /////////////////////////////////////////
    //      WebinarController Métodos     //
    ///////////////////////////////////////

    public function agregarWebinar (Request $request) {
        return $this->WebinarController->agregarWebinar($request);
    }

    public function editarWebinar (Request $request) {
        return $this->WebinarController->editarWebinar($request);
    }

    public function eliminarWebinar (Request $request) {
        return $this->WebinarController->eliminarWebinar($request);
    }

}