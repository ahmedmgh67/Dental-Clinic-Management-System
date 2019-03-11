<?php namespace Models\Backend;

use Helpers\LanguageHelper;

use Helpers\CsrfHelper;
use Helpers\MailHelper;
use Helpers\Huge\Core\HugeConfig;
use LiveControl\EloquentDataTable\DataTable;
use LiveControl\EloquentDataTable\VersionTransformers\Version109Transformer;
use Models\Entity\Appointment;
use Slim\Slim;

class AppointmentModel
{

    public static function getAllAppointment()
    {

        $appointment = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->leftJoin('patients', 'appointment.patient_id', '=', 'patients.patient_id')->select('appointment.appointment_id', 'appointment.dentist_id', 'appointment.patient_id', 'appointment.type', 'appointment_date', 'appointment_time', 'appointment.start', 'appointment.end', 'appointment.notes', 'appointment.notes_dentist', 'appointment.cancelled', 'appointment.finished', 'appointment.created', 'appointment.updated', 'dentists.first_name as dentist_firstname', 'dentists.last_name as dentist_lastname', 'dentists.avatar as dentist_avatar', 'dentists.specialties as dentist_specialties', 'patients.patient_id as patient_id', 'patients.first_name as patient_firstname', 'patients.last_name as patient_lastname', 'patients.avatar as patient_avatar')->get();

        return $appointment;
    }

    public static function getAllDentistAppointment( $dentist_id )
    {

        $where = [ 'appointment.dentist_id' => $dentist_id, 'appointment.cancelled' => 0 ];

        $appointment = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->leftJoin('patients', 'appointment.patient_id', '=', 'patients.patient_id')->where( $where )->select('appointment.appointment_id', 'appointment.dentist_id', 'appointment.patient_id', 'appointment.type', 'appointment_date', 'appointment_time', 'appointment.start', 'appointment.end', 'appointment.notes', 'appointment.finished', 'dentists.first_name as dentist_firstname', 'dentists.last_name as dentist_lastname', 'dentists.specialties as dentist_specialties', 'patients.patient_id as patient_id', 'patients.first_name as patient_firstname', 'patients.last_name as patient_lastname')->get();

        return $appointment;
    }

    public static function getAllDentistMyAppointment( $username )
    {

        $getId = DentistModel::getIdOfDentistAfterLogin( $username );

        if ( $getId ) :

            $where = [ 'appointment.dentist_id' => $getId, 'appointment.cancelled' => 0 ];

            $appointment = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->leftJoin('patients', 'appointment.patient_id', '=', 'patients.patient_id')->where( $where )->select('appointment.appointment_id', 'appointment.dentist_id', 'appointment.patient_id', 'appointment.type', 'appointment_date', 'appointment_time', 'appointment.start', 'appointment.end', 'appointment.notes', 'appointment.finished', 'dentists.first_name as dentist_firstname', 'dentists.last_name as dentist_lastname', 'dentists.specialties as dentist_specialties', 'patients.patient_id as patient_id', 'patients.first_name as patient_firstname', 'patients.last_name as patient_lastname')->get();

            return $appointment;

        endif;
    }

    public static function getAppointmentDataOfPatient( $patient_id ) {

        $where = [ 'patient_id' => $patient_id ];

        $query = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->where( $where )->get();

        return $query;

    }

    public static function getMyAppointmentDataOfPatient( $username ) {

        $getId = PatientModel::getIdOfPatientAfterLogin( $username );

        if ( $getId ) :

            $where = [ 'patient_id' => $getId ];

            $query = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->where( $where )->get();

            return $query;

        endif;

        return false;

    }

    public static function getDentistAvailableTimeSlotAtThatDay( $dentist_id, $appointment_date ) {

        $where = [ 'dentist_id' => $dentist_id, 'appointment_date' => $appointment_date, 'cancelled' => 0 ];

        $query = Appointment::where( $where )->select( 'appointment_time' )->get();

        return $query;

    }

    public static function registerNewPatientAppointment( $dentist_id, $patient_id, $type, $appointment_date, $appointment_time, $notes )
    {

        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        if ( $appointment_date == '' ) :

            Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_ERROR_APPOINTMENT_FORM') );
            return false;

        endif;

        $data = new Appointment();

        $data->dentist_id               = $dentist_id;
        $data->patient_id               = $patient_id;
        $data->type                     = $type;
        $data->appointment_date         = $appointment_date;
        $data->appointment_time         = $appointment_time;
        $data->start                    = $appointment_time ? $appointment_date.'T'.$appointment_time : $appointment_date;
        $data->end                      = $appointment_date;
        $data->notes                    = $notes;
        $data->created                  = date( 'Y-m-d H:i:s' );

        $data->save();

        if ( count( $data == 1 ) ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_SUCCESS_APPOINTMENT') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_ERROR_APPOINTMENT') );
        return false;
    }

    public static function registerNewPatientDentistAppointment( $patient_id, $dentist_id, $type, $appointment_date, $appointment_time, $notes )
    {

        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        if ( $appointment_date == '' ) :

            Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_ERROR_APPOINTMENT_FORM') );
            return false;

        endif;

        $data = new Appointment();

        $data->dentist_id               = $dentist_id;
        $data->patient_id               = $patient_id;
        $data->type                     = $type;
        $data->appointment_date         = $appointment_date;
        $data->appointment_time         = $appointment_time;
        $data->start                    = $appointment_time ? $appointment_date.'T'.$appointment_time : $appointment_date;
        $data->end                      = $appointment_date;
        $data->notes                    = $notes;
        $data->created                  = date( 'Y-m-d H:i:s' );

        $data->save();

        if ( count( $data == 1 ) ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_SUCCESS_APPOINTMENT') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_ERROR_APPOINTMENT') );
        return false;
    }

    public static function activatedPatientAppointment( $appointment_id )
    {
        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $activated = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->update( [
            'cancelled'    => 0,
            'updated'      => date('Y-m-d H:i:s')
        ] );

        if ( $activated ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_ACTIVATE') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_ACTIVATE') );
        return false;

    }

    public static function cancelledPatientAppointment( $appointment_id )
    {
        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $cancel = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->update( [
            'cancelled'    => 1,
            'updated'      => date('Y-m-d H:i:s')
        ] );

        if ( $cancel ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_CANCEL') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_CANCEL') );
        return false;

    }

    public static function deletedPatientAppointment( $appointment_id )
    {
        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $delete = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->delete();

        if ( $delete ) :

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_DELETE') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_DELETE') );
        return false;

    }

    public static function activatedPatientAppointmentByDentist( $appointment_id, $notes_dentist )
    {

        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $activated = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->update( [
            'notes_dentist'    => $notes_dentist,
            'cancelled'    => 0,
            'updated'      => date('Y-m-d H:i:s')
        ] );

        if ( $activated ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_ACTIVATE') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_ACTIVATE') );
        return false;

    }

    public static function cancelledPatientAppointmentByDentist( $appointment_id, $notes_dentist )
    {

        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $cancel = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->update( [
            'notes_dentist'    => $notes_dentist,
            'cancelled'    => 1,
            'updated'      => date('Y-m-d H:i:s')
        ] );

        if ( $cancel ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_CANCEL') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_CANCEL') );
        return false;

    }

    public static function finishedPatientAppointmentByDentist( $appointment_id, $notes_dentist )
    {
        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $cancel = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->update( [
            'notes_dentist'    => $notes_dentist,
            'finished'    => 1,
            'updated'      => date('Y-m-d H:i:s')
        ] );

        if ( $cancel ) :

            // TODO[rizkiwisnuaji] IMPLEMENTS EMAIL AND INBOX NOTIFICATION TO DENTIST AND PATIENT

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_CANCEL') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_CANCEL') );
        return false;

    }

    public static function deletedPatientAppointmentByDentist( $appointment_id )
    {

        if ( ! CsrfHelper::validate( Slim::getInstance()->request()->post() ) ) :

            Slim::getInstance()->flash( 'error', 'Token was not valid !' );
            return false;

        endif;

        $delete = Appointment::where( 'appointment_id', '=', $appointment_id )->take( 1 )->delete();

        if ( $delete ) :

            Slim::getInstance()->flash( 'success', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_DELETE') );
            return true;

        endif;

        Slim::getInstance()->flash( 'error', LanguageHelper::get('FEEDBACK_PATIENT_APPOINTMENT_ERROR_DELETE') );
        return false;

    }

}
