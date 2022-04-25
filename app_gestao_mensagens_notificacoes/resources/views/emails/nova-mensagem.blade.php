@component('mail::message')
Data de criação da mensagem: {{ date('d/m/Y H:i:s', strtotime($mensagem->created_at)) }}

Mensagem: {{ $mensagem->mensagem }}

@component('mail::button', ['url' => $url ])
Clique aqui para ver a mensagem
@endcomponent

Atenciosamente,<br>
{{ config('app.name') }}
@endcomponent
