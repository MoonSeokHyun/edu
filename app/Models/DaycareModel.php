<?php

namespace App\Models;

use CodeIgniter\Model;

class DaycareModel extends Model
{
    protected $table = 'daycare_info';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'Province', 'City_County_District', 'Daycare_Name', 'Daycare_Type', 'Operation_Status',
        'Postal_Code', 'Address', 'Daycare_Phone_Number', 'Daycare_Fax_Number',
        'Number_of_Classrooms', 'Classroom_Area_sqm', 'Number_of_Playgrounds',
        'Number_of_CCTVs_Installed', 'Number_of_Staff', 'Capacity', 'Current_Enrollment',
        'Latitude', 'Longitude', 'Shuttle_Bus_Operated', 'Website_URL',
        'License_Date', 'Suspension_Start_Date', 'Suspension_End_Date', 'Closure_Date'
    ];
}
