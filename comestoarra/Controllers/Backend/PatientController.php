<?php namespace Controllers\Backend;

/**
 * This file may not be redistributed in whole or significant part.
 * ---------------- THIS IS NOT FREE SOFTWARE ----------------
 *
 *
 * @file       	Controllers/Backend/PatientController.php
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
use Models\Backend\AppointmentModel;
use Models\Backend\DentistModel;
use Models\Backend\PatientModel;
use Models\Backend\RegistrationModel;
use Models\Backend\UserModel;
use Models\Entity\Patient;

class PatientController extends GlobalController
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
        $this->permission = UserModel::checkUserRolePermission( 'patient' );

    }

    public function backendAllPatient()
    {
        if ( isset ( $this->permission ) ) :

            $this->data['PERMISSION']             = $this->permission;

        endif;

        $this->data['CSRF_TOKEN_NAME']            = CsrfHelper::TOKEN_NAME;
        $this->data['CSRF_TOKEN_VALUE']           = CsrfHelper::getToken();
        $this->data['CONTENT']                    = "Success Login !";
        $this->data['PATIENT_ACTIVE']             = "active";
        $this->data['STICKY_NAV_LOWER']           = FALSE;
        $this->data['CONTENT_FLUID']              = TRUE;
        $this->data['time']                       = $this->timezone->now( TIMEZONE );

        $this->data['ALL_PATIENT']                = PatientModel::getAllPatient();

        $this->data['LOGOUT']                     = $this->app->urlFor( 'logout' );


        $this->app->render('Backend/Content/Patient/Index.twig', $this->data);

    }

    public function backendPatientProfile( $patient_id )
    {
        if ( isset ( $this->permission ) ) :

            $this->data['PERMISSION']             = $this->permission;

        endif;

        $this->data['CSRF_TOKEN_NAME']            = CsrfHelper::TOKEN_NAME;
        $this->data['CSRF_TOKEN_VALUE']           = CsrfHelper::getToken();
        $this->data['CONTENT']                    = "Success Login !";
        $this->data['PATIENT_ACTIVE']             = "active";
        $this->data['CONTENT']                    = "Welcome !";
        $this->data['STICKY_NAV_LOWER']           = FALSE;
        $this->data['CONTENT_FLUID']              = TRUE;
        $this->data['HUGE_AVATAR_MAX_SIZE']       = HUGE_AVATAR_MAX_SIZE;
        $this->data['PUBLIC_DIR']                 = PUBLIC_DIR;

        $this->data['PATIENT_PROFILE']            = PatientModel::getProfileOfPatient( $patient_id );

        $this->data['PATIENT_APPOINTMENT']        = AppointmentModel::getAppointmentDataOfPatient( $patient_id );

        $this->data['ALL_DENTIST']                = DentistModel::getAllDentist();

        $this->data['TIME']                       = $this->timezone->now( TIMEZONE );


        $this->data['LOGOUT']                     = $this->app->urlFor( 'logout' );

        $this->app->render('Backend/Content/Patient/PatientProfile.twig', $this->data);
    }

    public function backendActionAddAuthPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            RegistrationModel::registerNewPatient();

            $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );

        endif;

    }

    public function backendActionUpdateProfile()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            PatientModel::updateProfileDetailsOfPatient(
                $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'first_name' ), $this->app->request()->post( 'last_name' ), $this->app->request()->post( 'address' ), $this->app->request()->post( 'bio' ), $this->app->request()->post( 'gender' ), $this->app->request()->post( 'phone' ), $this->app->request()->post( 'cellphone' ), $this->app->request()->post( 'birthdate' )
            );
            
            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
                
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionChangePassword()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            PatientModel::setNewPassword(
                $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'user_name' ), $this->app->request()->post( 'user_password_new' ), $this->app->request()->post( 'user_password_repeat' )
            );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
                
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionChangeEmail()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            PatientModel::editPatientEmail( $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'user_name' ), $this->app->request()->post( 'user_email' ) );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
                
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionChangeUsername()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            PatientModel::editPatientUserName( $this->app->request()->post( 'patient_id' ), $this->app->request()->post( 'user_email' ), $this->app->request()->post( 'user_name' ) );

            if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
                
            elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                
                $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                    
            endif;

        endif;

    }

    public function backendActionUploadAvatar()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            //$storage = new \Upload\Storage\FileSystem('/path/to/directory');
            $upload_path = "public/avatars/patients/";

            if ( ! is_dir ( $upload_path ) ) :

                //CREATE DIRECTORY
                mkdir( $upload_path, DIR_WRITE_MODE );

            endif;

            $storage = new \Upload\Storage\FileSystem( $upload_path );
            $file = new \Upload\File( 'avatar_file', $storage );

            // Optionally you can rename the file on upload
            $new_filename = uniqid();
            $file->setName( 'avatar_' . $this->app->request()->post( 'first_name' ) . '_' . $this->app->request()->post( 'last_name' ) . '_' . $new_filename );

            // Validate file upload
            // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
            $file->addValidations(array(

                new \Upload\Validation\Mimetype( explode( ",", $this->filesAllowed ) ),

                //You can also add multi mimetype validation
                //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                new \Upload\Validation\Size( MAX_UPLOAD_SIZE )
            ));

            // Access data about the file that has been uploaded
            $avatar = array(
                'name'       => $file->getNameWithExtension(),
                'extension'  => $file->getExtension(),
                'mime'       => $file->getMimetype(),
                'size'       => $file->getSize(),
                'md5'        => $file->getMd5(),
                'dimensions' => $file->getDimensions()
            );

            // Try to upload file
            try {
                // Success!
                $file->upload();
            } catch ( \Exception $e ) {
                // Fail!
                $errors = $file->getErrors();
            }

            if ( ! empty ( $errors ) ) :

                foreach ( $errors as $key => $error ) :

                    $this->app->flash( 'error', var_export( $error, true ) );

                endforeach;

                $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );

            else :

                PatientModel::savePatientAvatar( $this->app->request()->post( 'user_email' ), $this->app->request()->post( 'patient_id' ), $avatar['name'] );

                if ( $this->data['PROVIDER'] == 'DEFAULT' ) :
                
                    $this->app->response()->redirect( $this->app->urlFor( 'patients' ) . $this->app->request()->post( 'patient_id' ) );
                
                elseif ( $this->data['PROVIDER'] == 'DCAS Patient Registration' ) :
                    
                    $this->app->response()->redirect( $this->app->urlFor( 'myProfile' ) );
                        
                endif;

            endif;

        endif;

    }

    public function backendActionAddPatient()
    {

        if ( $this->app->request()->isPost() OR $this->app->request()->isFormData() ) :

            PatientModel::registerNewPatient();

            $this->app->response()->redirect( $this->app->urlFor( 'patients' ) );

        endif;

    }

}