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
    <body class="">
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
                            <td colspan="34" style="background: #164E63">
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo2'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: center;margin-top: 0%;margin-bottom:0%">
                                    <b>¿Cómo se vinculo usted al proyecto?</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="17" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $linkage_projects = '';
                                        switch ($data->benefiary->linkage_project) {
                                            case 'PMIE':
                                                $linkage_projects = 'Por medio de una Institución educativa';
                                                break;
                                            case 'PMEPUB':
                                                $linkage_projects = 'Por medio de una Entidad pública';
                                                break;
                                            case 'PMEPRI':
                                                $linkage_projects = 'Por medio de una Entidad privada';
                                                break;
                                            case 'PMGCP':
                                                $linkage_projects = 'Por medio de un gestor cultural del proyecto';
                                                break;
                                            case 'PMMCP':
                                                $linkage_projects = 'Por medio de un monitor cultural del proyecto';
                                                break;
                                            case 'PMR':
                                                $linkage_projects = 'Por medio de un referido';
                                                break;
                                            default:
                                                $linkage_projects = 'Sin Vinculo';
                                                break;
                                        }
                                    @endphp
                                    {{ $linkage_projects }}
                                </p>
                            </td>
                            <td colspan="17" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    {{ $data->benefiary->user_id }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="17" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>Tipo de participante:</b>
                                </p>
                            </td>
                            <td colspan="17" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    {{ $data->benefiary->participant_type == 'C' ? 'Caracterizado' : 'No Caracterizado' }}
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
                            <td colspan="6" rowspan="10">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <center>
                                        <img style="width:50%;height: 115px; margin-top: 5%;" src="data:image/png;base64,{{ base64_encode(file_get_contents(storage_path().'/app/public/'.$data->benefiary->file))}}">
                                    </center>
                                </p>
                            </td>
                            <td colspan="18" rowspan="2">
                                <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                    <b>1.1 Fecha:</b>
                                </p>
                            </td>
                            <td colspan="10" rowspan="2">
                                <p style="text-align: justify;margin-top: 0%;margin-bottom:0%">
                                    <b>1.2 Nac:</b> {{ $data->benefiary->nac->name }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="28" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.3 Barrio:</b> {{ $data->benefiary->neighborhood->name }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="28" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.4 Estrato:</b> {{ $data->benefiary->stratum }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="28" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.5 Zona:</b> {{ $data->benefiary->zone == 'U' ? 'Urbano' : 'Rural' }}
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo4'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.1 Nombres y Apellidos:</b> {{ $data->benefiary->names }} {{ $data->benefiary->last_names }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $tipo_documento = '';
                                        switch ($data->benefiary->type_document) {
                                            case 'TI':
                                                $tipo_documento = 'TARJETA DE IDENTIDAD';
                                                break;
                                            case 'CC':
                                                $tipo_documento = 'CEDULA DE CIUDADANIA';
                                                break;
                                            case 'RC':
                                                $tipo_documento = 'REGISTRO CIVIL';
                                                break;
                                            default:
                                                $tipo_documento = 'Sin Tipo de Documento';
                                                break;
                                        }
                                    @endphp
                                    <b>2.2 Tipo de documento de identidad: </b> {{ $tipo_documento }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.3 Número de documento de identidad:</b> {{ $data->benefiary->document_number }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.4 # Télefono fijo o celular:</b> {{ $data->benefiary->phone }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.5 Correo electrónico:</b> {{ $data->benefiary->email }}
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo5'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="24" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $genders = '';
                                        switch ($data->benefiary->socio_demo->gender) {
                                            case 'M':
                                                $genders = 'Masculino';
                                                break;
                                            case 'F':
                                                $genders = 'Femenino';
                                                break;
                                            case 'LGBTIQ +':
                                                $genders = 'LGBTIQ+';
                                                break;
                                            case 'O':
                                                $genders = 'Otro';
                                                break;
                                            default:
                                                $genders = 'Sin Genero';
                                                break;
                                        }
                                    @endphp
                                    <b>3.1 Genero:</b> {{ $genders }}
                                </p>
                            </td>
                            <td colspan="10" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.2 Edad:</b> {{ $data->benefiary->socio_demo->age }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.3 ¿Estudia actualmente?: </b> {{ $data->benefiary->socio_demo->decision_study == 1 ? 'Si' : 'No' }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $educational_level = '';
                                        switch ($data->benefiary->socio_demo->educational_level) {
                                            case 'PREE':
                                                $educational_level = 'Preescolar';
                                                break;
                                            case 'PRI':
                                                $educational_level = 'Primaria';
                                                break;
                                            case 'BAC':
                                                $educational_level = 'Bachillerato';
                                                break;
                                            case 'TEC':
                                                $educational_level = 'Técnico';
                                                break;
                                            case 'TECN':
                                                $educational_level = 'Tecnólogo';
                                                break;
                                            case 'PRE':
                                                $educational_level = 'Pregrado';
                                                break;
                                            case 'POS':
                                                $educational_level = 'Posgrado';
                                                break;
                                            default:
                                                $educational_level = 'Ninguno';
                                                break;
                                        }
                                    @endphp
                                    <b>3.4 Nivel educativo alcanzado:</b> {{ $educational_level }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.5 ¿Presenta discapacidad?:</b> {{ $data->benefiary->socio_demo->decision_study == 1 ? 'Si' : 'No' }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $disability_types = '';
                                        switch ($data->benefiary->socio_demo->disability_type) {
                                            case 'F':
                                                $disability_types = 'Física';
                                                break;
                                            case 'V':
                                                $disability_types = 'Visual';
                                                break;
                                            case 'A':
                                                $disability_types = 'Auditiva';
                                                break;
                                            case 'C':
                                                $disability_types = 'Cognitiva';
                                                break;
                                            case 'M':
                                                $disability_types = 'Mental';
                                                break;
                                            case 'MUL':
                                                $disability_types = 'Múltiple';
                                                break;
                                            default:
                                                $disability_types = 'Ninguna';
                                                break;
                                        }
                                    @endphp
                                    <b>3.6 ¿Cuál?:</b> {{ $disability_types }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $conditions = '';
                                        switch ($data->benefiary->socio_demo->condition) {
                                            case 'D':
                                                $conditions = 'Desplazado/a';
                                                break;
                                            case 'MCH':
                                                $conditions = 'Mujer cabeza de hogar';
                                                break;
                                            case 'OH':
                                                $conditions = 'Otros hechos';
                                                break;
                                            case 'NA':
                                                $conditions = 'No aplica';
                                                break;
                                            // case 'IC':
                                            //     $conditions = 'Información y comunicación';
                                            //     break;
                                            // case 'CC':
                                            //     $conditions = 'Cooperación cultural';
                                            //     break;
                                            default:
                                                $conditions = 'Sin Condicion';
                                                break;
                                        }
                                    @endphp
                                    <b>3.7 ¿Condición?:</b> {{ $conditions }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $ethnicities = '';
                                        switch ($data->benefiary->socio_demo->ethnicity) {
                                            case 'AFRO':
                                                $ethnicities = 'Afrodescendiente';
                                                break;
                                            case 'IND':
                                                $ethnicities = 'Indígena';
                                                break;
                                            case 'ROM':
                                                $ethnicities = 'ROM(Gitana)';
                                                break;
                                            case 'PAL':
                                                $ethnicities = 'Palenquero';
                                                break;
                                            case 'RAI':
                                                $ethnicities = 'Raizal';
                                                break;
                                            default:
                                                $ethnicities = 'Ninguno';
                                                break;
                                        }
                                    @endphp
                                    <b>3.8 ¿Ud. con que grupo étnico se representa?:</b> {{ $ethnicities }}
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo6'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>4.1 ¿A qué regimen de salud colombiano pertenece?:</b> {{ $data->benefiary->health_data->medical_service == 'C' ? 'Contributivo' : 'Subsidiado' }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>4.2 Nombre de la EPS:</b> {{ $data->benefiary->health_data->entity_name->name }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $health_condition = '';
                                        switch ($data->benefiary->health_data->health_condition) {
                                            case 'B':
                                                $health_condition = 'BUENA';
                                                break;
                                            case 'R':
                                                $health_condition = 'REGULAR';
                                                break;
                                            case 'M':
                                                $health_condition = 'MALA';
                                                break;
                                            default:
                                                $health_condition = 'Sin Condicion';
                                                break;
                                        }
                                    @endphp
                                    <b>4.3 Estado de salud del beneficiario:</b> {{ $health_condition }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- Datos del Acudiente --}}
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo7'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34" style="background: #164E63">
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo8'] }}</h3>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.1 Parentesco con el beneficiario:</b> {{-- $data->benefiary->user_id --}}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.2 Nombres y Apellidos:</b> {{ $data->benefiary->attendant->names }} {{ $data->benefiary->attendant->last_names }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    @php
                                        $tipo_documento_acudiente = '';
                                        switch ($data->benefiary->attendant->type_document) {
                                            case 'TI':
                                                $tipo_documento_acudiente = 'TARJETA DE IDENTIDAD';
                                                break;
                                            case 'CC':
                                                $tipo_documento_acudiente = 'CEDULA DE CIUDADANIA';
                                                break;
                                            case 'RC':
                                                $tipo_documento_acudiente = 'REGISTRO CIVIL';
                                                break;
                                            default:
                                                $tipo_documento_acudiente = 'Sin Tipo de Documento';
                                                break;
                                        }
                                    @endphp
                                    <b>1.3 Tipo de documento de identidad:</b> {{ $tipo_documento_acudiente }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.4 Número de documento de identidad:</b> {{ $data->benefiary->attendant->document_number }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.5 # Télefono fijo o celular:</b> {{ $data->benefiary->attendant->phone }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.6 Correo electrónico:</b> {{ $data->benefiary->attendant->email }}
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>1.7 Zona:</b> {{ $data->benefiary->attendant->zone =='U' ? 'Urbano' : 'Rural' }}
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo9'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="24" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.1 Genero:</b>
                                </p>
                            </td>
                            <td colspan="10" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.2 Edad:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.3 ¿Estudia actualmente?: </b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.4 Nivel educativo alcanzado:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.5 ¿Presenta discapacidad?:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.6 ¿Cuál?:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>2.7 ¿Condición?:</b>
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
                                <h3 style="text-align: center; color:#ffffff;">{{ $titulos['Titulo10'] }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.1 ¿A qué regimen de salud colombiano pertenece?:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.2 Nombre de la EPS:</b>
                                </p>
                            </td>
                        </tr>
                        <tr></tr>
                        <tr>
                            <td colspan="34" rowspan="2">
                                <p style="text-align: left;margin-top: 0%;margin-bottom:0%">
                                    <b>3.3 Estado de salud del acudiente:: </b>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tr>
        </div>
    </body>
</html>
