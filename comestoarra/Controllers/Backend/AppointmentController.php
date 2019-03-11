<?php namespace Controllers\Backend;

/**
 * This file may not be redistributed in whole or significant part.
 * ---------------- THIS IS NOT FREE SOFTWARE ----------------
 *
 *
 * @file       	Controllers/Backend/AppointmentController.php
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
use Models\Backend\DentistModel;
use Models\Backend\AppointmentModel;
use Models\Backend\PatientModel;
use Models\Backend\UserModel;

class AppointmentController extends GlobalController
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
        $this->permission = UserModel::checkUserRolePermission( 'appointment' );

    }

    public function backendAllAppointment()
    {

        if ( isset ( $this->permission ) ) :

            $this->data['PERMISSION']             = $this->permission;

        endif;

        $this->data['CONTENT']                    = "Success Login !";
        $this->data['APPOINTMENT_ACTIVE']         = "active";
        $this->data['STICKY_NAV_LOWER']           = FALSE;
        $this->data['CONTENT_FLUID']              = TRUE;
        $this->data['time']                       = $this->timezone->now( TIMEZONE );

        $this->data['ALL_APPOINTMENT']            = AppointmentModel::getAllAppointment();
        $this->data['ALL_PATIENT']                = PatientModel::getAllPatient();
        $this->data['ALL_DENTIST']                = DentistModel::getAllDentist();
        $this->data['CSRF_TOKEN_NAME']            = CsrfHelper::TOKEN_NAME;
        $this->data['CSRF_TOKEN_VALUE']           = CsrfHelper::getToken();

        $this->data['LOGOUT']                     = $this->app->urlFor( 'logout' );


        $this->app->render('Backend/Content/Appointment/Index.twig', $this->data);

    }

    public function backendAjaxpatientAppointmentDentistTimeTable()
    {

        if ( $this->app->request()->isAjax() ) :

            $ajaxTimeTable = DentistModel::getAjaxDentistTimetable( $this->app->request()->post( 'dentist_id' ) );

            if ( $ajaxTimeTable['timetable_sunday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_sunday_end'] != "Appointment Only" ) :

                $sunday = $ajaxTimeTable['timetable_sunday_start'] . " - " . $ajaxTimeTable['timetable_sunday_end'];

            else :

                $sunday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_monday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_monday_end'] != "Appointment Only" ) :

                $monday = $ajaxTimeTable['timetable_monday_start'] . " - " . $ajaxTimeTable['timetable_monday_end'];

            else :

                $monday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_tuesday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_tuesday_end'] != "Appointment Only" ) :

                $tuesday = $ajaxTimeTable['timetable_tuesday_start'] . " - " . $ajaxTimeTable['timetable_tuesday_end'];

            else :

                $tuesday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_wednesday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_wednesday_end'] != "Appointment Only" ) :

                $wednesday = $ajaxTimeTable['timetable_wednesday_start'] . " - " . $ajaxTimeTable['timetable_wednesday_end'];

            else :

                $wednesday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_thursday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_thursday_end'] != "Appointment Only" ) :

                $thursday = $ajaxTimeTable['timetable_thursday_start'] . " - " . $ajaxTimeTable['timetable_thursday_end'];

            else :

                $thursday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_friday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_friday_end'] != "Appointment Only" ) :

                $friday = $ajaxTimeTable['timetable_friday_start'] . " - " . $ajaxTimeTable['timetable_friday_end'];

            else :

                $friday = "<span class='label label-danger'>Appointment Only</span>";

            endif;

            if ( $ajaxTimeTable['timetable_saturday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_saturday_end'] != "Appointment Only" ) :

                $saturday = $ajaxTimeTable['timetable_saturday_start'] . " - " . $ajaxTimeTable['timetable_saturday_end'];

            else :

                $saturday = "<span class='label label-danger'>Appointment Only</span>";

            endif;


            echo "<table class=\"table table-bordered table-hover\">";
            echo "<tbody>";
            echo "<tr>";
            echo "<td>Sun</td>";
            echo "<td>".$sunday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Mon</td>";
            echo "<td>".$monday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Tue</td>";
            echo "<td>".$tuesday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Wed</td>";
            echo "<td>".$wednesday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Thu</td>";
            echo "<td>".$thursday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Fri</td>";
            echo "<td>".$friday."</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>Sat</td>";
            echo "<td>".$saturday."</td>";
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";

        endif;


    }

    public function backendAjaxpatientAppointmentDentistDayTimeTable()
    {

        if ( $this->app->request()->isAjax() ) :

            $ajaxTimeTable = DentistModel::getAjaxDentistTimetable( $this->app->request()->post( 'dentist_id' ) );

            if ( $this->app->request()->post( 'day_parse' ) == "sunday" ) :

                if ( $ajaxTimeTable['timetable_sunday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_sunday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_sunday_start'] . " - " . $ajaxTimeTable['timetable_sunday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_sunday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_sunday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "monday" ) :

                if ( $ajaxTimeTable['timetable_monday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_monday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_monday_start'] . " - " . $ajaxTimeTable['timetable_monday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_monday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_monday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "tuesday" ) :

                if ( $ajaxTimeTable['timetable_tuesday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_tuesday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_tuesday_start'] . " - " . $ajaxTimeTable['timetable_tuesday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_tuesday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_tuesday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "wednesday" ) :

                if ( $ajaxTimeTable['timetable_wednesday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_wednesday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_wednesday_start'] . " - " . $ajaxTimeTable['timetable_wednesday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_wednesday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_wednesday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "thursday" ) :

                if ( $ajaxTimeTable['timetable_thursday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_thursday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_thursday_start'] . " - " . $ajaxTimeTable['timetable_thursday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_thursday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_thursday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "friday" ) :

                if ( $ajaxTimeTable['timetable_friday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_friday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_friday_start'] . " - " . $ajaxTimeTable['timetable_friday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_friday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_friday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;

            if ( $this->app->request()->post( 'day_parse' ) == "saturday" ) :

                if ( $ajaxTimeTable['timetable_saturday_start'] != "Appointment Only" && $ajaxTimeTable['timetable_saturday_end'] != "Appointment Only" ) :

                    $timeAtThatDay = $ajaxTimeTable['timetable_saturday_start'] . " - " . $ajaxTimeTable['timetable_saturday_end'];
                    $timeAtThatDayStartTime = $ajaxTimeTable['timetable_saturday_start'];
                    $timeAtThatDayEndTime = $ajaxTimeTable['timetable_saturday_end'];

                else :

                    $timeAtThatDay = "Appointment Only";
                    $timeAtThatDayStartTime = "08:00";
                    $timeAtThatDayEndTime = "21:00";

                endif;

            endif;


            if ( ! empty ( $timeAtThatDay ) ) :

                if ( $timeAtThatDay == "Appointment Only" ) :

                    echo " <p class='help-block'>Dentist time table on " . " <span class='label label-primary'>" . $this->app->request()->post( 'day_parse' ) . "</span>" . " was <span class='label label-danger'>" . $timeAtThatDay . "</span></p>";

                    if ( ! empty ( $timeAtThatDayStartTime ) && ! empty ( $timeAtThatDayEndTime ) ) :

                        $patternn = "/^0/";  // Regex

                        $integerTimeStartFormat = str_replace ( ":00", "", $timeAtThatDayStartTime );
                        $integerTimeEndFormat = str_replace ( ":00", "", $timeAtThatDayEndTime );

                        $rpltxt = "";

                        $resultPregReplaceStartTime = preg_replace ( $patternn, $rpltxt, $integerTimeStartFormat );
                        $resultPregReplaceEndTime = preg_replace ( $patternn, $rpltxt, $integerTimeEndFormat );

                        $intervalTime = $resultPregReplaceEndTime - $resultPregReplaceStartTime;

                        echo $intervalTime . " hours<br/><hr>";

                        $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":00";
                        $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":30";

                        for ( $i = $resultPregReplaceStartTime; $i < $resultPregReplaceEndTime - 1; $i++ ) :

                            $resultPregReplaceStartTime += 1;
                            $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":00";
                            $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":30";

                        endfor;

                        $tempTimeSlotAll[] = $resultPregReplaceEndTime . ":00";

                        $getDentistAvailableTimeSlotAtThatDay = AppointmentModel::getDentistAvailableTimeSlotAtThatDay( $this->app->request()->post( 'dentist_id' ), $this->app->request()->post( 'appointment_date_pick' ) );

                        foreach ( $getDentistAvailableTimeSlotAtThatDay as $slot ) :

                            $getDentistAvailableTimeSlotAtThatDayAsArray[] = $slot["appointment_time"];

                        endforeach;

                        echo "<div class='form-group'><label for='appointment_time_pick'>Appointment Time Available</label><hr>";

                        if ( ! empty ( $tempTimeSlotAll ) ) :

                            if ( ! empty ( $getDentistAvailableTimeSlotAtThatDayAsArray ) ) :

                                $resultAvailableSlotTimeDentist = array_diff( $tempTimeSlotAll, $getDentistAvailableTimeSlotAtThatDayAsArray );

                            else :

                                $resultAvailableSlotTimeDentist = $tempTimeSlotAll;

                            endif;

                            if ( ! empty ( $resultAvailableSlotTimeDentist ) ) :

                                foreach ( $resultAvailableSlotTimeDentist as $final ) :

                                    $finalArrayAfterCompare[] = $final;
                                    echo "<input type='radio' id='appointment_time_pick' name='appointment_time_pick' value='". $final ."'> " . $final . "&nbsp;&nbsp;&nbsp;";

                                endforeach;

                            endif;

                        endif;

                        echo "</div>";

                    endif;

                    
                else :

                    echo " <p class='help-block'>Dentist time table on " . " <span class='label label-primary'>" . $this->app->request()->post( 'day_parse' ) . "</span>" . " was at : <span class='label label-primary'>" . $timeAtThatDay . "</span></p>";

                    if ( ! empty ( $timeAtThatDayStartTime ) && ! empty ( $timeAtThatDayEndTime ) ) :

                        $patternn = "/^0/";  // Regex

                        $integerTimeStartFormat = str_replace ( ":00", "", $timeAtThatDayStartTime );
                        $integerTimeEndFormat = str_replace ( ":00", "", $timeAtThatDayEndTime );

                        $rpltxt = "";

                        $resultPregReplaceStartTime = preg_replace ( $patternn, $rpltxt, $integerTimeStartFormat );
                        $resultPregReplaceEndTime = preg_replace ( $patternn, $rpltxt, $integerTimeEndFormat );

                        $intervalTime = $resultPregReplaceEndTime - $resultPregReplaceStartTime;

                        echo $intervalTime . " hours<br/><hr>";

                        $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":00";
                        $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":30";

                        for ( $i = $resultPregReplaceStartTime; $i < $resultPregReplaceEndTime - 1; $i++ ) :

                            $resultPregReplaceStartTime += 1;
                            $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":00";
                            $tempTimeSlotAll[] = $resultPregReplaceStartTime . ":30";

                        endfor;

                        $tempTimeSlotAll[] = $resultPregReplaceEndTime . ":00";

                        $getDentistAvailableTimeSlotAtThatDay = AppointmentModel::getDentistAvailableTimeSlotAtThatDay( $this->app->request()->post( 'dentist_id' ), $this->app->request()->post( 'appointment_date_pick' ) );

                        foreach ( $getDentistAvailableTimeSlotAtThatDay as $slot ) :

                            $getDentistAvailableTimeSlotAtThatDayAsArray[] = $slot["appointment_time"];

                        endforeach;

                        echo "<div class='form-group'><label for='appointment_time_pick'>Appointment Time Available</label><hr>";

                        if ( ! empty ( $tempTimeSlotAll ) ) :

                            if ( ! empty ( $getDentistAvailableTimeSlotAtThatDayAsArray ) ) :

                                $resultAvailableSlotTimeDentist = array_diff( $tempTimeSlotAll, $getDentistAvailableTimeSlotAtThatDayAsArray );

                            else :

                                $resultAvailableSlotTimeDentist = $tempTimeSlotAll;

                            endif;

                            if ( ! empty ( $resultAvailableSlotTimeDentist ) ) :

                                foreach ( $resultAvailableSlotTimeDentist as $final ) :

                                    $finalArrayAfterCompare[] = $final;
                                    echo "<input type='radio' id='appointment_time_pick' name='appointment_time_pick' value='". $final ."'> " . $final . "&nbsp;&nbsp;&nbsp;";

                                endforeach;

                            endif;

                        endif;

                        echo "</div>";

                    endif;

                endif;

            endif;

        endif;

    }

    public function backendActionAddAppointmentPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::registerNewPatientAppointment(

                $this->app->request()->post( 'dentist_id' ), $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'type' ), $this->app->request()->post( 'appointment_date_pick' ), $this->app->request()->post( 'appointment_time_pick' ), $this->app->request()->post( 'notes' )

            );
            
            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );
                    
            endif;

        endif;

    }

    public function backendActionAddAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::registerNewPatientDentistAppointment(

                $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'dentist_id' ), $this->app->request()->post( 'type' ), $this->app->request()->post( 'appointment_date_pick' ), $this->app->request()->post( 'appointment_time_pick' ), $this->app->request()->post( 'notes' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'appointments' ) );

        endif;

    }

    public function backendActionQuickAddAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::registerNewPatientDentistAppointment(

                $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'dentist_id' ), $this->app->request()->post( 'type' ), $this->app->request()->post( 'appointment_date_pick' ), $this->app->request()->post( 'appointment_time_pick' ), $this->app->request()->post( 'notes' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );

        endif;

    }

    public function backendActionActivatedAppointmentPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::activatedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );
                    
            endif;

        endif;

    }

    public function backendActionActivatedAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::activatedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'appointments' ) );

        endif;

    }

    public function backendActionDashboardActivatedAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::activatedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );

        endif;

    }

    public function backendActionCancelledAppointmentPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::cancelledPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );
                    
            endif;

        endif;

    }

    public function backendActionCancelledAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::cancelledPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'appointments' ) );

        endif;

    }

    public function backendActionDashboardCancelledAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::cancelledPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );

        endif;

    }

    public function backendActionDeletedAppointmentPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::deletedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );

        endif;

    }

    public function backendActionDeletedAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::deletedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'appointments' ) );

        endif;

    }

    public function backendActionDashboardDeletedAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::deletedPatientAppointment(

                $this->app->request()->post( 'appointment_id' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );

        endif;

    }

    public function backendActionDashboardFinishedAppointmentPatientDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::finishedPatientAppointmentByDentist(

                $this->app->request()->post( 'appointment_id' ), $this->app->request()->post( 'notes_dentist' )

            );

            $this->app->response()->redirect( $this->app->urlFor( 'dashboard' ) );

        endif;

    }

    public function backendActionActivatedAppointmentPatientByDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::activatedPatientAppointmentByDentist(

                $this->app->request()->post( 'appointment_id' ), $this->app->request()->post( 'notes_dentist' )

            );
            
            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dentists' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Dentist Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionCancelledAppointmentPatientByDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::cancelledPatientAppointmentByDentist(

                $this->app->request()->post( 'appointment_id' ), $this->app->request()->post( 'notes_dentist' )

            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dentists' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Dentist Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionFinishedAppointmentPatientByDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::finishedPatientAppointmentByDentist(

                $this->app->request()->post( 'appointment_id' ), $this->app->request()->post( 'notes_dentist' )

            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dentists' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Dentist Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionDeletedAppointmentPatientByDentist()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            AppointmentModel::deletedPatientAppointmentByDentist(

                $this->app->request()->post( 'appointment_id' )

            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'dentists' ) );
            
            elseif ( $this->data['PROVIDER'] == 'DCAS Dentist Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

}