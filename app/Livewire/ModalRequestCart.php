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
