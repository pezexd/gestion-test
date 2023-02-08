<table>
    <thead>
    <tr>
        <th>It</th>
        <th>Nombre</th>
        <th>Cedula</th>
        @php
            $fechaInicio=strtotime($dateInicio);
            $fechaFin=strtotime($dateFin);
        @endphp
        @for ($i = $fechaInicio; $i <= $fechaFin; $i+=86400)
            <th>{{ date("Y-m-d", $i) }}</th>
        @endfor
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $key => $invoice)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->email }}</td>
            @php
                $fechaInicio=strtotime($dateInicio);
                $fechaFin=strtotime($dateFin);
            @endphp
            @for ($i = $fechaInicio; $i <= $fechaFin; $i+=86400)
                @php
                    $conteo = 0;
                @endphp
                @foreach ($invoice->loginaccess as $login)
                    @if ($i == strtotime($login->date))
                        @php
                            $conteo++;
                        @endphp
                    @endif
                @endforeach
                <td>{{ $conteo }}</td>
            @endfor
        </tr>
    @endforeach
    </tbody>
</table>
