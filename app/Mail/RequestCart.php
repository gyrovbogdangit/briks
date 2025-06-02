<?php

namespace App\Mail;

use App\Services\CartService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Propaganistas\LaravelPhone\PhoneNumber;
use Illuminate\Support\Collection;

class RequestCart extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $phone;
    public $comment;
    public $products;
    public $city;

    public $totalQuantity;
    public $totalSum;

    /**
     * Create a new message instance.
     */
    public function __construct(string $name, string $phone, ?string $comment, Collection $products, float $totalSum, ?string $city)
    {
        $this->name = $name;
        $this->phone = new PhoneNumber($phone, 'RU');
        $this->comment = $comment;
        $this->products = $products;
        $this->city = $city;
        $this->totalSum = $totalSum;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Заявка на оформление заказа',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.request-cart',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
