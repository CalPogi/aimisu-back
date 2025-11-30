<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run()
    {
        $orgs = [
            // Campus-Wide
            'campus' => [
                ['name' => 'Supreme Student Council'],
                ['name' => 'The Forum Publication']
            ],

            // College of Agriculture
            'CA' => [
                ['name' => 'Isabela Young Farmers Association'],
                ['name' => 'Philippine Junior Agricultural Executive Society'],
                ['name' => 'Student Body Organization-College of Agriculture'],
            ],

            // College of Arts and Sciences
            'CAS' => [
                ['name' => 'English Club'],
                ['name' => 'ISU Alliance of Chemistry Students'],
                ['name' => 'ISU Biological Society'],
                ['name' => 'ISU Mathematical Society'],
                ['name' => 'Mass Communication Society'],
                ['name' => 'The Psychological Society'],
                ['name' => 'Student Body Organization-College of Arts and Sciences'],
            ],

            // College of Education
            'CED' => [
                ['name' => 'Association of Early Childhood Educators'],
                ['name' => 'Bachelor of Physical Education Club'],
                ['name' => 'Confederation of Multiskilled Educators on Technology and Innovation'],
                ['name' => 'League of Math Wizards'],
                ['name' => 'Pampamantasang Samahan ng mga Tagapagtaguyod ng Wikang Filipino'],
                ['name' => 'Society of Elementary Educators'],
                ['name' => 'The Alliance of Social Science Educators'],
                ['name' => 'Writers\' Guild'],
                ['name' => 'ISU SHS Student Council'],
                ['name' => 'Student Body Organization-College of Education'],
            ],

            // Fill in with other departments (see your list) ...
        ];

        // Seed campus-wide orgs (not tied to a department)
        foreach ($orgs['campus'] as $org) {
            Organization::firstOrCreate([
                'name' => $org['name'],
                'department_id' => null
            ]);
        }
        unset($orgs['campus']);

        // Seed college/unit orgs
        foreach ($orgs as $deptCode => $organizations) {
            $dept = Department::where('code', $deptCode)->first();
            if (!$dept) continue;
            foreach ($organizations as $org) {
                Organization::firstOrCreate([
                    'name' => $org['name'],
                    'department_id' => $dept->id
                ]);
            }
        }
    }
}
