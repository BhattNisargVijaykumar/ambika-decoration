<?php
/**
 * Ambika Decoretors & Party Plot - PHP Inquiry API Endpoint
 */

header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Get raw JSON input or Form POST
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    $input = $_POST;
}

$user_name = isset($input['user_name']) ? trim(filter_var($input['user_name'], FILTER_SANITIZE_STRING)) : '';
$venue = isset($input['venue']) ? trim(filter_var($input['venue'], FILTER_SANITIZE_STRING)) : 'Pooja Farm';
$event_type = isset($input['event_type']) ? trim(filter_var($input['event_type'], FILTER_SANITIZE_STRING)) : 'Wedding & Reception';
$guest_count = isset($input['guest_count']) ? trim(filter_var($input['guest_count'], FILTER_SANITIZE_STRING)) : '500-1000 Guests';
$event_date = isset($input['event_date']) ? trim(filter_var($input['event_date'], FILTER_SANITIZE_STRING)) : date('Y-m-d');
$notes = isset($input['notes']) ? trim(filter_var($input['notes'], FILTER_SANITIZE_STRING)) : '';

if (empty($user_name)) {
    echo json_encode(['success' => false, 'error' => 'Please provide your name']);
    exit;
}

// Format WhatsApp Message
$message = "Hello Ambika Decoretors! 🌟\n";
$message .= "My name is *" . $user_name . "*.\n\n";
$message .= "I would like to inquire about event booking:\n";
$message .= "• *Preferred Venue:* " . $venue . "\n";
$message .= "• *Event Type:* " . $event_type . "\n";
$message .= "• *Guests Count:* " . $guest_count . "\n";
$message .= "• *Event Date:* " . $event_date . "\n";
if (!empty($notes)) {
    $message .= "• *Special Note:* " . $notes . "\n";
}
$message .= "\nPlease share package options, plot availability, and catering menu PDF. Thank you!";

$recipient = isset($input['recipient']) ? preg_replace('/[^0-9]/', '', $input['recipient']) : WHATSAPP_NUMBER_1;
if (empty($recipient)) {
    $recipient = WHATSAPP_NUMBER_1;
}

$whatsapp_url = "https://wa.me/" . $recipient . "?text=" . urlencode($message);

// Log inquiry to file
$data_dir = __DIR__ . '/../data';
if (!is_dir($data_dir)) {
    @mkdir($data_dir, 0755, true);
}

$log_file = $data_dir . '/inquiries.json';
$inquiries = [];
if (file_exists($log_file)) {
    $existing = json_decode(file_get_contents($log_file), true);
    if (is_array($existing)) {
        $inquiries = $existing;
    }
}

$inquiries[] = [
    'id' => time(),
    'name' => $user_name,
    'event_type' => $event_type,
    'guest_count' => $guest_count,
    'event_date' => $event_date,
    'notes' => $notes,
    'timestamp' => date('c')
];

file_put_contents($log_file, json_encode($inquiries, JSON_PRETTY_PRINT));

echo json_encode([
    'success' => true,
    'message' => 'Inquiry created successfully',
    'whatsapp_url' => $whatsapp_url,
    'data' => [
        'name' => $user_name,
        'event_type' => $event_type,
        'guest_count' => $guest_count,
        'event_date' => $event_date
    ]
]);
