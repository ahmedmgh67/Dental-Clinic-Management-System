<?php

/**
 * This file may not be redistributed in whole or significant part.
 * ---------------- THIS IS NOT FREE SOFTWARE ----------------
 *
 *
 * @file       	Core/Route.php
 * @package     Bootstrap Codecanyon Products
 * @company     Comestoarra Labs <labs@comestoarra.com>
 * @programmer  Rizki Wisnuaji, drg., M.Kom. <rizkiwisnuaji@comestoarra.com>
 * @copyright   2016 Comestoarra Labs. All Rights Reserved.
 * @license     http://codecanyon.net/licenses
 * @version     Release: @1.1@
 * @framework   http://slimframework.com
 *
 *
 * ---------------- THIS IS NOT FREE SOFTWARE ----------------
 * This file may not be redistributed in whole or significant part.
**/

/*
 *---------------------------------------------------------------
 * FRONTEND ROUTES
 *---------------------------------------------------------------
 */
$app->group( '', function() use ( $app ) {

    $app->get( '/', 'Controllers\Frontend\FrontendController:frontendHome' )->name( 'homepage' );

});

/*
 *---------------------------------------------------------------
 * BACKEND ROUTES
 *---------------------------------------------------------------
 */
$app->group( '/manage', function() use ( $app ) {

    $app->get( '/', 'Controllers\Backend\AuthController:backendAuthorized' )->name( 'manage' );

    $app->get( '/login', 'Controllers\Backend\AuthController:backendLogin' )->name( 'login' );

    $app->post( '/login/action', 'Controllers\Backend\AuthController:backendActionLogin' )->name( 'loginAction' );

    $app->map( '/login/verifypasswordreset/(:username)/(:hash)', 'Controllers\Backend\AuthController:backendPasswordReset' )->via( 'GET', 'POST' )->name( 'loginPasswordReset' );

    $app->post( '/login/setpassword', 'Controllers\Backend\AuthController:backendActionPasswordReset' )->name( 'resetPasswordAction' );

    $app->map( '/login/verify/(:id)/(:activation)', 'Controllers\Backend\AuthController:backendActionSignupVerify' )->via( 'GET', 'POST' )->name( 'loginVerify' );

    $app->map( '/login/cookie', 'Controllers\Backend\AuthController:backendLoginWithCookie' )->via( 'GET', 'POST' )->name( 'loginCookie' );

    $app->get( '/signup', 'Controllers\Backend\AuthController:backendSignup' )->name( 'signup' );

    $app->post( '/signup', 'Controllers\Backend\AuthController:backendActionSignup' )->name( 'signupAction' );

    $app->get( '/forgot', 'Controllers\Backend\AuthController:backendForgot' )->name( 'forgot' );

    $app->post( '/forgot', 'Controllers\Backend\AuthController:backendActionForgot' )->name( 'forgotAction' );

    $app->get( '/logout', 'Controllers\Backend\AuthController:backendLogout' )->name( 'logout' );

    $app->get( '/dashboard', 'Controllers\Backend\DashboardController:backendDashboard' )->name( 'dashboard' );

    $app->get( '/profile', 'Controllers\Backend\UserController:backendProfile' )->name( 'myProfile' );

    $app->post( '/profile/action', 'Controllers\Backend\UserController:backendActionUpdateProfile' )->name( 'updateProfileAction' );

    $app->post( '/profile/change-password', 'Controllers\Backend\UserController:backendActionChangePassword' )->name( 'changePasswordAction' );

    $app->post( '/profile/change-email', 'Controllers\Backend\UserController:backendActionChangeEmail' )->name( 'changeEmailAction' );

    $app->post( '/profile/change-username', 'Controllers\Backend\UserController:backendActionChangeUsername' )->name( 'changeUsernameAction' );

    $app->post( '/profile/upload-avatar', 'Controllers\Backend\UserController:backendActionUploadAvatar' )->name( 'uploadAvatarAction' );

    $app->group( '/users', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\UserController:backendAllUser' )->name( 'users' );

        $app->map( '/datatable/all', 'Controllers\Backend\UserController:backendUserDatatable' )->via( 'POST' )->name( 'userDataTable' );

        $app->post( '/add-user/action', 'Controllers\Backend\UserController:backendActionAddUser' )->name( 'addUserAction' );

        $app->post( '/add-role/action', 'Controllers\Backend\UserController:backendActionAddRole' )->name( 'addRoleAction' );

        $app->post( '/suspend/action', 'Controllers\Backend\UserController:backendActionSuspendUser' )->name( 'suspendUserAction' );

        $app->post( '/ban/action', 'Controllers\Backend\UserController:backendActionBanUser' )->name( 'banUserAction' );

        $app->post( '/root/action', 'Controllers\Backend\UserController:backendActionRootUser' )->name( 'rootUserAction' );

        $app->post( '/role/action', 'Controllers\Backend\UserController:backendActionRoleUser' )->name( 'roleUserAction' );

        $app->post( '/update-role', 'Controllers\Backend\UserController:backendUpdateRole' )->name( 'updateRoleAction' );

        $app->post( '/delete-role', 'Controllers\Backend\UserController:backendDeleteRole' )->name( 'deleteRoleAction' );

        $app->get( '/(:id)', 'Controllers\Backend\UserController:backendUserProfile' );

    });

    $app->group( '/patient', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\PatientController:backendAllPatient' )->name( 'patients' );

        $app->post( '/add-patient/action', 'Controllers\Backend\PatientController:backendActionAddPatient' )->name( 'addPatientAction' );

        $app->post( '/add-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionAddAppointmentPatient' )->name( 'addPatientAppointmentAction' );

        $app->post( '/add-patient-dentist-appointment/action', 'Controllers\Backend\AppointmentController:backendActionAddAppointmentPatientDentist' )->name( 'addPatientDentistAppointmentAction' );

        $app->post( '/quick-add-patient-dentist-appointment/action', 'Controllers\Backend\AppointmentController:backendActionQuickAddAppointmentPatientDentist' )->name( 'quickAddPatientDentistAppointmentAction' );

        $app->post( '/activated-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionActivatedAppointmentPatient' )->name( 'activatedPatientAppointmentAction' );

        $app->post( '/cancelled-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionCancelledAppointmentPatient' )->name( 'cancelledPatientAppointmentAction' );

        $app->post( '/deleted-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDeletedAppointmentPatient' )->name( 'deletedPatientAppointmentAction' );

        $app->post( '/ajax-dentist-time-table/action', 'Controllers\Backend\AppointmentController:backendAjaxpatientAppointmentDentistTimeTable' )->name( 'patientAppointmentDentistTimeTable' );

        $app->post( '/ajax-dentist-day-selected/action', 'Controllers\Backend\AppointmentController:backendAjaxpatientAppointmentDentistDayTimeTable' )->name( 'patientAppointmentDentistDayTimeTable' );

        $app->post( '/activated-patient-dentist-appointment/action', 'Controllers\Backend\AppointmentController:backendActionActivatedAppointmentPatientDentist' )->name( 'activatedPatientDentistAppointmentAction' );

        $app->post( '/cancelled-patient-dentist-appointment/action', 'Controllers\Backend\AppointmentController:backendActionCancelledAppointmentPatientDentist' )->name( 'cancelledPatientDentistAppointmentAction' );

        $app->post( '/deleted-patient-dentist-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDeletedAppointmentPatientDentist' )->name( 'deletedPatientDentistAppointmentAction' );

        $app->post( '/finished-patient-dentist-dashboard-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDashboardFinishedAppointmentPatientDentist' )->name( 'finishedPatientDentistAppointmentDashboardAction' );

        $app->post( '/activated-patient-dentist-dashboard-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDashboardActivatedAppointmentPatientDentist' )->name( 'activatedPatientDentistAppointmentDashboardAction' );

        $app->post( '/cancelled-patient-dentist-dashboard-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDashboardCancelledAppointmentPatientDentist' )->name( 'cancelledPatientDentistAppointmentDashboardAction' );

        $app->post( '/deleted-patient-dentist-dashboard-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDashboardDeletedAppointmentPatientDentist' )->name( 'deletedPatientDentistAppointmentDashboardAction' );

        $app->post( '/add-auth/action', 'Controllers\Backend\PatientController:backendActionAddAuthPatient' )->name( 'addPatientAuthAction' );

        $app->get( '/(:id)', 'Controllers\Backend\PatientController:backendPatientProfile' );

        $app->post( '/profile/action', 'Controllers\Backend\PatientController:backendActionUpdateProfile' )->name( 'updatePatientProfileAction' );

        $app->post( '/profile/upload-avatar', 'Controllers\Backend\PatientController:backendActionUploadAvatar' )->name( 'uploadPatientAvatarAction' );

        $app->post( '/profile/change-password', 'Controllers\Backend\PatientController:backendActionChangePassword' )->name( 'changePatientPasswordAction' );

        $app->post( '/profile/change-email', 'Controllers\Backend\PatientController:backendActionChangeEmail' )->name( 'changePatientEmailAction' );

        $app->post( '/profile/change-username', 'Controllers\Backend\PatientController:backendActionChangeUsername' )->name( 'changePatientUsernameAction' );

    });

    $app->group( '/dentist', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\DentistController:backendAllDentist' )->name( 'dentists' );

        $app->post( '/add-dentist/action', 'Controllers\Backend\DentistController:backendActionAddDentist' )->name( 'addDentistAction' );

        $app->post( '/add-auth/action', 'Controllers\Backend\DentistController:backendActionAddAuthDentist' )->name( 'addDentistAuthAction' );

        $app->post( '/timetable/action', 'Controllers\Backend\DentistController:backendActionDentistTimeTable' )->name( 'timeTableAction' );

        $app->get( '/(:id)', 'Controllers\Backend\DentistController:backendDentistProfile' );

        $app->post( '/profile/action', 'Controllers\Backend\DentistController:backendActionUpdateProfile' )->name( 'updateDentistProfileAction' );

        $app->post( '/profile/upload-avatar', 'Controllers\Backend\DentistController:backendActionUploadAvatar' )->name( 'uploadDentistAvatarAction' );

        $app->post( '/profile/change-password', 'Controllers\Backend\DentistController:backendActionChangePassword' )->name( 'changeDentistPasswordAction' );

        $app->post( '/profile/change-email', 'Controllers\Backend\DentistController:backendActionChangeEmail' )->name( 'changeDentistEmailAction' );

        $app->post( '/profile/change-username', 'Controllers\Backend\DentistController:backendActionChangeUsername' )->name( 'changeDentistUsernameAction' );

        $app->post( '/profile/update-timetable', 'Controllers\Backend\DentistController:backendActionUpdateTimetable' )->name( 'updateDentistTimetableAction' );

        $app->post( '/activated-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionActivatedAppointmentPatientByDentist' )->name( 'activatedPatientAppointmentByDentistAction' );

        $app->post( '/cancelled-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionCancelledAppointmentPatientByDentist' )->name( 'cancelledPatientAppointmentByDentistAction' );

        $app->post( '/finished-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionFinishedAppointmentPatientByDentist' )->name( 'finishedPatientAppointmentByDentistAction' );

        $app->post( '/deleted-patient-appointment/action', 'Controllers\Backend\AppointmentController:backendActionDeletedAppointmentPatientByDentist' )->name( 'deletedPatientAppointmentByDentistAction' );

    });

    $app->group( '/appointment', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\AppointmentController:backendAllAppointment' )->name( 'appointments' );

    });

    $app->group( '/assets', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\AssetsmanagerController:backendAssetManager' )->name( 'assetsmanager' );
        
    });

    $app->group( '/calendar', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\CalendarController:backendCalendarManager' )->name( 'calendar' );

    });

    $app->group( '/mailbox', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\MailboxController:backendMailbox' )->name( 'mailbox' );

        $app->post( '/', 'Controllers\Backend\MailboxController:backendComposeMail' )->name( 'composeMessage' );

        $app->post( '/compose-message-from-profile', 'Controllers\Backend\MailboxController:backendComposeMailFromProfile' )->name( 'composeMessageFromProfileAction' );

        $app->post( '/delete-by-sender', 'Controllers\Backend\MailboxController:backendDeleteMailBySender' )->name( 'deleteMailBySender' );

        $app->post( '/delete-by-receiver', 'Controllers\Backend\MailboxController:backendDeleteMailByReceiver' )->name( 'deleteMailByReceiver' );

        $app->post( '/mark-as-read', 'Controllers\Backend\MailboxController:backendMarkAsRead' )->name( 'markAsRead' );

        $app->post( '/mark-as-unread', 'Controllers\Backend\MailboxController:backendMarkAsUnread' )->name( 'markAsUnread' );

        $app->post( '/mark-as-archived', 'Controllers\Backend\MailboxController:backendMarkAsArchived' )->name( 'markAsArchived' );

        $app->post( '/mark-as-unarchived', 'Controllers\Backend\MailboxController:backendMarkAsUnarchived' )->name( 'markAsUnarchived' );

    });

    $app->group( '/setting', function() use ( $app ) {

        $app->get( '/', 'Controllers\Backend\SettingController:backendGlobalSetting' )->name( 'globalSetting' );

        $app->post( '/setting/update-global', 'Controllers\Backend\SettingController:backendActionUpdateGlobalSetting' )->name( 'updateGlobalSettingAction' );

        $app->post( '/setting/update-mail', 'Controllers\Backend\SettingController:backendActionUpdateMailSetting' )->name( 'updateMailSettingAction' );

        $app->post( '/setting/update-logo', 'Controllers\Backend\SettingController:backendActionUpdateGlobalLogo' )->name( 'updateGlobalLogoAction' );

        $app->post( '/setting/update-favicon', 'Controllers\Backend\SettingController:backendActionUpdateGlobalFavicon' )->name( 'updateGlobalFaviconAction' );

        $app->get( '/audit', 'Controllers\Backend\SettingController:backendAllAudit' )->name( 'allAuditTrails' );

        $app->map( '/datatable/all', 'Controllers\Backend\SettingController:backendAuditDatatable' )->via( 'POST' )->name( 'auditDataTable' );

        $app->post( '/trim-data', 'Controllers\Backend\SettingController:backendTrimAllAudit' )->name( 'trimLogs' );

        $app->post( '/delete-data', 'Controllers\Backend\SettingController:backendDeleteAllAudit' )->name( 'deleteLogs' );

    });

});