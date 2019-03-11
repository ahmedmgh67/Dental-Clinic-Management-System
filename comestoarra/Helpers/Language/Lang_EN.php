<?php

return [


    /*
    *---------------------------------------------------------------
    * ALL GLOBAL LANGUAGE
    *---------------------------------------------------------------
    */
    "GLOBAL_WELCOME"                                      => "Welcome",
    "GLOBAL_FROM"                                         => "From",
    "GLOBAL_TO"                                           => "To",

    /*
    *---------------------------------------------------------------
    * ALL FEEDBACK LANGUAGE
    *---------------------------------------------------------------
    */
    "FEEDBACK_UNKNOWN_ERROR"                                => "Unknown error occurred!",
    "FEEDBACK_DELETED"                                      => "Your account has been deleted.",
    "FEEDBACK_ACCOUNT_SUSPENDED"                            => "Account Suspended for ",
    "FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS"           => "This user's suspension / deletion status has been edited.",
    "FEEDBACK_ACCOUNT_ROOT_STATUS"                          => "This user root type was successfully updated.",
    "FEEDBACK_ACCOUNT_UNROOT_STATUS"                        => "This user was successfully set as NOT ROOT.",
    "FEEDBACK_ACCOUNT_ROLE_STATUS"                          => "This user role was successfully updated.",
    "FEEDBACK_ROLE_USER_HAS_ASSOC"                          => "This role have user association, can not delete it !.",
    "FEEDBACK_ROLE_SUCCESS_UPDATED"                         => "This user role was successfully updated.",
    "FEEDBACK_ROLE_SUCCESS_DELETED"                         => "This user role was successfully deleted.",
    "FEEDBACK_PASSWORD_WRONG_3_TIMES"                       => "You have typed in a wrong password 3 or more times already. Please wait 30 seconds to try again.",
    "FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET"                    => "Your account is not activated yet. Please click on the confirm link in the mail.",
    "FEEDBACK_PASSWORD_WRONG"                               => "Password was wrong.",
    "FEEDBACK_USER_DOES_NOT_EXIST"                          => "This user does not exist.",
    "FEEDBACK_LOGIN_FAILED"                                 => "Login failed.",
    "FEEDBACK_LOGIN_FAILED_3_TIMES"                         => "Login failed 3 or more times already. Please wait 30 seconds to try again.",
    "FEEDBACK_USERNAME_FIELD_EMPTY"                         => "Username field was empty.",
    "FEEDBACK_PASSWORD_FIELD_EMPTY"                         => "Password field was empty.",
    "FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY"             => "Username or password field was empty.",
    "FEEDBACK_USERNAME_EMAIL_FIELD_EMPTY"                   => "Username / email field was empty.",
    "FEEDBACK_EMAIL_FIELD_EMPTY"                            => "Email field was empty.",
    "FEEDBACK_EMAIL_AND_PASSWORD_FIELDS_EMPTY"              => "Email and password fields were empty.",
    "FEEDBACK_USERNAME_SAME_AS_OLD_ONE"                     => "Sorry, that username is the same as your current one. Please choose another one.",
    "FEEDBACK_USERNAME_ALREADY_TAKEN"                       => "Sorry, that username is already taken. Please choose another one.",
    "FEEDBACK_ROLE_NAME_ALREADY_TAKEN"                      => "Sorry, that role name is already exists.",
    "FEEDBACK_USER_EMAIL_ALREADY_TAKEN"                     => "Sorry, that email is already in use. Please choose another one.",
    "FEEDBACK_USERNAME_CHANGE_SUCCESSFUL"                   => "Your username has been changed successfully.",
    "FEEDBACK_USERNAME_AND_PASSWORD_FIELD_EMPTY"            => "Username and password fields were empty.",
    "FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN"                => "Username does not fit the name pattern: only a-Z and numbers are allowed, 2 to 64 characters.",
    "FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN"                   => "Sorry, your chosen email does not fit into the email naming pattern.",
    "FEEDBACK_EMAIL_SAME_AS_OLD_ONE"                        => "Sorry, that email address is the same as your current one. Please choose another one.",
    "FEEDBACK_EMAIL_CHANGE_SUCCESSFUL"                      => "Your email address has been changed successfully.",
    "FEEDBACK_CAPTCHA_WRONG"                                => "The entered captcha security characters were wrong.",
    "FEEDBACK_PASSWORD_REPEAT_WRONG"                        => "Password and password repeat are not the same.",
    "FEEDBACK_PASSWORD_TOO_SHORT"                           => "Password has a minimum length of 6 characters.",
    "FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG"               => "Username cannot be shorter than 2 or longer than 64 characters.",
    "FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED"                 => "Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that mail.",
    "FEEDBACK_ROLE_SUCCESSFULLY_CREATED"                    => "New Role has been created successfully.",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED"             => "Sorry, we could not send you an verification mail. Your account has NOT been created. Please Contact Administrator",
    "FEEDBACK_ACCOUNT_CREATION_FAILED"                      => "Sorry, your registration failed. Please go back and try again.",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR"              => "Verification mail could not be sent due to: ",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL"         => "A verification mail has been sent successfully.",
    "FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL"                => "Activation was successful! You can now log in.",
    "FEEDBACK_ACCOUNT_ACTIVATION_FAILED"                    => "Sorry, no such id/verification code combination here...",
    "FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL"                     => "Avatar upload was successful.",
    "FEEDBACK_AVATAR_UPLOAD_WRONG_TYPE"                     => "Only JPEG and PNG files are supported.",
    "FEEDBACK_AVATAR_UPLOAD_TOO_SMALL"                      => "Avatar source file's width/height is too small. Needs to be 100x100 pixel minimum.",
    "FEEDBACK_AVATAR_UPLOAD_TOO_BIG"                        => "Avatar source file is too big. 5 Megabyte is the maximum.",
    "FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE" => "Avatar folder does not exist or is not writable. Please change this via chmod 775 or 777.",
    "FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED"                   => "Something went wrong with the image upload.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_SUCCESSFUL"               => "You successfully deleted your avatar.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_NO_FILE"                  => "You don't have a custom avatar.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_FAILED"                   => "Something went wrong while deleting your avatar.",
    "FEEDBACK_PASSWORD_RESET_TOKEN_FAIL"                    => "Could not write token to database.",
    "FEEDBACK_PASSWORD_RESET_TOKEN_MISSING"                 => "No password reset token.",
    "FEEDBACK_PASSWORD_RESET_MAIL_SENDING_ERROR"            => "Password reset mail could not be sent due to: ",
    "FEEDBACK_PASSWORD_RESET_MAIL_SENDING_SUCCESSFUL"       => "A password reset mail has been sent successfully.",
    "FEEDBACK_PASSWORD_RESET_LINK_EXPIRED"                  => "Your reset link has expired. Please use the reset link within one hour.",
    "FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST"    => "Username/Verification code combination does not exist.",
    "FEEDBACK_PASSWORD_RESET_LINK_VALID"                    => "Password reset validation link is valid. Please change the password now.",
    "FEEDBACK_PASSWORD_CHANGE_SUCCESSFUL"                   => "Password successfully changed.",
    "FEEDBACK_PASSWORD_CHANGE_FAILED"                       => "Sorry, your password changing failed.",
    "FEEDBACK_PASSWORD_NEW_SAME_AS_CURRENT"                 => "New password is the same as the current password.",
    "FEEDBACK_PASSWORD_CURRENT_INCORRECT"                   => "Current password entered was incorrect.",
    "FEEDBACK_ACCOUNT_TYPE_CHANGE_SUCCESSFUL"               => "Account type change successful",
    "FEEDBACK_ACCOUNT_TYPE_CHANGE_FAILED"                   => "Account type change failed",
    "FEEDBACK_NOTE_CREATION_FAILED"                         => "Note creation failed.",
    "FEEDBACK_NOTE_EDITING_FAILED"                          => "Note editing failed.",
    "FEEDBACK_NOTE_DELETION_FAILED"                         => "Note deletion failed.",
    "FEEDBACK_COOKIE_INVALID"                               => "Your remember-me-cookie is invalid.",
    "FEEDBACK_COOKIE_LOGIN_SUCCESSFUL"                      => "You were successfully logged in via the remember-me-cookie.",
    "FEEDBACK_MAIL_SUCCESS_COMPOSE"                      	=> "Your Messages was successfully sent !.",
    "FEEDBACK_MAIL_ERROR_COMPOSE"                      	    => "An Error occured, Your Messages was fail to send !.",
    "FEEDBACK_MAIL_SUCCESS_DELETE"                      	=> "Message has been deleted !.",
    "FEEDBACK_MAIL_ERROR_DELETE"                      	    => "An Error occured, the Message was fail to delete !.",
    "FEEDBACK_MAIL_SUCCESS_READ"                      	    => "Message has been mark as read !.",
    "FEEDBACK_MAIL_ERROR_READ"                      	    => "An Error occured, the Message was fail to mark as read !.",
    "FEEDBACK_MAIL_SUCCESS_UNREAD"                      	=> "Message has been mark as unread !.",
    "FEEDBACK_MAIL_ERROR_UNREAD"                      	    => "An Error occured, the Message was fail to mark as unread !.",
    "FEEDBACK_MAIL_SUCCESS_ARCHIVED"                      	=> "Message has been archived !.",
    "FEEDBACK_MAIL_ERROR_ARCHIVED"                      	=> "An Error occured, the Message was fail to mark as archived !.",
    "FEEDBACK_MAIL_SUCCESS_UNARCHIVED"                      => "Message has been un-archived !.",
    "FEEDBACK_MAIL_ERROR_UNARCHIVED"                      	=> "An Error occured, the Message was fail to mark as un-archived !.",
    "FEEDBACK_PAGE_DOES_NOT_EXIST"                          => "Page does not exist.",


    /*
    *---------------------------------------------------------------
    * ALL AUTH LANGUAGE
    *---------------------------------------------------------------
    */
    "AUTH_SUCCESS_LOGOUT"                                 => "You've Successfully Logged Out !",

    /*
     *---------------------------------------------------------------
     * ALL SYSTEM SETTINGS LANGUAGE
     *---------------------------------------------------------------
     */
    "SETTING_ERROR_POST_ACTION"                          => "An ERROR Occured, please contact developer (labs@comestoarra.com) !",
    "SETTING_SUCCESS_POST_ACTION"                        => "Data was updated successfully !",

    "SETTING_ERROR_URL"                                  => "Site URL Cannot be empty !",
    "SETTING_ERROR_NAME"                                 => "Site Name Cannot be empty !",
    "SETTING_ERROR_TITLE"                                => "Site Title Cannot be empty !",
    "SETTING_ERROR_OWNER_NAME"                           => "Site Owner Name Cannot be empty !",
    "SETTING_ERROR_OWNER_EMAIL"                          => "Site Owner Email Cannot be empty !",
    "SETTING_ERROR_UPLOAD_PATH"                          => "Site Upload Path Cannot be empty !",
    "SETTING_ERROR_FILES_ALLOWED"                        => "Site Upload Allowed Files Cannot be empty !",



    /*
     *---------------------------------------------------------------
     * ALL AUDIT TRAILS LANGUAGE
     *---------------------------------------------------------------
     */
    "AUDIT_SUCCESS_LOGIN"                                => "Was Successfully logged in",
    "AUDIT_SUCCESS_LOGOUT"                               => "Was Successfully logged out",
    "AUDIT_SUCCESS_CHANGE_USERNAME"                      => "Was Successfully changed username",
    "AUDIT_SUCCESS_CHANGE_AVATAR"                        => "Was Successfully changed avatar",
    "AUDIT_SUCCESS_CHANGE_EMAIL"                         => "Was Successfully changed email address",
    "AUDIT_SUCCESS_CHANGE_PASSWORD"                      => "Was Successfully changed password",
    "AUDIT_SUCCESS_UPDATE_PROFILE"                       => "Was Successfully updated profile data",
    "AUDIT_USER_NOT_FOUND"                               => "Cannot fetch user audit data",
    "TRIM_AUDIT_SUCCESS"                                 => "Success Trim All Audit Data",
    "CLEAR_AUDIT_SUCCESS"                                => "Success Delete All Audit Data",

    /*
     *---------------------------------------------------------------
     * PATIENT MODULE LANGUAGE
     *---------------------------------------------------------------
     */
    "FEEDBACK_PATIENT_SUCCESSFULLY_CREATED"                 => "Patient account has been created successfully.",
    "FEEDBACK_PATIENT_AVATAR_SUCCESS_UPDATED"               => "Patient avatar has been updated successfully.",
    "FEEDBACK_PATIENT_DOES_NOT_EXIST"                       => "Patient does not exists !",
    "FEEDBACK_PATIENT_SUCCESS_APPOINTMENT"                  => "Patient appointment has been created successfully.",
    "FEEDBACK_PATIENT_ERROR_APPOINTMENT"                    => "Patient appointment has not been created !.",
    "FEEDBACK_PATIENT_ERROR_APPOINTMENT_FORM"               => "Patient appointment has not been created, please check all required fields (Appointment Date, etc.) !.",
    "FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_DELETE"           => "Patient appointment has been deleted successfully !.",
    "FEEDBACK_PATIENT_APPOINTMENT_ERROR_DELETE"             => "Patient appointment has not been deleted !.",
    "FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_CANCEL"           => "Patient appointment has been cancelled successfully !.",
    "FEEDBACK_PATIENT_APPOINTMENT_ERROR_CANCEL"             => "Patient appointment has not been cancelled !.",
    "FEEDBACK_PATIENT_APPOINTMENT_SUCCESS_ACTIVATE"         => "Patient appointment has been activated successfully !.",
    "FEEDBACK_PATIENT_APPOINTMENT_ERROR_ACTIVATE"           => "Patient appointment has not been activated !.",

    /*
    *---------------------------------------------------------------
    * DENTIST MODULE LANGUAGE
    *---------------------------------------------------------------
    */
    "FEEDBACK_DENTIST_SUCCESSFULLY_CREATED"                 => "Dentist account has been created successfully.",
    "FEEDBACK_DENTIST_TIMETABLE_SUCCESS_UPDATED"            => "Dentist timetable has been updated successfully.",
    "FEEDBACK_DENTIST_AVATAR_SUCCESS_UPDATED"               => "Dentist avatar has been updated successfully.",
    "FEEDBACK_DENTIST_DOES_NOT_EXIST"                       => "Dentist does not exists !",


];
