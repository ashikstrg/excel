<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hr_management".
 *
 * @property string $id
 * @property string $designation_id
 * @property string $designation
 * @property string $employee_type_id
 * @property string $employee_type
 * @property string $employee_id
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
 * @property string $graduation_status
 * @property string $educational_qualification
 * @property string $educational_institute
 * @property string $educational_qualification_second_last
 * @property string $educational_institute_second_last
 * @property string $previous_experience
 * @property string $previous_experience_two
 * @property string $permanent_address
 * @property string $present_address
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 * @property string $user_id
 */
class HrManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_management';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['designation_id', 'designation', 'employee_type_id', 'employee_type', 'employee_id', 'name', 'joining_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'blood_group', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'previous_experience', 'previous_experience_two', 'permanent_address', 'present_address', 'created_by', 'user_id'], 'required'],
            [['designation_id', 'employee_type_id', 'previous_experience', 'previous_experience_two', 'user_id'], 'integer'],
            [['status', 'graduation_status'], 'string'],
            [['joining_date', 'leaving_date', 'created_at', 'updated_at'], 'safe'],
            [['designation', 'employee_type', 'image'], 'string', 'max' => 100],
            [['employee_id', 'relation_immergency_contact_person'], 'string', 'max' => 50],
            [['name', 'name_immergency_contact_person', 'email_address', 'email_address_official'], 'string', 'max' => 80],
            [['image_src_filename', 'image_web_filename', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'created_by', 'updated_by'], 'string', 'max' => 255],
            [['contact_no_official', 'contact_no_personal', 'contact_no_immergency'], 'string', 'max' => 20],
            [['blood_group'], 'string', 'max' => 10],
            [['permanent_address', 'present_address'], 'string', 'max' => 550],
            [['employee_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'designation_id' => 'Designation ID',
            'designation' => 'Designation',
            'employee_type_id' => 'Employee Type ID',
            'employee_type' => 'Employee Type',
            'employee_id' => 'Employee ID',
            'name' => 'Name',
            'status' => 'Status',
            'joining_date' => 'Joining Date',
            'leaving_date' => 'Leaving Date',
            'image' => 'Image',
            'image_src_filename' => 'Image Src Filename',
            'image_web_filename' => 'Image Web Filename',
            'contact_no_official' => 'Contact No Official',
            'contact_no_personal' => 'Contact No Personal',
            'name_immergency_contact_person' => 'Name Immergency Contact Person',
            'relation_immergency_contact_person' => 'Relation Immergency Contact Person',
            'contact_no_immergency' => 'Contact No Immergency',
            'email_address' => 'Email Address',
            'email_address_official' => 'Email Address Official',
            'blood_group' => 'Blood Group',
            'graduation_status' => 'Graduation Status',
            'educational_qualification' => 'Educational Qualification',
            'educational_institute' => 'Educational Institute',
            'educational_qualification_second_last' => 'Educational Qualification Second Last',
            'educational_institute_second_last' => 'Educational Institute Second Last',
            'previous_experience' => 'Previous Experience',
            'previous_experience_two' => 'Previous Experience Two',
            'permanent_address' => 'Permanent Address',
            'present_address' => 'Present Address',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'user_id' => 'User ID',
        ];
    }
}
