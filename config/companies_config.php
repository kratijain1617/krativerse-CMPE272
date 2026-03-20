<?php
/**
 * CURL Lab - Company API URLs
 * 
 * Expected API response format:
 * {"company_name":"...","users":[{"id":1,"name":"...","email":"...","role":"..."}]}
 */
define('COMPANY_A_NAME', 'Echo Creative Studio (A)');
define('COMPANY_B_API_URL', 'https://geeshitha.com/nexus_academy/api/users.php');  // Nexus Academy (teammate)
define('USE_FALLBACK_WHEN_CURL_BLOCKED', true);  // Company B API returns HTML (bot block) via CURL; use fallback so lab works
