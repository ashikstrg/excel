<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hr_trainer".
 *
 * @property string $id
 * @property string $designation_id
 * @property string $designation
 * @property string $employee_type_id
 * @property string $employee_type
 * @property string $employee_id
 * @property string $parent
 * @property string $manager_id
 * @property string $manager_name
 * @property string $manager_designation
 * @property string $name
 * @property string $status
 * @property string $joining_date
 * @property string $leaving_date
 * @property string $image
 * @property string $image_src_filename
 * @property string $image_web_filename
 * @property string $contact_no_official
 * @property string $contact_no_personal
 * @property string $name_immergency_contact_person
 * @property string $relation_immergency_contact_person
 * @property string $contact_no_immergency
 * @property string $email_address
 * @property string $email_address_official
 * @property string $blood_group
 * @property string $permanent_address
 * @property string $present_address
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $user_id
 */
class HrTrainer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'hr_trainer';
    }

    public function rules()
    {
        return [
           [['designation_id', 'employee_id', 'manager_id', 'name', 'status', 'joining_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'blood_group', 'permanent_address', 'present_address'], 'required'],

            [['designation_id', 'employee_type_id', 'parent'], 'integer'],
            [['joining_date', 'leaving_date', 'created_at', 'updated_at'], 'safe'],
            [['designation', 'employee_type'], 'string', 'max' => 100],
            [['employee_id', 'manager_id', 'manager_designation', 'relation_immergency_contact_person'], 'string', 'max' => 50],
            [['manager_name', 'name', 'name_immergency_contact_person', 'email_address', 'email_address_official'], 'string', 'max' => 80],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency'], 'string', 'max' => 11],
            [['blood_group', 'status'], 'string', 'max' => 10],
            [['permanent_address', 'present_address'], 'string', 'max' => 550],
            // Custom Validator
            [['email_address', 'email_address_official'], 'email'],
            [['employee_id'], 'unique'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255],  
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designation_id' => 'Designation',
            'designation' => 'Designation',
            'employee_type_id' => 'Employee Type',
            'employee_type' => 'Employee Type',
            'employee_id' => 'Employee ID',
            'parent' => 'Parent',
            'manager_id' => 'Manager ID',
            'manager_name' => 'Manager Name',
            'manager_designation' => 'Manager Designation',
            'name' => 'Name',
            'status' => 'Status',
            'joining_date' => 'Joining Date',
            'leaving_date' => 'Leaving Date',
            'image' => 'Image',
            'image_src_filename' => 'Image Src Filename',
            'image_web_filename' => 'Image Web Filename',
            'contact_no_official' => 'Contact No (Official)',
            'contact_no_personal' => 'Contact No (Personal)',
            'name_immergency_contact_person' => 'Name (Emergency Contact Person)',
            'relation_immergency_contact_person' => 'Relation (Emergency Contact Person)',
            'contact_no_immergency' => 'Contact No (Emergency Contact Person)',
            'email_address' => 'Email Address (Personal)',
            'email_address_official' => 'Email Address (Official)',
            'blood_group' => 'Blood Group',
            'permanent_address' => 'Permanent Address',
            'present_address' => 'Present Address',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
