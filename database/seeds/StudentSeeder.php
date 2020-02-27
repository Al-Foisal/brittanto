<?php

use Illuminate\Database\Seeder;
use App\Models\Coaching\CoachingStudent;
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//--------601---------------------
        //class 1 1st part
        $x = 0;
        $b = 1960101050; //end value
        for($a = 1960101001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-1',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '1',
            'amd_type' => 'regular',
            'class_roll' => '1',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-011',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 1 2st part
        $x = 50;
        $b = 1960101100; //end value
        for($a = 1960101051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-1',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '1',
            'amd_type' => 'regular',
            'class_roll' => '1',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-012',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //------------------------------------
        //class 2 1st part
        $x = 0;
        $b = 1960102050; //end value
        for($a = 1960102001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-2',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '2',
            'amd_type' => 'regular',
            'class_roll' => '2',
            'tution_fee' => '2880',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-023',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 2 2st part
        $x = 50;
        $b = 1960102100; //end value
        for($a = 1960102051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-2',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '2',
            'amd_type' => 'regular',
            'class_roll' => '2',
            'tution_fee' => '2550',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-024',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //---------------------------------------
        //class 3 1st part
        $x = 0;
        $b = 1960103050; //end value
        for($a = 1960103001;$a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-3',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '3',
            'amd_type' => 'regular',
            'class_roll' => '3',
            'tution_fee' => '2300',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-035',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 3 2st part
        $x = 50;
        $b = 1960103100; //end value
        for($a = 1960103051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-3',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '3',
            'amd_type' => 'regular',
            'class_roll' => '3',
            'tution_fee' => '2300',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-036',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //---------------------------------------------
        //class 4 1st part
        $x = 0;
        $b = 1960104050; //end value
        for($a = 1960104001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-4',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '4',
            'amd_type' => 'regular',
            'class_roll' => '4',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-047',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 4 2st part
        $x = 50;
        $b = 1960104100; //end value
        for($a = 1960104051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-4',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '4',
            'amd_type' => 'regular',
            'class_roll' => '4',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-048',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-----------------------------------------
        //class 5 1st part
        $x = 0;
        $b = 1960105050; //end value
        for($a = 1960105001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-5',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '5',
            'amd_type' => 'regular',
            'class_roll' => '5',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-059',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 5 2st part
        $x = 50;
        $b = 1960105100; //end value
        for($a = 1960105051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-5',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '5',
            'amd_type' => 'regular',
            'class_roll' => '5',
            'tution_fee' => '2500',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0510',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------
        //class 6 1st part
        $x = 0;
        $b = 1960106050; //end value
        for($a = 1960106001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-6',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '6',
            'amd_type' => 'regular',
            'class_roll' => '6',
            'tution_fee' => '2600',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0611',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 6 2st part
        $x = 50;
        $b = 1960106100; //end value
        for($a = 1960106051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-6',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '6',
            'amd_type' => 'regular',
            'class_roll' => '6',
            'tution_fee' => '24600',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0612',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-----------------------------------------------
        //class 7 1st part
        $x = 0;
        $b = 1960107050; //end value
        for($a = 1960107001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-7',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '7',
            'amd_type' => 'regular',
            'class_roll' => '7',
            'tution_fee' => '2700',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0713',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 7 2st part
        $x = 50;
        $b = 1960107100; //end value
        for($a = 1960107051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-7',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '7',
            'amd_type' => 'regular',
            'class_roll' => '7',
            'tution_fee' => '2700',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0714',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------------
        //class 8 1st part
        $x = 0;
        $b = 1960108050; //end value
        for($a = 1960108001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-8',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '8',
            'amd_type' => 'regular',
            'class_roll' => '8',
            'tution_fee' => '2800',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0815',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 8 2st part
        $x = 50;
        $b = 1960108100; //end value
        for($a = 1960108051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-8',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '8',
            'amd_type' => 'regular',
            'class_roll' => '8',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0816',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-------------------------------------------
        //class 9 1st part
        $x = 0;
        $b = 1960109050; //end value
        for($a = 1960109001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-9',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '9',
            'amd_type' => 'regular',
            'class_roll' => '9',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0917',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 9 2st part
        $x = 50;
        $b = 1960109100; //end value
        for($a = 1960109051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-9',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '9',
            'amd_type' => 'regular',
            'class_roll' => '9',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0918',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------------
        //class 10 1st part
        $x = 0;
        $b = 1960110050; //end value
        for($a = 1960110001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-10',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '10',
            'amd_type' => 'regular',
            'class_roll' => '10',
            'tution_fee' => '2333',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1019',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 10 2st part
        $x = 50;
        $b = 1960110100; //end value
        for($a = 1960110051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-10',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '10',
            'amd_type' => 'regular',
            'class_roll' => '10',
            'tution_fee' => '2990',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1020',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //--------------------------------------------------
        //class 11 1st part
        $x = 0;
        $b = 1960111050; //end value
        for($a = 1960111001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-11',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '11',
            'amd_type' => 'regular',
            'class_roll' => '11',
            'tution_fee' => '2110',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1121',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 11 2st part
        $x = 50;
        $b = 1960111100; //end value
        for($a = 1960111051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-11',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '11',
            'amd_type' => 'regular',
            'class_roll' => '11',
            'tution_fee' => '2550',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1122',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //------------------------------------------------------
        //class 12 1st part
        $x = 0;
        $b = 1960112050; //end value
        for($a = 1960112001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-12',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '12',
            'amd_type' => 'regular',
            'class_roll' => '12',
            'tution_fee' => '2220',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1223',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 12 2st part
        $x = 50;
        $b = 1960112100; //end value
        for($a = 1960112051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-12',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '12',
            'amd_type' => 'regular',
            'class_roll' => '12',
            'tution_fee' => '2369',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1224',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '601',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }






//--------602---------------------
        //class 1 1st part
        $x = 0;
        $b = 1960201050; //end value
        for($a = 1960201001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-1',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '1',
            'amd_type' => 'regular',
            'class_roll' => '1',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-011',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 1 2st part
        $x = 50;
        $b = 1960201100; //end value
        for($a = 1960201051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-1',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '1',
            'amd_type' => 'regular',
            'class_roll' => '1',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-012',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //------------------------------------
        //class 2 1st part
        $x = 0;
        $b = 1960202050; //end value
        for($a = 1960202001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-2',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '2',
            'amd_type' => 'regular',
            'class_roll' => '2',
            'tution_fee' => '2880',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-023',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 2 2st part
        $x = 50;
        $b = 1960202100; //end value
        for($a = 1960202051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-2',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '2',
            'amd_type' => 'regular',
            'class_roll' => '2',
            'tution_fee' => '2550',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-024',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //---------------------------------------
        //class 3 1st part
        $x = 0;
        $b = 1960203050; //end value
        for($a = 1960203001;$a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-3',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '3',
            'amd_type' => 'regular',
            'class_roll' => '3',
            'tution_fee' => '2300',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-035',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 3 2st part
        $x = 50;
        $b = 1960203100; //end value
        for($a = 1960203051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-3',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '3',
            'amd_type' => 'regular',
            'class_roll' => '3',
            'tution_fee' => '2300',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-036',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //---------------------------------------------
        //class 4 1st part
        $x = 0;
        $b = 1960204050; //end value
        for($a = 1960204001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-4',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '4',
            'amd_type' => 'regular',
            'class_roll' => '4',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-047',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 4 2st part
        $x = 50;
        $b = 1960204100; //end value
        for($a = 1960204051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-4',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '4',
            'amd_type' => 'regular',
            'class_roll' => '4',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-048',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-----------------------------------------
        //class 5 1st part
        $x = 0;
        $b = 1960205050; //end value
        for($a = 1960205001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-5',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '5',
            'amd_type' => 'regular',
            'class_roll' => '5',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-059',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 5 2st part
        $x = 50;
        $b = 1960205100; //end value
        for($a = 1960205051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-5',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '5',
            'amd_type' => 'regular',
            'class_roll' => '5',
            'tution_fee' => '2500',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0510',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------
        //class 6 1st part
        $x = 0;
        $b = 1960206050; //end value
        for($a = 1960206001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-6',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '6',
            'amd_type' => 'regular',
            'class_roll' => '6',
            'tution_fee' => '2600',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0611',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 6 2st part
        $x = 50;
        $b = 1960206100; //end value
        for($a = 1960206051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-6',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '6',
            'amd_type' => 'regular',
            'class_roll' => '6',
            'tution_fee' => '24600',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0612',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-----------------------------------------------
        //class 7 1st part
        $x = 0;
        $b = 1960207050; //end value
        for($a = 1960207001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-7',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '7',
            'amd_type' => 'regular',
            'class_roll' => '7',
            'tution_fee' => '2700',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0713',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 7 2st part
        $x = 50;
        $b = 1960207100; //end value
        for($a = 1960207051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-7',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '7',
            'amd_type' => 'regular',
            'class_roll' => '7',
            'tution_fee' => '2700',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0714',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------------
        //class 8 1st part
        $x = 0;
        $b = 1960208050; //end value
        for($a = 1960208001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-8',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '8',
            'amd_type' => 'regular',
            'class_roll' => '8',
            'tution_fee' => '2800',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0815',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 8 2st part
        $x = 50;
        $b = 1960208100; //end value
        for($a = 1960208051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-8',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '8',
            'amd_type' => 'regular',
            'class_roll' => '8',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0816',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //-------------------------------------------
        //class 9 1st part
        $x = 0;
        $b = 1960209050; //end value
        for($a = 1960209001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-9',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '9',
            'amd_type' => 'regular',
            'class_roll' => '9',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0917',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 9 2st part
        $x = 50;
        $b = 1960209100; //end value
        for($a = 1960209051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-9',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '9',
            'amd_type' => 'regular',
            'class_roll' => '9',
            'tution_fee' => '2400',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-0918',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //----------------------------------------------
        //class 10 1st part
        $x = 0;
        $b = 1960210050; //end value
        for($a = 1960210001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-10',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '10',
            'amd_type' => 'regular',
            'class_roll' => '10',
            'tution_fee' => '2333',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1019',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 10 2st part
        $x = 50;
        $b = 1960210100; //end value
        for($a = 1960210051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-10',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '10',
            'amd_type' => 'regular',
            'class_roll' => '10',
            'tution_fee' => '2990',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1020',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //--------------------------------------------------
        //class 11 1st part
        $x = 0;
        $b = 1960211050; //end value
        for($a = 1960211001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-11',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '11',
            'amd_type' => 'regular',
            'class_roll' => '11',
            'tution_fee' => '2110',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1121',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 11 2st part
        $x = 50;
        $b = 1960211100; //end value
        for($a = 1960211051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-11',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '11',
            'amd_type' => 'regular',
            'class_roll' => '11',
            'tution_fee' => '2550',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1122',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //------------------------------------------------------
        //class 12 1st part
        $x = 0;
        $b = 1960212050; //end value
        for($a = 1960212001; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-12',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '12',
            'amd_type' => 'regular',
            'class_roll' => '12',
            'tution_fee' => '2220',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1223',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
        //class 12 2st part
        $x = 50;
        $b = 1960212100; //end value
        for($a = 1960212051; $a<=$b; $a++){ //$a is start value
            $x++;

            $student[] = [
            'name' => 'Md Hafiz Al Foisal-12',
            'school_name' => 'Bangladesh University Business and Technology',
            'std_id' => $a,
            'amd_class' => '12',
            'amd_type' => 'regular',
            'class_roll' => '12',
            'tution_fee' => '2369',
            'address' => 'Rupnagar Residential area',
            'guardian_name' => 'Mr qwer',
            'grd_phone' => '1233456',
            'std_phone' => '1233456',
            'std_serial' => $x,
            'reference' => 'AL',
            'section' => 'B-1224',
            'commitment' => 'Regular student so no commitment',
            'inst_identity' => '602',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        CoachingStudent::insert($student);
        $student = null;
        }
    }
}
