@props(['url'])
<tr>
<td class="header" style="padding: 0 !important; margin-top:25px;">
<table class="text-center header-table" align="center" border="0" cellpadding="0" cellspacing="0" width="570"
style="background-color: #f7f7f7; color: white; padding: 10px; overflow: hidden; z-index: 0; margin-top:0 !important;">
    <tr>
        <td>
            <a href="{{ $url }}" style="display: inline-block;">
                @if (trim($slot) === 'Laravel')
                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo" style="max-width:150px;">
                @else
                <img src="{{ asset('img/logo.png') }}" class="logo" alt="Tasty House" style="max-width:120px; height:auto;">
                @endif
            </a>
        </td>
    </tr>
</table>
</td>
</tr>
