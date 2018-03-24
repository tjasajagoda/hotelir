<?php
    abstract class LoginStatus {
        const Ok = 0;
        const NotFound = 1;
        const NotActive = 2;
    }

    abstract class SettingKey {
        const NumberOfRetries = "numberOfRetries";
        const WatchPeriod = "watchPeriod";
        const LockPeriod = "lockPeriod";
        const LoginHistoryCount = "loginHistoryCount";
        const ActivationLinkPeriod = "activationLinkPeriod";
    }

    abstract class SaveStatus {
        const Inserted = 0;
        const Updated = 1;
        const UnknownError = 2;
        const InvalidData = 3;
        const DuplicateFound = 4;
    }

    abstract class DeleteStatus {
        const Deleted = 0;
        const ConstraintExists = 1;
        const UnknowError = 2;
    }
?>