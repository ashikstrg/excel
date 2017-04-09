<?php

namespace backend\models;

use Yii;

class HrManagement extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'hr_management';
    }

    public function rules()
    {
        return [
           [['employee_id', 'name', 'status', 'joining_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'blood_group', 'permanent_address', 'present_address'], 'required'],

            [['designation_id', 'employee_type_id'], 'integer'],
            [['joining_date', 'leaving_date', 'created_at', 'updated_at'], 'safe'],
            [['designation', 'employee_type'], 'string', 'max' => 100],
            [['employee_id', 'relation_immergency_contact_person'], 'string', 'max' => 50],
            [['name', 'name_immergency_contact_person', 'email_address', 'email_address_official'], 'string', 'max' => 80],
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
