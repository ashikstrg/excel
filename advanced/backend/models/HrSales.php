<?php

namespace backend\models;

use Yii;

class HrSales extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'hr_sales';
    }

    public function rules()
    {
        return [
            [['designation_id', 'employee_id', 'manager_id', 'name', 'status', 'joining_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'bank_name', 'bank_ac_name', 'bank_ac_no', 'bkash_no', 'blood_group', 'graduation_status', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'previous_experience', 'previous_experience_two', 'permanent_address', 'present_address'], 'required'],

            [['designation_id', 'employee_type_id', 'parent', 'previous_experience', 'previous_experience_two'], 'integer'],
            [['joining_date', 'leaving_date', 'created_at', 'updated_at'], 'safe'],
            [['designation', 'employee_type'], 'string', 'max' => 100],
            [['employee_id', 'manager_id', 'manager_designation', 'relation_immergency_contact_person'], 'string', 'max' => 50],
            [['manager_name', 'name', 'name_immergency_contact_person', 'email_address', 'email_address_official', 'bank_ac_name'], 'string', 'max' => 80],
            [['bank_name'], 'string', 'max' => 150],
            [['educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'created_by', 'updated_by'], 'string', 'max' => 255],
            
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency', 'bkash_no'], 'string', 'max' => 11],
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency', 'bkash_no'], 'match', 'pattern' => '/^(01)(1|5|6|7|8|9)\d{8}$/'],
            
            [['blood_group', 'status', 'graduation_status'], 'string', 'max' => 10],
            [['bank_ac_no'], 'string', 'max' => 20],
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
            'manager_id' => 'Supervisor  ID',
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
            'bank_name' => 'Bank Name',
            'bank_ac_name' => 'Bank Account Name',
            'bank_ac_no' => 'Bank Account Number',
            'bkash_no' => 'Bkash Number',
            'blood_group' => 'Blood Group',
            'graduation_status' => 'Graduation Status',
            'educational_qualification' => 'Educational Qualification',
            'educational_institute' => 'Educational Institute',
            'educational_qualification_second_last' => 'Educational Qualification (Second Last)',
            'educational_institute_second_last' => 'Educational Institute (Second Last)',
            'previous_experience' => 'Previous Experience (Month)',
            'previous_experience_two' => 'Previous Experience 2 (Month)',
            'permanent_address' => 'Permanent Address',
            'present_address' => 'Present Address',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
