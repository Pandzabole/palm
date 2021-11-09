<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Contact $contact */
    private $contact;

    /**
     * ContactNotification constructor.
     *
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->greeting(__('mails.common.greeting'))
            ->subject(__('mails.contact.subject'))
            ->line(__('mails.contact.name', ['name' => $this->contact->name]))
            ->line(__('mails.contact.email', ['email' => $this->contact->email]))
            ->line(__('mails.contact.message') . ': ')
            ->line($this->contact->description)
            ->salutation(new HtmlString(__('mails.common.regards') . ",<br>" .config('app.name')));
    }
}
