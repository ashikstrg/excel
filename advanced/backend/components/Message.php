<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace backend\components;

/**
 * Description of Message
 *
 * @author ashik
 */
class Message {
    
    public static $employeeIdNotFound = 'Please exit app and login again.';
    public static $imeiNotFoundStock = 'IMEI Number has not been found in the stock.';
    public static $imeiNotFoundInventory = 'IMEI Number has not been found in the inventory.';
    public static $serverError = 'Server error !!! Please try again.';
    public static $successMessage = 'Your data has successfully been added.';
    public static $unauthorizedAccess = 'Unauthorized Access.';
    public static $imeiSold = 'This IMEI Number has already been sold.';
    public static $imeiAdded = 'This IMEI Number has already been added.';
    public static $inventoryError = 'Inventory could not be updated.';
    
}
