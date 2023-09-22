@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'SIP UJIAN')
            SIP UJIAN
            <br>Politeknik Negeri Cilacap
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
