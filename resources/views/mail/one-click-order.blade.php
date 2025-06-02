@extends('layouts.mail')

@section('content')
    <div
        style="background:#fff;border-radius:12px;box-shadow:0 2px 12px #e5e5e5;padding:32px 24px;max-width:600px;margin:32px auto;">
        <h1 style="font-size:24px;font-weight:700;color:#027d8a;margin-bottom:24px;">Заказ в 1 клик</h1>
        <div class="email-content" style="margin-bottom:24px;">
            @include('mail.components.client')
            @include('mail.components.comment')
            @include('mail.components.product-name')
            @isset($quantity)
                <section style="margin-top:12px;">
                    <p style="font-size:16px;"><b>В количестве:</b> <span style="color:#027d8a;">{{ $quantity }} шт.</span>
                    </p>
                </section>
            @endisset
        </div>
        <div style="border-top:1px solid #eaeaea;padding-top:16px;color:#888;font-size:13px;">
            Это письмо отправлено автоматически с сайта <a href="https://briks1.ru"
                style="color:#027d8a;text-decoration:none;">briks1.ru</a>
        </div>
    </div>
@endsection
