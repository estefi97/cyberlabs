<?php

Route::get('/set_language/{lang}', 'Facade\GeneralFacade@configurarIdioma')->name( 'set_language');

Route::get('login/{driver}', 'Facade\GeneralFacade@loginConRedesSociales')->name('social_auth');
Route::get('login/{driver}/callback', 'Facade\GeneralFacade@respuestaLoginConRedesSociales');

Route::get('/', function () {
    return view('welcome');
});

Route::get('politicas-de-privacidad', function () {
    return view('politicas-de-privacidad');
});

Route::get('condiciones-de-uso', function () {
    return view('condiciones-de-uso');
});

Route::get('preguntas-frecuentes', function () {
    return view('preguntas-frecuentes');
});

Route::get('sobre-nosotros', function () {
   return view('sobre-nosotros');
});

Route::get('/planes','Facade\GeneralFacade@verPlan')->name('planes');

Route::get('especialidades','Facade\GeneralFacade@listarEspecialidades')->name('especialidades');

Route::get('cursos', 'Facade\GeneralFacade@listarCursos')->name('cursos');

Route::get('articulos', 'Facade\GeneralFacade@listarArticulos')->name('articulos');

Route::get('/', function() {
   return view('home');
})->name('inicioPagina');


Route::group(['prefix' => "webinars", "middleware" => ['auth']], function() {

    Route::get('/','Facade\GeneralFacade@verWebinar')->name('webinars');
    Route::post('/agregarcomentario','Facade\GeneralFacade@agregarComentarioEnWebinar')->name('webinars.agregarComentario');

});

Auth::routes();

Route::get('/images/{path}/{attachment}', function($path, $attachment) {
	$file = sprintf('storage/%s/%s', $path, $attachment);
	if(File::exists($file)) {
		return Image::make($file)->response();
	}
});

Route::group(['prefix' => 'especialidad'], function () {

    Route::get('/{specialty}','Facade\GeneralFacade@verEspecialidad')->name('especialidad');

});

Route::group(['prefix' => 'articulo'], function () {

    Route::get('/{article}', 'Facade\GeneralFacade@verArticulo')->name('articulo');
    Route::post('/agregarComentario','Facade\GeneralFacade@agregarComentario')->name('articulo.agregarComentario');

});

Route::group(['prefix' => 'curso'], function () {

	Route::group(['middleware' => ['auth']], function() {
		Route::get('/subscribed', 'CourseController@subscribed')->name('courses.subscribed');
		Route::get('/{course}/inscribe', 'CourseController@inscribe')->name('courses.inscribe');
		Route::post('/add_review', 'CourseController@addReview')->name('courses.add_review');

		//  Inscripciòn Curso
        Route::get('/inscripcion-curso/{id_curso}/{id_usuario}','Facade\GeneralFacade@inscripcionCurso')->name('courses.inscripcionCurso');

		//  Modulos Cursos
        Route::get('/{course}/{module}','Facade\GeneralFacade@verModulo')->name('courses.module');
        Route::post('/{course}/{module}','Facade\GeneralFacade@asignarModuloCompletadoAUsuario')->name('courses.module.completed');

		Route::group(['middleware' => [sprintf('role:%s', \App\Role::TEACHER)]], function () {
			Route::resource('courses', 'CourseController');
		});
	});

	Route::get('/{course}', 'Facade\GeneralFacade@verCurso')->name('courses.detail');
});

Route::group(['middleware' => ['auth']], function () {
	Route::group(["prefix" => "subscriptions"], function() {
        Route::get('/admin', 'SubscriptionController@admin')->name('subscriptions.admin');
		Route::get('/process_subscription/{price_stripe_id}', 'Facade\GeneralFacade@procesarSuscripcion')
		     ->name('subscriptions.process_subscription');
		Route::post('/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
		Route::post('/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
	});

	Route::group(['prefix' => "invoices"], function() {
		Route::get('/admin', 'InvoiceController@admin')->name('invoices.admin');
		Route::get('/{invoice}/download', 'InvoiceController@download')->name('invoices.download');
	});
});

Route::group(["prefix" => "perfil", "middleware" => ["auth"]], function() {
    Route::get('/editar', 'Facade\GeneralFacade@verEditarPerfilUsuario')->name('profile.editarPerfilUsuario');
    Route::get('/{id_user}','Facade\GeneralFacade@verPerfilUsuario')->name('profile.userProfile');
	Route::post('/editarusuario', 'Facade\GeneralFacade@actualizarUsuario')->name('profile.updateUsuario');
	Route::post('/editarcontrasena', 'Facade\GeneralFacade@actualizarContrasenaUsuario')->name('profile.updateContrasenaUsuario');
});

Route::group(['prefix' => "solicitude"], function() {
	Route::post('/teacher', 'SolicitudeController@teacher')->name('solicitude.teacher');
});

Route::group(['prefix' => "teacher", "middleware" => ["auth"]], function() {
	Route::get('/courses', 'TeacherController@courses')->name('teacher.courses');
	Route::get('/students', 'TeacherController@students')->name('teacher.students');
	Route::post('/send_message_to_student', 'TeacherController@sendMessageToStudent')->name('teacher.send_message_to_student');
});

Route::group(['prefix' => "admin", "middleware" => ['auth', sprintf("role:%s", \App\Role::ADMIN)]], function() {
	Route::get('/courses', 'AdminController@courses')->name('admin.courses');
	Route::get('/courses_json', 'AdminController@coursesJson')->name('admin.courses_json');
	Route::post('/courses/updateStatus', 'AdminController@updateCourseStatus');

	Route::get('/students', 'AdminController@students')->name('admin.students');
	Route::get('/students_json', 'AdminController@studentsJson')->name('admin.students_json');
	Route::get('/teachers', 'AdminController@teachers')->name('admin.teachers');
	Route::get('/teachers_json', 'AdminController@teachersJson')->name('admin.teachers_json');
});

Route::group(['prefix' => "dashboard", "middleware" => ['auth', sprintf("role:1-2")]], function () {

    Route::get('/','Facade\AdminFacade@verDashboard')->name('dashboard_inicio');

    //  Articulos
    Route::get('/articulos','Facade\AdminFacade@verDashboardArticulos')->name('dashboard_articulos');
    Route::post('/articulos','Facade\AdminFacade@eliminarArticulo')->name('dashboard_articulos.eliminar');
    Route::get('/articulos/agregar','Facade\AdminFacade@verDashboardAgregarArticulos')->name('dashboard_articulos_agregar');
    Route::post('/articulos/agregar','Facade\AdminFacade@agregarArticulo')->name('dashboard_articulos.agregar');
    Route::get('/articulos/editar/{id_articulo}','Facade\AdminFacade@verDashboardEditarArticulos')->name('dashboard_articulos_editar');
    Route::post('/articulos/editar','Facade\AdminFacade@editarArticulo')->name('dashboard_articulos.editar');

    //  Comentarios
    Route::get('/comentarios','Facade\AdminFacade@verDashboardComentarios')->name('dashboard_comentarios');
    Route::post('/comentarios','Facade\AdminFacade@eliminarComentario')->name('dashboard_comentarios.eliminar');
    Route::get('/comentarios/editar/{id_comentario}','Facade\AdminFacade@verDashboardEditarComentarios')->name('dashboard_comentarios_editar');
    Route::post('/comentarios/editar','Facade\AdminFacade@editarComentario')->name('dashboard_comentarios.editar');

    //  Cursos
    Route::get('/cursos','Facade\AdminFacade@verDashboardCursos')->name('dashboard_cursos');
    Route::post('/cursos','Facade\AdminFacade@eliminarCurso')->name('dashboard_cursos.eliminar');
    Route::get('/cursos/agregar','Facade\AdminFacade@verDashboardAgregarCursos')->name('dashboard_cursos_agregar');
    Route::post('/cursos/agregar','Facade\AdminFacade@agregarCurso')->name('dashboard_cursos.agregar');
    Route::get('/cursos/editar/{id_curso}','Facade\AdminFacade@verDashboardEditarCursos')->name('dashboard_cursos_editar');
    Route::post('/cursos/editar','Facade\AdminFacade@editarCurso')->name('dashboard_cursos.editar');

    //  Especialidades
    Route::get('/especialidades','Facade\AdminFacade@verDashboardEspecialidades')->name('dashboard_especialidades');
    Route::post('/especialidades', 'Facade\AdminFacade@eliminarEspecialidad')->name('dashboard_especialidades.eliminar');
    Route::get('/especialidades/agregar','Facade\AdminFacade@verDashboardAgregarEspecialidades')->name('dashboard_especialidades_agregar');
    Route::post('/especialidades/agregar','Facade\AdminFacade@agregarEspecialidad')->name('dashboard_especialidades.agregar');
    Route::get('/especialidades/editar/{id_especialidad}','Facade\AdminFacade@verDashboardEditarEspecialidades')->name('dashboard_especialidades_editar');
    Route::post('/especialidades/editar','Facade\AdminFacade@editarEspecialidad')->name('dashboard_especialidades.editar');

    //  Modulos Cursos
    Route::get('/modulos-cursos', 'Facade\AdminFacade@verDashboardModulos')->name('dashboard_moduloscursos');
    Route::post('/modulos-cursos','Facade\AdminFacade@eliminarModulo')->name('dashboard_moduloscursos.eliminar');
    Route::get('/modulos-cursos/agregar','Facade\AdminFacade@verDashboardAgregarModulos')->name('dashboard_moduloscursos_agregar');
    Route::post('/modulos-cursos/agregar','Facade\AdminFacade@agregarModulo')->name('dashboard_moduloscursos.agregar');
    Route::get('/modulos-cursos/editar/{id_modulo}','Facade\AdminFacade@verDashboardEditarModulos')->name('dashboard_moduloscursos_editar');
    Route::post('/modulos-cursos/editar','Facade\AdminFacade@editarModulo')->name('dashboard_moduloscursos.editar');

    //  Planes
    Route::get('/planes','Facade\AdminFacade@verDashboardPlanes')->name('dashboard_planes');
    Route::post('/planes','Facade\AdminFacade@eliminarPlan')->name('dashboard_planes.eliminar');
    Route::get('/planes/agregar','Facade\AdminFacade@verDashboardAgregarPlanes')->name('dashboard_planes_agregar');
    Route::post('/planes/agregar','Facade\AdminFacade@agregarPlan')->name('dashboard_planes.agregar');
    Route::get('/planes/editar/{id_plan}','Facade\AdminFacade@verDashboardEditarPlanes')->name('dashboard_planes_editar');
    Route::post('/planes/editar','Facade\AdminFacade@editarPlan')->name('dashboard_planes.editar');

    //  Profesores
    Route::get('/profesores','Facade\AdminFacade@verDashboardProfesores')->name('dashboard_profesores');
    Route::post('/profesores','Facade\AdminFacade@eliminarProfesor')->name('dashboard_profesores.eliminar');
    Route::get('/profesores/agregar','Facade\AdminFacade@verDashboardAgregarProfesores')->name('dashboard_profesores_agregar');
    Route::post('/profesores/agregar','Facade\AdminFacade@agregarProfesor')->name('dashboard_profesores.agregar');
    Route::get('/profesores/editar/{id_profesor}','Facade\AdminFacade@verDashboardEditarProfesores')->name('dashboard_profesores_editar');
    Route::post('/profesores/editar','Facade\AdminFacade@editarProfesor')->name('dashboard_profesores.editar');


    //  Suscripciones
    Route::get('/suscripciones','Facade\AdminFacade@verDashboardSuscripciones')->name('dashboard_suscripciones');
    Route::post('/suscripciones','Facade\AdminFacade@eliminarSuscripcion')->name('dashboard_suscripciones.eliminar');
    Route::get('/suscripciones/agregar','Facade\AdminFacade@verDashboardAgregarSuscripciones')->name('dashboard_suscripciones_agregar');
    Route::post('/suscripciones/agregar','Facade\AdminFacade@agregarSuscripcion')->name('dashboard_suscripciones.agregar');
    Route::get('/suscripciones/editar/{id_suscripcion}','Facade\AdminFacade@verDashboardEditarSuscripciones')->name('dashboard_suscripciones_editar');
    Route::post('/suscripciones/editar','Facade\AdminFacade@editarSuscripcion')->name('dashboard_suscripciones.editar');

    //  Usuarios
    Route::get('/usuarios','Facade\AdminFacade@verDashboardUsuarios')->name('dashboard_usuarios');
    Route::post('/usuarios','Facade\AdminFacade@eliminarUsuario')->name('dashboard_usuarios.eliminar');
    Route::get('/usuarios/agregar','Facade\AdminFacade@verDashboardAgregarUsuarios')->name('dashboard_usuarios_agregar');
    Route::post('/usuarios/agregar','Facade\AdminFacade@agregarUsuario')->name('dashboard_usuarios.agregar');
    Route::get('/usuarios/editar/{id_usuario}','Facade\AdminFacade@verDashboardEditarUsuarios')->name('dashboard_usuarios_editar');
    Route::post('/usuarios/editar','Facade\AdminFacade@editarUsuario')->name('dashboard_usuarios.editar');

    //  Webinars
    Route::get('/webinars','Facade\AdminFacade@verDashboardWebinars')->name('dashboard_webinars');
    Route::post('/webinars','Facade\AdminFacade@eliminarWebinar')->name('dashboard_webinars.eliminar');
    Route::get('/webinars/agregar','Facade\AdminFacade@verDashboardAgregarWebinars')->name('dashboard_webinars_agregar');
    Route::post('/webinars/agregar','Facade\AdminFacade@agregarWebinar')->name('dashboard_webinars.agregar');
    Route::get('/webinars/editar/{id_webinar}','Facade\AdminFacade@verDashboardEditarWebinars')->name('dashboard_webinars_editar');
    Route::post('/webinars/editar','Facade\AdminFacade@editarWebinar')->name('dashboard_webinars.editar');

    //  Auditoria
    Route::get('/auditoria/articulos','Facade\AdminFacade@verDashboardAuditoriaArticulos')->name('dashboard_auditoria_articulos');
    Route::get('/auditoria/comentarios','Facade\AdminFacade@verDashboardAuditoriaComentarios')->name('dashboard_auditoria_comentarios');
    Route::get('/auditoria/cursos','Facade\AdminFacade@verDashboardAuditoriaCursos')->name('dashboard_auditoria_cursos');
    Route::get('/auditoria/modulos','Facade\AdminFacade@verDashboardAuditoriaModulos')->name('dashboard_auditoria_modulos');
    Route::get('/auditoria/planes','Facade\AdminFacade@verDashboardAuditoriaPlanes')->name('dashboard_auditoria_planes');
    Route::get('/auditoria/especialidades','Facade\AdminFacade@verDashboardAuditoriaEspecialidades')->name('dashboard_auditoria_especialidades');
    Route::get('/auditoria/suscripciones','Facade\AdminFacade@verDashboardAuditoriaSuscripciones')->name('dashboard_auditoria_suscripciones');
    Route::get('/auditoria/profesores','Facade\AdminFacade@verDashboardAuditoriaProfesores')->name('dashboard_auditoria_profesores');
    Route::get('/auditoria/usuarios','Facade\AdminFacade@verDashboardAuditoriaUsuarios')->name('dashboard_auditoria_usuarios');
    Route::get('/auditoria/webinars','Facade\AdminFacade@verDashboardAuditoriaWebinars')->name('dashboard_auditoria_webinars');
    Route::get('/auditoria/inscripciones','Facade\AdminFacade@verDashboardAuditoriaInscripciones')->name('dashboard_auditoria_inscripciones');

    //  Inscripciones
    Route::get('/inscripciones','Facade\AdminFacade@verDashboardInscripciones')->name('dashboard_inscripciones');
    Route::post('/inscripciones','Facade\AdminFacade@eliminarInscripcion')->name('dashboard_inscripciones.eliminar');
    Route::get('/inscripciones/agregar','Facade\AdminFacade@verDashboardAgregarInscripciones')->name('dashboard_inscripciones_agregar');
    Route::post('/inscripciones/agregar','Facade\AdminFacade@agregarInscripcion')->name('dashboard_inscripciones.agregar');

});

Route::group(['prefix' => "u", "middleware" => ['auth']], function() {

    Route::get('/','Facade\GeneralFacade@ocultarPerfilUsuario')->name('profile_not_index');

});