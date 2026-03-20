<?php
/**
 * API endpoint: Returns this company's users as JSON.
 * Other companies (B, C) use CURL to call this URL.
 *
 * Response format:
 * {"company":"A","company_name":"Echo Creative Studio (A)","users":[...]}
 */
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once dirname(__DIR__) . '/config/companies_config.php';
require_once dirname(__DIR__) . '/includes/db.php';

$users = getLocalUsers();

echo json_encode([
    'company' => 'A',
    'company_name' => COMPANY_A_NAME,
    'users' => $users,
]);
