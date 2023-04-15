<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    public static array $departments = [
        [
            'faculty_id' => 1,
            'name' => 'Auditing and Taxation',
            'email' => 'phumzilem1@dut.ac.za',
            'contact_number' => '031 373 5610',
        ],
        [
            'faculty_id' => 1,
            'name' => 'Finance and Information Management',
            'email' => 'janet@dut.ac.za',
            'contact_number' => '033 845 8862',
        ],
        [
            'faculty_id' => 1,
            'name' => 'Financial Accounting',
            'email' => 'thabisilem@dut.ac.za',
            'contact_number' => '031 373 5621',
        ],
        [
            'faculty_id' => 1,
            'name' => 'Information and Corporate Management',
            'email' => 'Alvinettes@dut.ac.za',
            'contact_number' => '031 373 5655',
        ],
        [
            'faculty_id' => 1,
            'name' => 'Information Technology',
            'email' => 'ITDept@dut.ac.za',
            'contact_number' => '031 373 5596',
        ],
        [
            'faculty_id' => 1,
            'name' => 'Management Accounting',
            'email' => 'bongekilen@dut.ac.za',
            'contact_number' => '031 373 5664',
        ],

        [
            'faculty_id' => 2,
            'name' => 'Biotechnology and Food Science',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Chemistry',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Textile Science and Apparel Technology',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Consumer Sciences Food and Nutrition',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Horticulture',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Maritime Studies',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Mathematics',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Physics',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Statistics',
        ],
        [
            'faculty_id' => 2,
            'name' => 'Sport Studies',
        ],

        [
            'faculty_id' => 3,
            'name' => 'Drama & Production Studies',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Fashion and Textiles',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Fine Art and Jewellery Design',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Media, Language and Communication',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Education',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Video Technology',
        ],
        [
            'faculty_id' => 3,
            'name' => 'Visual Communication',
        ],

        [
            'faculty_id' => 4,
            'name' => 'Architecture',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Chemical Engineering',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Civil Engineering and Geomatics (Durban)',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Civil Engineering (Midlands)',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Construction Management and Quantity Surveying',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Electrical Power Engineering',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Electronic and Computer Engineering',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Industrial Engineering',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Mechanical Engineering',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Town and Regional Planning',
        ],
        [
            'faculty_id' => 4,
            'name' => 'Urban Futures Centre',
        ],

        [
            'faculty_id' => 5,
            'name' => 'Basic Medical Sciences Department',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Biomedical and Clinical Technology',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Chiropractic',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Community Health Studies',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Dental Sciences',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Emergency Medical Care and Rescue',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Homoeopathy',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Medical Orthotics and Prosthetics',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Nursing',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Radiography',
        ],
        [
            'faculty_id' => 5,
            'name' => 'Somatology',
        ],

        [
            'faculty_id' => 6,
            'name' => 'Applied Law',
        ],
        [
            'faculty_id' => 6,
            'name' => 'DUT Business School',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Ecotourism',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Entrepreneurial Studies and Management',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Hospitality and Tourism',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Human Resources Management',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Marketing and Retail',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Operations and Quality Management',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Public Management and Economics',
        ],
        [
            'faculty_id' => 6,
            'name' => 'Public Relations Management',
        ],

    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = $this->faker->unique()->randomElement(self::$departments);

        return [
            'faculty_id' => $departments['faculty_id'],
            'name' => $departments['name'],
            'description' => $this->faker->realText(),
            'email' => $departments['email'] ?? $this->faker->username().'@dut.ac.za',
            'contact_number' => $departments['contact_number'] ?? $this->faker->phoneNumber(),
        ];
    }
}
