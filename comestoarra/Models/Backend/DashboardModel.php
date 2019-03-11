<?php namespace Models\Backend;

use Helpers\LanguageHelper;
use Models\Entity\Appointment;
use Models\Entity\Dentist;
use Models\Entity\Huge\User;
use Models\Entity\Patient;
use Slim\Slim;

class DashboardModel
{

    public static function getUserCount()
    {

        $users = User::all();

        return count( $users );
    }

    public static function getPatientCount()
    {

        $patient = Patient::all();

        return count( $patient );

    }

    public static function getDentistCount()
    {

        $dentist = Dentist::all();

        return count( $dentist );

    }

    public static function getTodayAppointmentCount()
    {

        $appointment = Appointment::where( 'appointment_date', '=', date( 'Y-m-d' ) )->get();

        return count( $appointment );

    }

    public static function getDentistTodayAppointmentCount( $username )
    {

        $getId = DentistModel::getIdOfDentistAfterLogin( $username );

        if ( $getId ) :

            $where = [ 'dentist_id' => $getId, 'appointment_date' => date( 'Y-m-d' ) ];

            $appointment = Appointment::where( $where )->get();

            return count( $appointment );

        endif;

        return false;

    }

    public static function getPatientTodayAppointmentCount( $username )
    {

        $getId = PatientModel::getIdOfPatientAfterLogin( $username );

        if ( $getId ) :

            $where = [ 'patient_id' => $getId, 'appointment_date' => date( 'Y-m-d' ) ];

            $appointment = Appointment::where( $where )->get();

            return count( $appointment );

        endif;

        return false;

    }

    public static function getFinishedAppointmentCount()
    {

        $appointment = Appointment::where( 'finished', '=', 1 )->get();

        return count( $appointment );

    }

    public static function getCancelledAppointmentCount()
    {

        $appointment = Appointment::where( 'cancelled', '=', 1 )->get();

        return count( $appointment );

    }

    public static function getAllTodayAppointment()
    {

        $where = [ 'appointment.appointment_date' => date( 'Y-m-d' ) ];

        $appointment = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->leftJoin('patients', 'appointment.patient_id', '=', 'patients.patient_id')->where( $where )->select('appointment.appointment_id', 'appointment.dentist_id', 'appointment.patient_id', 'appointment.type', 'appointment_date', 'appointment_time', 'appointment.start', 'appointment.end', 'appointment.notes', 'appointment.notes_dentist', 'appointment.cancelled', 'appointment.finished', 'appointment.created', 'dentists.avatar as dentist_avatar', 'dentists.first_name as dentist_firstname', 'dentists.last_name as dentist_lastname', 'dentists.specialties as dentist_specialties', 'patients.patient_id as patient_id', 'patients.avatar as patient_avatar', 'patients.first_name as patient_firstname', 'patients.last_name as patient_lastname', 'patients.birthdate as patient_birthdate')->orderBy('appointment.appointment_time', 'asc')->get();

        return $appointment;
    }

    public static function getAllPatientAppointment( $username )
    {

        $getId = PatientModel::getIdOfPatientAfterLogin( $username );

        if ( $getId ) :

            $where = [ 'appointment.patient_id' => $getId ];

            $appointment = Appointment::leftJoin('dentists', 'appointment.dentist_id', '=', 'dentists.dentist_id')->leftJoin('patients', 'appointment.patient_id', '=', 'patients.patient_id')->where( $where )->select('appointment.appointment_id', 'appointment.dentist_id', 'appointment.patient_id', 'appointment.type', 'appointment_date', 'appointment_time', 'appointment.start', 'appointment.end', 'appointment.notes', 'appointment.notes_dentist', 'appointment.cancelled', 'appointment.finished', 'appointment.created', 'dentists.avatar as dentist_avatar', 'dentists.first_name as dentist_firstname', 'dentists.last_name as dentist_lastname', 'dentists.specialties as dentist_specialties', 'patients.patient_id as patient_id', 'patients.avatar as patient_avatar', 'patients.first_name as patient_firstname', 'patients.last_name as patient_lastname', 'patients.birthdate as patient_birthdate')->orderBy('appointment.appointment_time', 'asc')->get();

            return $appointment;

        endif;

        return false;

    }

}
