<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Mail\RequestPrice;
use App\Services\CustomerService;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;

class ModalRequestPrice extends Component
{
    public $product;

    #[Validate('required', message: 'Укажите ваше имя.', translate: false)]
    public $name;

    #[Validate('required', message: 'Укажите ваш номер телефона.', translate: false)]
    #[Validate('phone:RU', message: 'Укажите валидный номер телефона.', translate: false)]
    public $phone;

    public $comment;

    #[Validate('nullable')]
    #[Validate('numeric', message: 'Укажите число.', translate: false)]
    #[Validate('min:0', message: 'Укажите положительное число.', translate: false)]
    public $quantity;

    #[Validate('accepted', message: 'Примите пользовательское соглашение.', translate: false)]
    public $privacy;

    public $emailSended = false;

    public function render()
    {
        return view('livewire.modal-request-price');
    }

    public function sendEmail()
    {
        $this->validate();

        $product = Product::with(
            'subcategory.category.productType',
        )->findOrFail($this->product->id);

        Mail::to(env('MAIL_TO_ADDRESS'))->queue(new RequestPrice(
            $this->name,
            $this->phone,
            $this->comment,
            $this->quantity,
            $product,
            CustomerService::getCity()
        ));

        $this->emailSended = true;
    }
}
