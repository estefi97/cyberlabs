<?php


namespace App\Http\Controllers;

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


class AuditoriaController extends Controller
{

    public function verDashboardAuditoriaArticulos (Article $article) {
        return view('dashboard.auditoria.articulos', compact('article'));
    }

    public function verDashboardAuditoriaComentarios (Comment $comment) {
        return view('dashboard.auditoria.comentarios', compact('comment'));
    }

    public function verDashboardAuditoriaCursos (Course $course) {
        return view('dashboard.auditoria.cursos', compact('course'));
    }

    public function verDashboardAuditoriaModulos (Module $module) {
        return view('dashboard.auditoria.modulos', compact('module'));
    }

    public function verDashboardAuditoriaPlanes (Plan $plan) {
        return view('dashboard.auditoria.planes', compact('plan'));
    }

    public function verDashboardAuditoriaEspecialidades (Specialty $specialty) {
        return view('dashboard.auditoria.especialidades', compact('specialty'));
    }

    public function verDashboardAuditoriaSuscripciones (Subscription $subscription) {
        return view('dashboard.auditoria.suscripciones', compact('subscription'));
    }

    public function verDashboardAuditoriaProfesores (Teacher $teacher) {
        return view('dashboard.auditoria.profesores', compact('teacher'));
    }

    public function verDashboardAuditoriaUsuarios (User $user) {
        return view('dashboard.auditoria.usuarios', compact('user'));
    }

    public function verDashboardAuditoriaWebinars (Webinar $webinar) {
        return view('dashboard.auditoria.webinars', compact('webinar'));
    }

    public function verDashboardAuditoriaInscripciones () {
        return view('dashboard.auditoria.inscripciones');
    }

}