<?php namespace Controllers\Backend;

/**
 * This file may not be redistributed in whole or significant part.
 * ---------------- THIS IS NOT FREE SOFTWARE ----------------
 *
 *
 * @file       	Controllers/Backend/DashboardController.php
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

use Controllers\GlobalController;
use Helpers\CsrfHelper;
use Helpers\Huge\Core\HugeAuth;
use Helpers\Huge\Core\HugeSession;
use Models\Backend\AppointmentModel;
use Models\Backend\DashboardModel;
use Models\Backend\DentistModel;
use Models\Backend\PatientModel;
use Models\Backend\SettingModel;
use Models\Backend\UserModel;
use Helpers\GlobalHelper;

class DashboardController extends GlobalController
{

    public function __construct()
    {

        parent::__construct();

        HugeAuth::checkAuthentication();

        /*
        |--------------------------------------------------------------------------
        | Comestoarra Role Permission Check
        |--------------------------------------------------------------------------
        |
        | Check role based access permission, fetching data from DB, decode
        | it and check boolean object value
        |
        */
        $this->permission = UserModel::checkUserRolePermission( 'dashboard' );

    }

    public function backendDashboard()
    {
        if ( isset ( $this->permission ) ) :

            $this->data['PERMISSION']             = $this->permission;

        endif;

        $this->data['CSRF_TOKEN_NAME']            = CsrfHelper::TOKEN_NAME;
        $this->data['CSRF_TOKEN_VALUE']           = CsrfHelper::getToken();
        $this->data['CONTENT']                    = "Success Login !";
        $this->data['DASHBOARD_ACTIVE']           = "active";
        $this->data['STICKY_NAV_LOWER']           = FALSE;
        $this->data['CONTENT_FLUID']              = TRUE;
        $this->data['TIME']                       = $this->timezone->now( TIMEZONE );

        $this->data['PATIENT_COUNT']              = DashboardModel::getPatientCount();
        $this->data['DENTIST_COUNT']              = DashboardModel::getDentistCount();
        $this->data['USER_COUNT']                 = DashboardModel::getUserCount();
        $this->data['FINISHED_APPOINTMENT_COUNT'] = DashboardModel::getFinishedAppointmentCount();
        $this->data['CANCELLED_APPOINTMENT_COUNT']= DashboardModel::getCancelledAppointmentCount();
        $this->data['TODAY_APPOINTMENT_COUNT']    = DashboardModel::getTodayAppointmentCount();
        $this->data['ALL_TODAY_APPOINTMENT']      = DashboardModel::getAllTodayAppointment();
        $this->data['ALL_PATIENT']                = PatientModel::getAllPatient();
        $this->data['ALL_DENTIST']                = DentistModel::getAllDentist();
        $this->data['LOGOUT']                     = $this->app->urlFor( 'logout' );

        if ( $this->data['PROVIDER'] == 'DCAS Dentist Registration' ) :

            $this->data['DENTIST_TODAY_APPOINTMENT_COUNT']    = DashboardModel::getDentistTodayAppointmentCount( $this->data['USERNAME'] );

            $this->data['PROFILE_DENTIST']                    = DentistModel::getMyProfileOfDentist( $this->data['USERNAME'] );

        elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :

            $this->data['PATIENT_TODAY_APPOINTMENT_COUNT']    = DashboardModel::getPatientTodayAppointmentCount( $this->data['USERNAME'] );

            $this->data['ALL_PATIENT_APPOINTMENT']            = DashboardModel::getAllPatientAppointment( $this->data['USERNAME'] );

            $this->data['PROFILE_PATIENT']                    = PatientModel::getMyProfileOfPatient( $this->data['USERNAME'] );

        endif;

//        $this->data['VARDUMP']                    = print_r( $_SESSION );
        

        $this->app->render('Backend/Content/Dashboard/Index.twig', $this->data);

    }

}