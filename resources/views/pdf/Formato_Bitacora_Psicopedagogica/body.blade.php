<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex,nofollow" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0;" />
    <style type="text/css">
        body {
            font-family: Verdana;
            margin-top: 150px;
        }

        .even {
            background: #fbf8f0;
        }

        .odd {
            background: #fefcf9;
        }

        .page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }

        .ocultarcolumnas{
            visibility:hidden;
        }

        table , td, th {
            border: 1px solid #595959;
            border-collapse: collapse;
        }
        td, th {
            padding: 3px;
            width: 30px;
            height: 25px;
        }
        th {
            background: #f0e6cc;
        }
        .even {
            background: #fbf8f0;
        }
        .odd {
            background: #fefcf9;
        }
        p{
            font-size:16px;
        }
    </style>
</head>

<body class="img1">
    <div class="">
        <tr>
            <table width="100%" style="">
                <thead>
                    <tr>
                        <td class="ocultarcolumnas" style="width: 2%">1</td>
                        <td class="ocultarcolumnas" style="width: 2%">2</td>
                        <td class="ocultarcolumnas" style="width: 2%">3</td>
                        <td class="ocultarcolumnas" style="width: 2%">4</td>
                        <td class="ocultarcolumnas" style="width: 2%">5</td>
                        <td class="ocultarcolumnas" style="width: 2%">6</td>
                        <td class="ocultarcolumnas" style="width: 2%">7</td>
                        <td class="ocultarcolumnas" style="width: 2%">8</td>
                        <td class="ocultarcolumnas" style="width: 2%">9</td>
                        <td class="ocultarcolumnas" style="width: 2%">10</td>
                        <td class="ocultarcolumnas" style="width: 2%">11</td>
                        <td class="ocultarcolumnas" style="width: 2%">12</td>
                        <td class="ocultarcolumnas" style="width: 2%">13</td>
                        <td class="ocultarcolumnas" style="width: 2%">14</td>
                        <td class="ocultarcolumnas" style="width: 2%">15</td>
                        <td class="ocultarcolumnas" style="width: 2%">16</td>
                        <td class="ocultarcolumnas" style="width: 2%">17</td>
                        <td class="ocultarcolumnas" style="width: 2%">18</td>
                        <td class="ocultarcolumnas" style="width: 2%">19</td>
                        <td class="ocultarcolumnas" style="width: 2%">20</td>
                        <td class="ocultarcolumnas" style="width: 2%">21</td>
                        <td class="ocultarcolumnas" style="width: 2%">22</td>
                        <td class="ocultarcolumnas" style="width: 2%">23</td>
                        <td class="ocultarcolumnas" style="width: 2%">24</td>
                        <td class="ocultarcolumnas" style="width: 2%">25</td>
                        <td class="ocultarcolumnas" style="width: 2%">26</td>
                        <td class="ocultarcolumnas" style="width: 2%">27</td>
                        <td class="ocultarcolumnas" style="width: 2%">28</td>
                        <td class="ocultarcolumnas" style="width: 2%">29</td>
                        <td class="ocultarcolumnas" style="width: 2%">30</td>
                        <td class="ocultarcolumnas" style="width: 2%">31</td>
                        <td class="ocultarcolumnas" style="width: 2%">32</td>
                        <td class="ocultarcolumnas" style="width: 2%">33</td>
                        <td class="ocultarcolumnas" style="width: 2%">34</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="34" style="background: #164E63">
                            <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo1'] }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.1 Facilitador:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{-- substr($data->date,0,10) --}}
                            </p>
                        </td>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.6 Fecha:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ substr($data->date,0,10) }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.2 Nombre de la persona atendida:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ $data->person_served_name }}
                            </p>
                        </td>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.7 Hora Inicio:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ substr($data->start_time,11,19) }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.3 Nodo de atención cultural:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ $data->nac->name }}
                            </p>
                        </td>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.8 Hora Final:</b>
                            </p>
                        </td>
                        <td colspan="8" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ substr($data->final_time,11,19) }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.4 Nombre de la persona atendida:</b>
                            </p>
                        </td>
                        <td colspan="25" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ $data->person_served_name }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="9" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>1.5 Nombre del monitor cultural:</b>
                            </p>
                        </td>
                        <td colspan="25" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                {{ $data->monitor->name }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" style="">
                <thead>
                    <tr>
                        <td class="ocultarcolumnas" style="width: 2%">1</td>
                        <td class="ocultarcolumnas" style="width: 2%">2</td>
                        <td class="ocultarcolumnas" style="width: 2%">3</td>
                        <td class="ocultarcolumnas" style="width: 2%">4</td>
                        <td class="ocultarcolumnas" style="width: 2%">5</td>
                        <td class="ocultarcolumnas" style="width: 2%">6</td>
                        <td class="ocultarcolumnas" style="width: 2%">7</td>
                        <td class="ocultarcolumnas" style="width: 2%">8</td>
                        <td class="ocultarcolumnas" style="width: 2%">9</td>
                        <td class="ocultarcolumnas" style="width: 2%">10</td>
                        <td class="ocultarcolumnas" style="width: 2%">11</td>
                        <td class="ocultarcolumnas" style="width: 2%">12</td>
                        <td class="ocultarcolumnas" style="width: 2%">13</td>
                        <td class="ocultarcolumnas" style="width: 2%">14</td>
                        <td class="ocultarcolumnas" style="width: 2%">15</td>
                        <td class="ocultarcolumnas" style="width: 2%">16</td>
                        <td class="ocultarcolumnas" style="width: 2%">17</td>
                        <td class="ocultarcolumnas" style="width: 2%">18</td>
                        <td class="ocultarcolumnas" style="width: 2%">19</td>
                        <td class="ocultarcolumnas" style="width: 2%">20</td>
                        <td class="ocultarcolumnas" style="width: 2%">21</td>
                        <td class="ocultarcolumnas" style="width: 2%">22</td>
                        <td class="ocultarcolumnas" style="width: 2%">23</td>
                        <td class="ocultarcolumnas" style="width: 2%">24</td>
                        <td class="ocultarcolumnas" style="width: 2%">25</td>
                        <td class="ocultarcolumnas" style="width: 2%">26</td>
                        <td class="ocultarcolumnas" style="width: 2%">27</td>
                        <td class="ocultarcolumnas" style="width: 2%">28</td>
                        <td class="ocultarcolumnas" style="width: 2%">29</td>
                        <td class="ocultarcolumnas" style="width: 2%">30</td>
                        <td class="ocultarcolumnas" style="width: 2%">31</td>
                        <td class="ocultarcolumnas" style="width: 2%">32</td>
                        <td class="ocultarcolumnas" style="width: 2%">33</td>
                        <td class="ocultarcolumnas" style="width: 2%">34</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="34" style="background: #164E63">
                            <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo2'] }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="13" rowspan="2">
                            <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                <b>2.1 Objetivo</b>
                            </p>
                        </td>
                        <td colspan="21" rowspan="2">
                            <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                {{ $data->objective }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="13" rowspan="2">
                            <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                <b>2.2 Desarrollo</b>
                            </p>
                        </td>
                        <td colspan="21" rowspan="2">
                            <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                {{ $data->development }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="13" rowspan="2">
                            <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                <b>2.3 Remisiones</b>
                            </p>
                        </td>
                        <td colspan="21" rowspan="2">
                            <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                {{ $data->referrals }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="13" rowspan="2">
                            <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                <b>2.4 Conclusiones y reflexiones</b>
                            </p>
                        </td>
                        <td colspan="21" rowspan="2">
                            <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                {{ $data->conclusions_reflections_commitments }}
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="13" rowspan="2">
                            <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                <b>2.5 Reporte alertas para hacer seguimiento</b>
                            </p>
                        </td>
                        <td colspan="21" rowspan="2">
                            <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                {{ $data->alert_reporting_tracking }}
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" style="">
                <thead>
                    <tr>
                        <td class="ocultarcolumnas" style="width: 2%">1</td>
                        <td class="ocultarcolumnas" style="width: 2%">2</td>
                        <td class="ocultarcolumnas" style="width: 2%">3</td>
                        <td class="ocultarcolumnas" style="width: 2%">4</td>
                        <td class="ocultarcolumnas" style="width: 2%">5</td>
                        <td class="ocultarcolumnas" style="width: 2%">6</td>
                        <td class="ocultarcolumnas" style="width: 2%">7</td>
                        <td class="ocultarcolumnas" style="width: 2%">8</td>
                        <td class="ocultarcolumnas" style="width: 2%">9</td>
                        <td class="ocultarcolumnas" style="width: 2%">10</td>
                        <td class="ocultarcolumnas" style="width: 2%">11</td>
                        <td class="ocultarcolumnas" style="width: 2%">12</td>
                        <td class="ocultarcolumnas" style="width: 2%">13</td>
                        <td class="ocultarcolumnas" style="width: 2%">14</td>
                        <td class="ocultarcolumnas" style="width: 2%">15</td>
                        <td class="ocultarcolumnas" style="width: 2%">16</td>
                        <td class="ocultarcolumnas" style="width: 2%">17</td>
                        <td class="ocultarcolumnas" style="width: 2%">18</td>
                        <td class="ocultarcolumnas" style="width: 2%">19</td>
                        <td class="ocultarcolumnas" style="width: 2%">20</td>
                        <td class="ocultarcolumnas" style="width: 2%">21</td>
                        <td class="ocultarcolumnas" style="width: 2%">22</td>
                        <td class="ocultarcolumnas" style="width: 2%">23</td>
                        <td class="ocultarcolumnas" style="width: 2%">24</td>
                        <td class="ocultarcolumnas" style="width: 2%">25</td>
                        <td class="ocultarcolumnas" style="width: 2%">26</td>
                        <td class="ocultarcolumnas" style="width: 2%">27</td>
                        <td class="ocultarcolumnas" style="width: 2%">28</td>
                        <td class="ocultarcolumnas" style="width: 2%">29</td>
                        <td class="ocultarcolumnas" style="width: 2%">30</td>
                        <td class="ocultarcolumnas" style="width: 2%">31</td>
                        <td class="ocultarcolumnas" style="width: 2%">32</td>
                        <td class="ocultarcolumnas" style="width: 2%">33</td>
                        <td class="ocultarcolumnas" style="width: 2%">34</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="34" style="background: #164E63">
                            <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo3'] }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="17" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>3.1 Foto que evidencia el desarrollo de la transferencia realizada</b>
                            </p>
                        </td>
                        <td colspan="17" rowspan="2">
                            <p style="text-align: left;margin-top: -1%;margin-bottom:0%">
                                <b>3.2 Foto que evidencie la participación de los asistentes en la transferencia</b>
                            </p>
                        </td>
                    </tr>
                    <tr></tr>
                    <tr>
                        <td colspan="17" rowspan="2">
                            @if (asset($data->development_activity_image))
                                <p style="text-align: center">Sin Imagen</p>
                            @else
                            @php
                                $im1 = imagecreatefromwebp(storage_path().'/app/public/'.$data->development_activity_image);
                                imagejpeg($im1, './img/Reportes/Bitacora_Psicopedagogica/development_activity_image.jpeg', 100);
                            @endphp
                                <img style="width:100%;height: 560px;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/img/Reportes/Bitacora_Psicopedagogica/development_activity_image.jpeg'))}}">
                            @endif
                        </td>
                        <td colspan="17" rowspan="2">
                            @if (asset($data->evidence_participation_image))
                                <p style="text-align: center">Sin Imagen</p>
                            @else
                            @php
                                $im2 = imagecreatefromwebp(storage_path().'/app/public/'.$data->evidence_participation_image);
                                imagejpeg($im2, './img/Reportes/Bitacora_Psicopedagogica/evidence_participation_image.jpeg', 100);
                            @endphp
                                <img style="width:100%;height: 560px;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path().'/img/Reportes/Bitacora_Psicopedagogica/evidence_participation_image.jpeg'))}}">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <table width="100%" style="">
                <thead>
                    <tr>
                        <td class="ocultarcolumnas" style="width: 2%">1</td>
                        <td class="ocultarcolumnas" style="width: 2%">2</td>
                        <td class="ocultarcolumnas" style="width: 2%">3</td>
                        <td class="ocultarcolumnas" style="width: 2%">4</td>
                        <td class="ocultarcolumnas" style="width: 2%">5</td>
                        <td class="ocultarcolumnas" style="width: 2%">6</td>
                        <td class="ocultarcolumnas" style="width: 2%">7</td>
                        <td class="ocultarcolumnas" style="width: 2%">8</td>
                        <td class="ocultarcolumnas" style="width: 2%">9</td>
                        <td class="ocultarcolumnas" style="width: 2%">10</td>
                        <td class="ocultarcolumnas" style="width: 2%">11</td>
                        <td class="ocultarcolumnas" style="width: 2%">12</td>
                        <td class="ocultarcolumnas" style="width: 2%">13</td>
                        <td class="ocultarcolumnas" style="width: 2%">14</td>
                        <td class="ocultarcolumnas" style="width: 2%">15</td>
                        <td class="ocultarcolumnas" style="width: 2%">16</td>
                        <td class="ocultarcolumnas" style="width: 2%">17</td>
                        <td class="ocultarcolumnas" style="width: 2%">18</td>
                        <td class="ocultarcolumnas" style="width: 2%">19</td>
                        <td class="ocultarcolumnas" style="width: 2%">20</td>
                        <td class="ocultarcolumnas" style="width: 2%">21</td>
                        <td class="ocultarcolumnas" style="width: 2%">22</td>
                        <td class="ocultarcolumnas" style="width: 2%">23</td>
                        <td class="ocultarcolumnas" style="width: 2%">24</td>
                        <td class="ocultarcolumnas" style="width: 2%">25</td>
                        <td class="ocultarcolumnas" style="width: 2%">26</td>
                        <td class="ocultarcolumnas" style="width: 2%">27</td>
                        <td class="ocultarcolumnas" style="width: 2%">28</td>
                        <td class="ocultarcolumnas" style="width: 2%">29</td>
                        <td class="ocultarcolumnas" style="width: 2%">30</td>
                        <td class="ocultarcolumnas" style="width: 2%">31</td>
                        <td class="ocultarcolumnas" style="width: 2%">32</td>
                        <td class="ocultarcolumnas" style="width: 2%">33</td>
                        <td class="ocultarcolumnas" style="width: 2%">34</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="34" style="background: #164E63">
                            <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo4'] }}</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>No</b>
                            </p>
                        </td>
                        <td colspan="4" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>NAC</b>
                            </p>
                        </td>
                        <td colspan="6" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>Nombre</b>
                            </p>
                        </td>
                        <td colspan="6" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>Documento de <br> identidad</b>
                            </p>
                        </td>
                        <td colspan="4" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>Cargo</b>
                            </p>
                        </td>
                        <td colspan="4" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>Teléfono</b>
                            </p>
                        </td>
                        <td colspan="6" rowspan="2">
                            <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                <b>Email</b>
                            </p>
                        </td>
                    </tr>
                    <tr></tr>

                    @php
                        $conteo = 1
                    @endphp
                    @foreach ($data->addedWizards as $addedWizards)
                        <tr>
                            <td colspan="4" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $conteo }}
                                </p>
                            </td>
                            <td colspan="4" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->nac->name }}
                                </p>
                            </td>
                            <td colspan="6" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->assistant_name }}
                                </p>
                            </td>
                            <td colspan="6" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->assistant_document_number }}
                                </p>
                            </td>
                            <td colspan="4" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->assistant_position }}
                                </p>
                            </td>
                            <td colspan="4" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->assistant_phone }}
                                </p>
                            </td>
                            <td colspan="6" rowspan="2">
                                <p style="text-align: center;margin-top: -1%;margin-bottom:0%">
                                    {{ $addedWizards->assistant_email }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        @php
                            $conteo++
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </tr>
    </div>
</body>

</html>
