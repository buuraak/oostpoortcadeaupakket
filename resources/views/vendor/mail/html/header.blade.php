<tr>
        <td class="header">
            @if($type == 'kerst')
                <img src="{{ url('/') }}/images/kerstHeader.jpg" style="width: 800px;max-width: 800px" width="800" alt="cadeaupakketen actie" title="oostpoort cadeaupakket">
            @elseif($type == 'sinterklaas')
                <img src="{{ url('/') }}/images/SinterHeader.jpg" style="width: 800px;max-width: 800px" width="800" alt="cadeaupakketen actie" title="oostpoort cadeaupakket">
            @else
                <img src="{{ url('/') }}/images/header.jpg" style="width: 800px;max-width: 800px" width="800" alt="cadeaupakketen actie" title="oostpoort cadeaupakket">
            @endif
        </td>
</tr>
