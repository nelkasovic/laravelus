<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * View routes for testing.
 */
//Route::view('/', 'dashboard');
//Route::view('/blank', 'blank');
//Route::view('/plugin', 'plugin');
//Route::view('/persons', 'persons');
//Route::view('/examples/plugin', 'examples.plugin');

/**
 * Enable language middleware.
 */
Route::group(['middleware' => 'language'], function () {
    Route::get('/', 'HomeController@dashboard')->name('dashboard');
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/auth/login', 'Auth\LoginController@login')->name('login');
    Route::post('/auth/login', 'Auth\LoginController@authenticate')->name('authenticate');
    Route::post('/auth/register', 'Auth\LoginController@register')->name('register');

    // Email related routes
    Route::get('mail/send', 'MailController@send');
    Route::get('mail/send/basic', 'MailController@basic');
    Route::get('mail/send/html', 'MailController@html');
    Route::get('mail/send/attachment', 'MailController@attachment');
    Route::get('mail/send/event', 'MailController@eventCreated');
    Route::get('mail/send/event/status', 'MailController@eventStatusChanged');
    Route::get('mail/send/userforperson', 'MailController@userForPersonCreated');
    Route::get('event/print', 'EventController@print')->name('event.print');
});

Route::group(['middleware' => 'language', 'auth'], function () {
    //Route::get('orders/print/{order}', 'OrderController@print')->name('orders.print');
    //Route::get('templates/measure', 'MeasureController@index')->name('templates.measure');

    Route::get('/auth/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/auth/passwords/reset', 'Auth\LoginController@password')->name('password.request');
    Route::get('users/{id}/reset', 'UserController@reset')->name('users.reset');

    // Route::get('measures/person/{person_id}', 'MeasureController@person')->name('measures.person');
    //Route::get('measures/{id}/duplicate', 'MeasureController@duplicate')->name('measures.duplicate');
    Route::get('users/{id}/roles', 'UserController@roles')->name('users.roles');
    Route::patch('users/{id}/password', 'UserController@password')->name('users.password');

    // Person actions
    Route::any('persons/{pid}/user', 'PersonController@user')->name('persons.user');
    Route::any('persons/{pid}/approve', 'PersonController@approve')->name('persons.approve');
    Route::any('persons/{pid}/disapprove', 'PersonController@disapprove')->name('persons.disapprove');
    
    // Exclusions
    Route::any('persons/{pid}/exclusion', 'ExclusionController@person')->name('persons.exclusion');
    Route::any('periods/{pid}/exclusion', 'ExclusionController@period')->name('periods.exclusion');
    Route::any('rooms/{rid}/exclusion', 'ExclusionController@room')->name('room.exclusion');
    Route::any('persons/exclusions', 'ExclusionController@index')->name('persons.exclusions');

    // Assign person to course
    Route::get('courses/persons/{pid?}', 'CoursePersonController@index')->name('courseperson.index');
    Route::get('courses/persons/{pid}/attach', 'CoursePersonController@attach')->name('courseperson.attach');
    Route::get('courses/persons/{pid}/detach/{cid}', 'CoursePersonController@detach')->name('courseperson.detach');

    // Assign person to study
    Route::get('studies/persons/{sid?}', 'StudyPersonController@index')->name('studyperson.index');
    Route::get('studies/{sid}/persons/attach', 'StudyPersonController@attach')->name('studyperson.attach');
    Route::get('studies/{sid}/persons/{pid}/detach', 'StudyPersonController@detach')->name('studyperson.detach');

    // Assign room to course
    Route::get('courses/rooms/{cid?}', 'CourseRoomController@index')->name('courseroom.index');
    Route::get('courses/rooms/{cid}/attach', 'CourseRoomController@attach')->name('courseroom.attach');
    Route::get('courses/rooms/{cid}/detach/{rid}', 'CourseRoomController@detach')->name('courseroom.detach');
    

    // Assign group to study
    Route::get('studies/groups/{sid?}', 'StudyGroupController@index')->name('studygroup.index');
    Route::get('studies/{sid}/groups/attach', 'StudyGroupController@attach')->name('studygroup.attach');
    Route::get('studies/{sid}/groups/{gid}/detach', 'StudyGroupController@detach')->name('studygroup.detach');

    // Assign course to study
    Route::any('studies/courses/{sid?}', 'StudyCourseController@index')->name('studycourse.index');
    Route::any('studies/courses/{sid}/attach', 'StudyCourseController@attach')->name('studycourse.attach');
    Route::any('studies/courses/{sid}/detach/{cid}', 'StudyCourseController@detach')->name('studycourse.detach');

    // Study
    Route::any('study/{sid}/status', 'StudyController@status')->name('study.status');
    Route::any('study/{sid}/more/{cid}', 'StudyController@more')->name('studycourse.more');
    Route::any('study/{sid}/less/{cid}', 'StudyController@less')->name('studycourse.less');
    Route::any('study/{sid}/coursedays/{cid}/{reset?}', 'StudyController@coursedays')->name('studycourse.coursedays');
    Route::any('study/{sid}/weekdays/{reset?}', 'StudyController@weekdays')->name('studycourse.weekdays');

    Route::any('study/{sid}/day/{cid}/check', 'StudyController@dayCheck')->name('studycourse.dayCheck');
    Route::any('study/{sid}/replicate', 'StudyController@replicate')->name('study.replicate');

    // Assign asset to room
    Route::get('rooms/assets/{rid?}', 'RoomAssetController@index')->name('roomasset.index');
    Route::get('rooms/assets/{rid}/attach', 'RoomAssetController@attach')->name('roomasset.attach');
    Route::get('rooms/assets/{rid}/detach/{aid}', 'RoomAssetController@detach')->name('roomasset.detach');

    // Assign person to event
    Route::get('events/persons/{eid?}', 'EventPersonController@index')->name('eventperson.index');
    Route::get('events/persons/{eid}/attach', 'EventPersonController@attach')->name('eventperson.attach');
    Route::get('events/persons/{eid}/detach/{pid}', 'EventPersonController@detach')->name('eventperson.detach');

    // Assign skill to person
    Route::get('persons/skills/{pid?}', 'PersonSkillController@index')->name('personskill.index');
    Route::get('persons/skills/{pid}/attach/{cid}', 'PersonSkillController@attach')->name('personskill.attach');
    Route::get('persons/skills/{pid}/detach/{sid}/{cid?}', 'PersonSkillController@detach')->name('personskill.detach');

    // Assign skill to course
    Route::get('courses/skills/{cid?}', 'CourseSkillController@index')->name('courseskill.index');
    Route::get('courses/skills/{cid}/attach', 'CourseSkillController@attach')->name('courseskill.attach');
    Route::get('courses/skills/{cid}/detach/{sid}', 'CourseSkillController@detach')->name('courseskill.detach');

    // Assign objective to course
    Route::get('courses/objectives/{cid?}', 'CourseObjectiveController@index')->name('courseobjective.index');
    Route::get('courses/objectives/{cid}/attach', 'CourseObjectiveController@attach')->name('courseobjective.attach');
    Route::get('courses/objectives/{cid}/detach/{oid}', 'CourseObjectiveController@detach')->name('courseobjective.detach');

    // Event handling
    Route::any('events/invite', 'EventController@invite')->name('events.invite');
    Route::any('events/{eid}/apply/{pid?}', 'EventController@apply')->name('events.apply');
    Route::any('events/{eid}/complete/{pid?}/{status?}', 'EventController@complete')->name('events.complete');
    Route::any('events/{eid}/decline/{pid?}', 'EventController@decline')->name('events.decline');
    Route::any('events/{eid}/topics', 'EventController@topics')->name('events.topics');
    Route::any('events/{pid}/assign/{eid}', 'EventController@assign')->name('events.assign');
    Route::any('events/{pid}/reassign/{eid}', 'EventController@reassign')->name('events.reassign');
    Route::any('events/{pid}/confirm/{eid}', 'EventController@confirm')->name('events.confirm');
    Route::any('events/tender', 'EventController@tender')->name('events.tender');
    Route::any('events/mytender', 'EventController@myTender')->name('events.mytender');
    Route::get('event/{file}/download', 'EventController@download')->name('event.download');
    Route::any('events/plan/{pid?}/{sid?}/{cid?}/{rid?}', 'EventController@plan')->name('events.plan');
    Route::any('events/propose', 'EventController@propose')->name('events.propose');
    Route::any('events/accept', 'EventController@accept')->name('events.accept');
    Route::any('events/{eid}/grade/{pid}', 'EventController@grade')->name('events.grade');
    Route::any('events/{eid}/participants/pdf', 'EventController@createParticipantsSheet')->name('events.participants');

    // Events and groups
    Route::any('events/groups/{sid?}/{eid?}', 'EventGroupController@index')->name('eventgroups.index');
    Route::any('events/groups/{sid}/study/{eid}/attach', 'EventGroupController@attach')->name('eventgroups.attach');
    Route::any('events/groups/{sid}/study/{eid}/detach/{gid}', 'EventGroupController@detach')->name('eventgroups.detach');

    // Groups and persons
    Route::any('groups/persons/{gid?}/{sid?}', 'GroupPersonController@index')->name('groupperson.index');
    Route::any('groups/{gid}/study/{sid}/person/attach', 'GroupPersonController@attach')->name('groupperson.attach');
    Route::any('groups/{gid}/study/{sid}/person/{pid}/detach', 'GroupPersonController@detach')->name('groupperson.detach');

    // Group actions
    Route::any('groups/{gid}/participants', 'GroupController@participants')->name('groups.participants');

    // Grading
    Route::any('grades/{eid}/grade/{pid}', 'GradeController@grade')->name('grades.grade');

    // File handling
    Route::any('files/{file}/download', 'FileController@download')->name('files.download');
    Route::any('files/downloadmany', 'FileController@downloadMany')->name('files.downloadmany');

    // Clients
    Route::delete('tenants/{cid}/enable', 'TenantController@enable')->name('tenants.enable');
    Route::delete('tenants/{cid}/disable', 'TenantController@disable')->name('tenants.disable');

    // Assets
    Route::any('assets/{aid}/upvote', 'AssetController@upvote')->name('assets.upvote');
    Route::any('assets/{aid}/downvote', 'AssetController@downvote')->name('assets.downvote');

    // Rooms
    Route::any('rooms/{rid}/upvote', 'RoomController@upvote')->name('rooms.upvote');
    Route::any('rooms/{rid}/downvote', 'RoomController@downvote')->name('rooms.downvote');

    // Units
    Route::any('units/{uid}/upvote', 'UnitController@upvote')->name('units.upvote');
    Route::any('units/{uid}/downvote', 'UnitController@downvote')->name('units.downvote');
    Route::any('units/{uid}/task', 'UnitController@task')->name('units.task');
    Route::any('units/{uid}/method/{mid}', 'UnitController@method')->name('units.method');

    // Methods
    Route::any('methods/{mid}/upvote', 'MethodController@upvote')->name('methods.upvote');
    Route::any('methods/{mid}/downvote', 'MethodController@downvote')->name('methods.downvote');

    // Script topicis
    Route::any('scripts/{sid}/topic/{tid}/up', 'ScriptController@topicUp')->name('scripts.topicup');
    Route::any('scripts/{sid}/topic/{tid}/down', 'ScriptController@topicDown')->name('scripts.topicdown');

    // Script units
    Route::any('scripts/{sid}/topic/{tid}/highlight', 'ScriptController@topicHighlight')->name('scripts.topichighlight');
    Route::any('scripts/{tid}/unit/{uid}/up', 'ScriptController@unitUp')->name('scripts.unitup');
    Route::any('scripts/{tid}/unit/{uid}/down', 'ScriptController@unitDown')->name('scripts.unitdown');
    Route::any('scripts/{tid}/unit/reorder', 'ScriptController@unitReorder')->name('scripts.unitreorder');
    Route::any('scripts/{tid}/replicate/{uid}', 'UnitController@replicate')->name('units.replicate');
    Route::any('scripts/{tid}/remove/{uid}', 'UnitController@remove')->name('units.remove');

    // Locations
    Route::any('location/{lid}/default', 'LocationController@default')->name('location.default');
    Route::any('location/{id}/person/{pid?}', 'LocationController@person')->name('location.person');
    Route::any('location/{id}/client/{cid?}', 'LocationController@client')->name('location.client');
    Route::any('location/{id}/room/{rid?}', 'LocationController@room')->name('location.room');

    // Occurrence actions
    Route::any('occurrences/{oid}/person/{pid}/present', 'OccurrenceController@present')->name('occurrences.present');
    Route::any('occurrences/{oid}/person/{pid}/absent', 'OccurrenceController@absent')->name('occurrences.absent');

    // Posts
    Route::any('posts/{pid}/reply', 'PostController@reply')->name('posts.reply');
    Route::any('posts/{pid}/upvote', 'PostController@upvote')->name('posts.upvote');
    Route::any('posts/{pid}/downvote', 'PostController@downvote')->name('posts.downvote');

    // Types
    Route::any('types/{tid}/create/category', 'CategoryController@create')->name('categories.create');

    // Groups
    Route::any('study/{sid}/course/{cid}/groups', 'CourseController@groups')->name('courses.groups');
    Route::any('study/{sid}/groups', 'StudyController@groups')->name('studies.groups');
    Route::any('study/{sid}/persons', 'StudyController@persons')->name('studies.persons');

    // Periods
    Route::any('periods/{pid}/enable', 'PeriodController@enable')->name('periods.enable');
    Route::any('periods/{pid}/disable', 'PeriodController@disable')->name('periods.disable');
    Route::any('periods/{pid}/global', 'PeriodController@global')->name('periods.global');
    Route::any('periods/{source}/copy/{target?}', 'PeriodController@copy')->name('periods.copy');
    
    // Import routes
    Route::get('imports', 'ImportController@index');
    Route::get('imports/persons', 'ImportController@persons');
    Route::get('imports/create', 'ImportController@create');
    Route::get('imports/start', 'ImportController@start');
    Route::any('imports/destroy/{id}', 'ImportController@destroy');

    // Export routes
    Route::get('persons/excel', 'ExportController@persons');
    Route::get('students/excel', 'ExportController@students');
    Route::get('users/excel', 'ExportController@users');
    Route::get('tenants/excel', 'ExportController@clients');
    Route::get('skills/excel', 'ExportController@skills');
    Route::get('scripts/excel', 'ExportController@scripts');
    Route::get('events/excel', 'ExportController@events');
    Route::get('objectives/excel', 'ExportController@objectives');
    Route::get('methods/excel', 'ExportController@methods');
    Route::get('groups/excel', 'ExportController@groups');
    Route::get('studies/excel', 'ExportController@studies');
    Route::get('courses/excel', 'ExportController@courses');
    Route::get('rooms/excel', 'ExportController@rooms');
    Route::get('assets/excel', 'ExportController@assets');
    Route::get('exclusions/excel', 'ExportController@exclusions');
    Route::get('periods/excel', 'ExportController@periods');
    Route::get('activities/excel', 'ExportController@activities');
    Route::get('files/excel', 'ExportController@files');
    Route::get('grades/excel', 'ExportController@grades');

    // Upload
    Route::get('image/upload', 'UploadController@create');
    Route::post('image/upload/store', 'UploadController@store');
    Route::post('image/destroy', 'UploadController@destroy');


    // Resource routes
    Route::resource('tenants', 'TenantController');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('skills', 'SkillController');
    Route::resource('persons', 'PersonController');
    Route::resource('components', 'ComponentController');
    Route::resource('objectives', 'ObjectiveController');
    Route::resource('events', 'EventController');
    Route::resource('occurrences', 'OccurrenceController');
    Route::resource('topics', 'TopicController');
    Route::resource('types', 'TypeController');
    Route::resource('categories', 'CategoryController');
    Route::resource('units', 'UnitController');
    Route::resource('scripts', 'ScriptController');
    Route::resource('studies', 'StudyController');
    Route::resource('courses', 'CourseController');
    Route::resource('methods', 'MethodController');
    Route::resource('files', 'FileController');
    Route::resource('rooms', 'RoomController');
    Route::resource('assets', 'AssetController');
    Route::resource('activities', 'ActivityController');
    Route::resource('locations', 'LocationController');
    Route::resource('grades', 'GradeController');
    Route::resource('groups', 'GroupController');
    Route::resource('periods', 'PeriodController');
    Route::resource('exclusions', 'ExclusionController');
    //Route::resource('settings', 'SettingController');
    Route::resource('posts', 'PostController');

    /**
     * AJAX Routes
     */
    Route::get('xhr/activities', 'ActivityController@index')->name('xhr.activities');
    Route::get('xhr/methods', 'MethodController@index')->name('xhr.methods');
    Route::get('xhr/files', 'FileController@index')->name('xhr.files');
    Route::get('xhr/periods', 'PeriodController@index')->name('xhr.periods');
    Route::get('xhr/exclusions', 'ExclusionController@index')->name('xhr.exclusions');
    Route::get('xhr/imports', 'ImportController@index')->name('xhr.imports');
    Route::get('xhr/events', 'EventController@index')->name('xhr.events');
    Route::get('xhr/grades', 'GradeController@index')->name('xhr.grades');
    Route::get('xhr/persons', 'PersonController@index')->name('xhr.persons');
    Route::get('xhr/courses', 'CourseController@index')->name('xhr.courses');
    Route::get('xhr/rooms', 'RoomController@index')->name('xhr.rooms');
    Route::get('xhr/assets', 'AssetController@index')->name('xhr.assets');
    Route::get('xhr/studies', 'StudyController@index')->name('xhr.studies');
    Route::get('xhr/groups', 'GroupController@index')->name('xhr.groups');
    Route::get('xhr/objectives', 'ObjectiveController@index')->name('xhr.objectives');
    Route::get('xhr/skills', 'SkillController@index')->name('xhr.skills');
    Route::get('xhr/scripts', 'ScriptController@index')->name('xhr.scripts');
    
    
    /**
     * Settings routes
     */
    Route::get('settings', 'SettingController@index')->name('settings.index');
    Route::any('settings/sync', 'SettingController@sync')->name('settings.sync');
    Route::any('settings/defaults', 'SettingController@defaults')->name('settings.defaults');

    /**
     * Some old ones?
     */
    Route::get('studycourses', 'StudyController@courses')->name('studycourses');
    Route::get('studydays', 'StudyController@getStudyDays')->name('studydays');
    Route::get('coursedays', 'StudyController@getCourseDays')->name('coursedays');
});

/*

Verb          Path                        Action  Route Name
GET           /persons                      index   persons.index
GET           /persons/create               create  persons.create
POST          /persons                      store   persons.store
GET           /persons/{user}               show    persons.show
GET           /persons/{user}/edit          edit    persons.edit
PUT|PATCH     /persons/{user}               update  persons.update
DELETE        /persons/{user}               destroy persons.destroy

https://stackoverflow.com/questions/23505875/laravel-routeresource-vs-routecontroller

*/
