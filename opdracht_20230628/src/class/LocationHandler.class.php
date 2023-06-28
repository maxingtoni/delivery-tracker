<?php

class LocationHandler extends Handler
{
    public static function addLocation($postData): bool
    {
        if (
            !isset($postData['user_id'])
            || !isset($postData['coordinates'])
        ) {
            return parent::handleError("LOCATION_ERROR", "An error occured, try again later.");
        }

        if (
            !Dbh::registeredValue('user', ['id' => $postData['user_id']])
        ) {
            return parent::handleError("LOCATION_ERROR", "User doesn't exist");
        }

        Dbh::createPdo();
        $location = new Location(Dbh::getPdo());
        if (!$location->create($postData['user_id'], "", $postData['coordinates'])) {
            parent::handleError("LOCATION_ERROR", "Location was not added.", "../../index.php?page=locations");
            return false;
        }

        parent::handleError("LOCATION_ERROR", "LLocation added.", "../../index.php?page=locations");
        return true;
    }
}