<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\RequestCart;
use App\Services\CartService;
use App\Services\CustomerService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;

class ModalRequestCart extends Component
{
    #[Validate('required', message: 'Укажите ваше имя.', translate: false)]
    public $name;

    #[Validate('required', message: 'Укажите ваш номер телефона.', translate: false)]
    #[Validate('phone:RU', message: 'Укажите валидный номер телефона.', translate: false)]
    public $phone;

    public $comment;

    #[Validate('accepted', message: 'Примите пользовательское соглашение.', translate: false)]
    public $privacy;

    public $emailSended = false;

    public function render()
    {
        return view('livewire.modal-request-cart');
    }

    public function getOrderData()
    {
        $products = CartService::get();
        $totalSum = CartService::getTotalSum();

        $orderText = "Заказ:\n";
        $orderText .= "Товары:\n";
        
        foreach ($products as $product) {
            if ($product->unit === 'sqm') {
                $price = $product->discount_price_sqm ?? $product->price_sqm;
                $unit = 'м²';
            } elseif ($product->unit === 'm3') {
                $price = $product->discount_price_m3 ?? $product->price_m3;
                $unit = 'м³';
            } else {
                $price = $product->discount_price_per_piece ?? $product->price_per_piece;
                $unit = 'шт';
            }
            
            $orderText .= "- {$product->name}\n";
            $orderText .= "  Количество: {$product->quantity} {$unit}\n";
            $orderText .= "  Цена за единицу: {$price} руб.\n";
            $orderText .= "  Сумма: " . ($price * $product->quantity) . " руб.\n\n";
        }
        
        $orderText .= "Общая сумма: {$totalSum} руб.\n";
        $orderText .= "Доставка: Не указано\n";
        $orderText .= "Адрес доставки: " . (CustomerService::getCity() ?? 'Не указан') . "\n";
        
        if ($this->comment) {
            $orderText .= "Комментарий: {$this->comment}\n";
        }
        
        return $orderText;
    }

    public function sendEmail()
    {
        $this->validate();

        $products = CartService::get();
        $totalSum = CartService::getTotalSum();

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new RequestCart(
            $this->name,
            $this->phone,
            $this->comment,
            $products,
            $totalSum,
            CustomerService::getCity()
        ));

        $this->emailSended = true;
    }
}
