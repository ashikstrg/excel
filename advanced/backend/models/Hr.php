<?php

namespace backend\models;

use Yii;

class Hr extends \yii\db\ActiveRecord
{
    public static $fsmEmployeeType = 'FSM';

    public static function tableName()
    {
        return 'hr';
    }

    public function rules()
    {
        return [
            [['designation_id', 'employee_id', 'tm_employee_id', 'retail_id', 'name', 'status', 'joining_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'bank_name', 'bank_ac_name', 'bank_ac_no', 'bkash_no', 'blood_group', 'graduation_status', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'previous_experience', 'previous_experience_two', 'permanent_address', 'present_address'], 'required'],

            [['retail_id', 'designation_id', 'employee_type_id', 'tm_parent', 'am_parent', 'csm_parent', 'previous_experience', 'previous_experience_two'], 'integer'],

            [['joining_date', 'leaving_date', 'created_at', 'updated_at'], 'safe'],
            [['designation', 'employee_type', 'retail_dms_code', 'retail_channel_type', 'retail_type'], 'string', 'max' => 100],

            [['employee_id', 'tm_employee_id', 'am_employee_id', 'csm_employee_id', 'relation_immergency_contact_person'], 'string', 'max' => 50],

            [['tm_name', 'am_name', 'csm_name', 'name', 'name_immergency_contact_person', 'email_address', 'email_address_official', 'bank_ac_name'], 'string', 'max' => 80],

            [['retail_name', 'retail_zone', 'bank_name'], 'string', 'max' => 150],
            [['retail_area', 'retail_territory'], 'string', 'max' => 250],
            [['educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency', 'bkash_no'], 'string', 'max' => 11],
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency', 'bkash_no'], 'match', 'pattern' => '/^(01)(1|5|6|7|8|9)\d{8}$/'],
            [['blood_group', 'status', 'graduation_status'], 'string', 'max' => 10],
            [['bank_ac_no'], 'string', 'max' => 20],
            [['permanent_address', 'present_address'], 'string', 'max' => 550],
            // Custom Validator
            [['user_id'], 'safe'],
            [['email_address', 'email_address_official'], 'email'],
            [['email_address_official'], 'unique'],
            [['employee_id'], 'unique'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['image_src_filename', 'image_web_filename'], 'string', 'max' => 255]
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
            'tm_parent' => 'Territory Manager Parent',
            'am_parent' => 'Area Manager Parent',
            'csm_parent' => 'Country Sales Manager Parent',
            'tm_employee_id' => 'Territory Manager ID',
            'am_employee_id' => 'Area Manager ID',
            'csm_employee_id' => 'Country Sales Manager ID',
            'tm_name' => 'Territory Manager Name',
            'am_name' => 'Area Manager Name',
            'csm_name' => 'Country Sales Manager Name',
            'retail_id' => 'Retail',
            'retail_dms_code' => 'Retail Dms Code',
            'retail_channel_type' => 'Retail Channel Type',
            'retail_type' => 'Retail Type',
            'retail_name' => 'Retail Name',
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
            'created_at' => 'Created AT',
            'created_by' => 'Created BY',
            'updated_at' => 'Updated AT',
            'updated_by' => 'Updated BY',
        ];
    }
}
