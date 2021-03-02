<?php


namespace App\Http\Controllers\Facade;

//  Importamos las Controladoras
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WebinarController;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

//  Importamos los Modelos
use App\Article;
use App\Course;
use App\Module;
use App\Plan;
use App\Specialty;
use App\Webinar;

class GeneralFacade
{

    //  Definimos e Inicializamos las diferentes Controladoras
    public function __construct (){
        $this->ArticleController = new ArticleController();
        $this->Controller = new Controller();
        $this->CourseController = new CourseController();
        $this->LoginController = new LoginController();
        $this->ModuleController = new ModuleController();
        $this->PlanController = new PlanController();
        $this->ProfileController = new ProfileController();
        $this->SpecialtyController  = new SpecialtyController();
        $this->SubscriptionController = new SubscriptionController();
        $this->WebinarController = new WebinarController();
    }

    /////////////////////////////////////////
    //      ArticleController Métodos     //
    ///////////////////////////////////////

    public function verArticulo (Article $article) {
        return $this->ArticleController->show($article);
    }

    public function listarArticulos () {
        return $this->ArticleController->listArticles();
    }

    public function agregarComentario (Request $request) {
        return $this->ArticleController->agregarComentario($request);
    }

    //////////////////////////////////
    //      Controller Métodos     //
    ////////////////////////////////

    public function configurarIdioma ($language) {
        return $this->Controller->setLanguage($language);
    }

    ////////////////////////////////////////
    //      CourseController Métodos     //
    //////////////////////////////////////

    public function inscripcionCurso (Request $request) {
        return $this->CourseController->inscripcionCurso($request);
    }

    public function verCurso (Course $course) {
        return $this->CourseController->show($course);
    }

    public function listarCursos () {
        return $this->CourseController->listCourses();
    }

    ///////////////////////////////////////
    //      LoginController Métodos     //
    /////////////////////////////////////

    public function loginConRedesSociales (String $driver) {
        return $this->LoginController->redirectToProvider($driver);
    }

    public function respuestaLoginConRedesSociales (String $driver) {
        return $this->LoginController->handleProviderCallback($driver);
    }

    ////////////////////////////////////////
    //      ModuleController Métodos     //
    //////////////////////////////////////

    public function verModulo ($course, $module) {
        return $this->ModuleController->show($course, $module);
    }

    public function asignarModuloCompletadoAUsuario (Request $request) {
        return $this->ModuleController->asignarModuloCompletadoAUsuario($request);
    }

    //////////////////////////////////////
    //      PlanController Métodos     //
    ////////////////////////////////////

    public function verPlan (Plan $plan) {
        return $this->PlanController->show($plan);
    }

    /////////////////////////////////////////
    //      ProfileController Métodos     //
    ///////////////////////////////////////

    public function verPerfilUsuario (Request $request) {
        return $this->ProfileController->userProfile($request);
    }

    public function verEditarPerfilUsuario () {
        return $this->ProfileController->editarPerfilUsuario();
    }

    public function actualizarUsuario (Request $request) {
        return $this->ProfileController->updateUsuario($request);
    }

    public function actualizarContrasenaUsuario (Request $request) {
        return $this->ProfileController->updateContrasenaUsuario($request);
    }

    public function ocultarPerfilUsuario () {
        return $this->ProfileController->notIndex();
    }

    ///////////////////////////////////////////
    //      SpecialtyController Métodos     //
    /////////////////////////////////////////

    public function listarEspecialidades () {
        return $this->SpecialtyController->listSpecialties();
    }

    public function verEspecialidad (Specialty $specialty) {
        return $this->SpecialtyController->show($specialty);
    }

    //////////////////////////////////////////////
    //      SubscriptionController Métodos     //
    ////////////////////////////////////////////

    public function procesarSuscripcion (Request $request) {
        return $this->SubscriptionController->processSubscription($request);
    }

    /////////////////////////////////////////
    //      WebinarController Métodos     //
    ///////////////////////////////////////

    public function verWebinar (Webinar $webinar) {
        return $this->WebinarController->show($webinar);
    }

    public function agregarComentarioEnWebinar (Request $request) {
        return $this->WebinarController->agregarComentario($request);
    }

}