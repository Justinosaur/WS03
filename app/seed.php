<?php

require_once __DIR__ . '/helpers.php';
require basePath('Database.php');
require basePath('models/JobListing.php');
use App\Models\JobListing;

$config = require basePath('config/db.php');
$db = new \Database($config);

$db->query('DELETE FROM listings');

$jobListings = [
    [
        'user_id' => 1,
        'title' => 'Frontend Engineer',
        'description' => 'Build polished web interfaces for a fast-moving product team.',
        'salary' => '96000',
        'tags' => 'frontend,react,ui,css',
        'company' => 'Northstar Digital',
        'address' => '88 Market Loop',
        'city' => 'Denver',
        'state' => 'NY',
        'phone' => '303-555-0148',
        'email' => 'careers@northstardigital.com',
        'requirements' => '3+ years of frontend experience, strong HTML/CSS/JavaScript skills, familiar with React.',
        'benefits' => 'Flexible schedule, annual learning budget, health coverage'
    ],
    [
        'user_id' => 1,
        'title' => 'Operations Coordinator',
        'description' => 'Support daily operations, scheduling, and internal process coordination.',
        'salary' => '62000',
        'tags' => 'operations,coordination,admin',
        'company' => 'Summit Bridge Group',
        'address' => '410 Pine Street',
        'city' => 'Seattle',
        'state' => 'WA',
        'phone' => '206-555-0194',
        'email' => 'team@summitbridgegroup.com',
        'requirements' => 'Strong communication, detail-oriented, and experience with office workflows.',
        'benefits' => 'Paid time off, remote Fridays, company wellness allowance'
    ],
    [
        'user_id' => 1,
        'title' => 'Content Writer',
        'description' => 'Write landing pages, product copy, and blog posts that connect with users.',
        'salary' => '58000',
        'tags' => 'writing,content,seo,marketing',
        'company' => 'Papertrail Studio',
        'address' => '55 River Road',
        'city' => 'Austin',
        'state' => 'TX',
        'phone' => '512-555-0177',
        'email' => 'hello@papertrailstudio.com',
        'requirements' => 'Portfolio of writing samples, grammar precision, and familiarity with SEO basics.',
        'benefits' => 'Hybrid work, creative team, monthly training stipend'
    ],
    [
        'user_id' => 1,
        'title' => 'Support Analyst',
        'description' => 'Handle customer issues, document trends, and improve support workflows.',
        'salary' => '67000',
        'tags' => 'support,customer-service,analysis',
        'company' => 'ClearPath Systems',
        'address' => '900 Lakeview Blvd',
        'city' => 'Orlando',
        'state' => 'FL',
        'phone' => '407-555-0133',
        'email' => 'jobs@clearpathsystems.com',
        'requirements' => 'Customer support experience, strong problem solving, and comfort with ticketing tools.',
        'benefits' => 'Medical coverage, paid holidays, growth path to senior support roles'
    ],
    [
        'user_id' => 1,
        'title' => 'UI Designer',
        'description' => 'Design interfaces for a mobile-first product with a focus on accessibility.',
        'salary' => '78000',
        'tags' => 'ui,design,accessibility,figma',
        'company' => 'Brightline Apps',
        'address' => '12 Cedar Avenue',
        'city' => 'Portland',
        'state' => 'OR',
        'phone' => '503-555-0118',
        'email' => 'design@brightlineapps.com',
        'requirements' => 'Strong portfolio, Figma expertise, and experience designing responsive interfaces.',
        'benefits' => 'Flexible hours, conference budget, modern design tools'
    ],
    [
        'user_id' => 1,
        'title' => 'Junior QA Tester',
        'description' => 'Test new features, document bugs, and help improve product reliability.',
        'salary' => '54000',
        'tags' => 'qa,testing,automation',
        'company' => 'LatchPoint Labs',
        'address' => '321 Orchard Lane',
        'city' => 'Nashville',
        'state' => 'TN',
        'phone' => '615-555-0186',
        'email' => 'hiring@latchpointlabs.com',
        'requirements' => 'Attention to detail, familiarity with test cases, and a willingness to learn automation.',
        'benefits' => 'Mentorship, paid training, and relaxed dress code'
    ],
];

foreach ($jobListings as $listingData) {
    $listing = new JobListing($listingData);

    try {
        $listing->save();
        echo "Saved: {$listingData['title']}\n";
    } catch (Exception $e) {
        echo "Error saving listing ({$listingData['title']}): " . $e->getMessage() . "\n";
    }
}

echo "Seeding complete.\n";

?>