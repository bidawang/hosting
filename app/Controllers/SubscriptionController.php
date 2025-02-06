<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\SubscriptionModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SubscriptionController extends BaseController
{

    public function index()
    {
        // Create an instance of the Subscription model
        $subsModel = new SubscriptionModel();
    
        // Fetch subscriptions with customer data
        $data['subscription'] = $subsModel->getOrderWithCustomer();
    
        // Calculate remaining days for each subscription
        foreach ($data['subscription'] as &$sub) {
            // Current date
            $currentDate = new DateTime();
    
            // Expiry date of the subscription
            $expirationDate = new DateTime($sub['expirated_date']);
    
            // Calculate the difference between the current date and expiry date
            $interval = $currentDate->diff($expirationDate);
            $remainingDays = (int) $interval->format('%r%a');
    
            // Store the remaining days in the subscription array
            $sub['remaining_days'] = $remainingDays;
        }
    
        // Sort the subscriptions by expirated_date (ascending order: closest expiry first)
        usort($data['subscription'], function($a, $b) {
            $dateA = new DateTime($a['expirated_date']);
            $dateB = new DateTime($b['expirated_date']);
            return $dateA <=> $dateB; // Ascending order (closest expiry first)
        });
    
        // Send data to the view
        return view('Admin/dashboard', $data);
    }
    


//kirim notifikasi melalui gmail

    public function checkExpirationDates()
{
    $subsModel = new SubscriptionModel();
    $userModel = new UserModel();

    // Get all subscriptions
    $subscriptions = $subsModel->getOrderWithCustomer();

    // Loop through each subscription to check expiration date
    foreach ($subscriptions as &$sub) {
        // Current date
        $currentDate = new DateTime();

        // Expiry date of the subscription
        $expirationDate = new DateTime($sub['expirated_date']);

        // Calculate the difference between the current date and expiry date
        $interval = $currentDate->diff($expirationDate);
        $remainingDays = (int) $interval->format('%r%a');

        // Store the remaining days in the subscription array
        $sub['remaining_days'] = $remainingDays;

        // Check conditions to send notifications
        if ($remainingDays === 7) {
            // Send email notification 7 days before expiry
            $this->sendNotification($sub['email'], "Peringatan: Paket Hosting Akan Expired Dalam 7 Hari", "Paket hosting Anda akan kadaluarsa dalam 7 hari. Segera perpanjang.");
        } elseif ($remainingDays === 1) {
            // Send email notification 1 day before expiry
            $this->sendNotification($sub['email'], "Peringatan: Paket Hosting Akan Expired Besok", "Paket hosting Anda akan kadaluarsa besok. Segera perpanjang.");
        } elseif ($remainingDays < 0) {
            // Send email notification when expired
            $this->sendNotification($sub['email'], "Paket Hosting Sudah Expired", "Paket hosting Anda telah kadaluarsa. Silakan hubungi kami untuk memperpanjang.");

            // Send email notification to all admins
            $adminEmails = $userModel->getAdminEmails(); 
            foreach ($adminEmails as $admin) {
                $this->sendNotification($admin['email'], "Paket Hosting Pengguna {$sub['nama_lengkap']} Sudah Expired", "Paket hosting pengguna {$sub['nama_lengkap']} telah kadaluarsa.");
            }
        }
    }

    // Return the updated subscriptions
    return $subscriptions;
}


    private function sendNotification($to, $subject, $message)
    {
        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setSubject($subject);
        $email->setMessage($message);

        if (!$email->send()) {
            // Logging atau debug jika gagal mengirim email
            log_message('error', 'Gagal mengirim email ke ' . $to . ': ' . print_r($email->printDebugger(['headers']), true));
        }
    }
}
