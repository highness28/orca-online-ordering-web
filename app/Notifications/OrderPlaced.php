<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlaced extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $customerInfo;
    public $cartContent;
    public $cartTotal;
    public $paymentMode;
    
    public function __construct($customerInfo, $cartContent, $cartTotal, $paymentMode)
    {
        $this->customerInfo = $customerInfo;
        $this->cartContent = $cartContent;
        $this->cartTotal = $cartTotal;
        $this->paymentMode = $paymentMode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Purchase Order')
                    ->markdown('mail.orders.placed', [
                        'customer' => $this->customerInfo,
                        'orders' => $this->cartContent,
                        'total' => $this->cartTotal,
                        'payment_mode' => $this->paymentMode
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
