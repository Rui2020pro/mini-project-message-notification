<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Gestão de Mensagens e Notificações')
<img src="{{ asset('img/logo.png') }}" class="logo" alt="Gestão de Mensagens e Notificações">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
